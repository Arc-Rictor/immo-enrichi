<?php

use App\Actions\Auth\CheckAgentRegistration;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AgentListingInterestController;
use App\Http\Controllers\ApproveListingInterestAgent;
use App\Http\Controllers\Auth\CompleteAgentRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteListingController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingInterestController;
use App\Http\Controllers\PropertySearchController;
use App\Http\Middleware\CheckForActiveSubscription;
use App\Http\Middleware\ValidateAgentRegistration;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/language/{language}', function ($language) {
    Session()->put('locale', $language);

    return redirect()->back();
})->withoutMiddleware([ValidateAgentRegistration::class, CheckForActiveSubscription::class])->name('locale.update');

Route::post('stripe/webhook', [\Laravel\Cashier\Http\Controllers\WebhookController::class, 'handleWebhook'])
    ->middleware('guest')
    ->withoutMiddleware([ValidateAgentRegistration::class, CheckForActiveSubscription::class])
    ->name('cashier.webhook');


Route::withoutMiddleware([ValidateAgentRegistration::class, CheckForActiveSubscription::class])->group(function () {
    Route::get('/register/agent', [CompleteAgentRegistrationController::class, 'show'])->name('register.agent');
    Route::post('/register/agent', [CompleteAgentRegistrationController::class, 'store'])->name('register.agent.store');
});

Route::get('/download-template', function () {
    return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ListingsExport, 'listing_template.csv');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/subscription-checkout', function (Request $request) {
        $seller = config('app.subscriptions.seller');
        $buyer = config('app.subscriptions.buyer');
        $agent = config('app.subscriptions.agent');

        $type = auth()->user()->type;

        match ($type) {
            'agent' => $product = $agent,
            'buyer' => $product = $buyer,
            'seller' => $product = $seller,
        };

        return request()->user()->newSubscription($type, $product)->checkout([
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
            'allow_promotion_codes' => true,
            'locale' => config('app.locale')
        ]);
    })->name('subscription-check')->withoutMiddleware(CheckForActiveSubscription::class);

    Route::get('/billing', function () {

        return Auth::user()->redirectToBillingPortal(config('app.url'));
    })->name('billing');

    # Listings
    Route::controller(ListingController::class)->prefix('listings')->name('listing.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/create', 'create')->name('create');
        Route::get('{listing:reference}', 'show')->scopeBindings()->name('show');
        Route::get('{listing:reference}/edit', 'edit')->name('edit');
        Route::patch('{listing:reference}', 'update')->name('update');
        Route::post('{listing:reference}/publish', 'publish')->name('publish');
        Route::post('{listing:reference}/unpublish', 'unpublish')->name('unpublish');
    });
    Route::get('listings/{listing:reference}/agent-interest', AgentListingInterestController::class)->name('listing.agent-interest');
    Route::post('listings/upload', \App\Http\Controllers\UploadListingsController::class)->name('listing.upload');
    Route::controller(ListingInterestController::class)->prefix('listing-interest')->name('listing.interest.')->group(function () {
        Route::post('/', 'store')->name('store');
    });

    Route::post('/listing-interest/{interest}/approve', ApproveListingInterestAgent::class)->name('listing-interest.approve');

    Route::get('/search', PropertySearchController::class)->name('property-search');

    # Features
    Route::controller(FeatureController::class)->prefix('feature')->name('feature.')->group(function () {
        Route::post('/', 'store')->name('store');
    });

    # Favourite Listing
    Route::post('/favourite-listing', FavouriteListingController::class)->name('favourite-listing');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    Route::mediaLibrary();
});
