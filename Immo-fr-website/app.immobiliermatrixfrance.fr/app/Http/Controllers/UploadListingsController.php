<?php

namespace App\Http\Controllers;

use App\Imports\ListingsImport;
use App\Models\Upload;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use function Pest\Laravel\post;

class UploadListingsController extends Controller
{
    public function __invoke(Request $request)
    {
        $upload = Upload::create([
            'user_id' => \Auth::user()->id,
            'filename' => collect($request->file)->first()['name']
        ]);

        $upload->addFromMediaLibraryRequest($request->file)->toMediaCollection('file');

        $path = $upload->refresh()->getFirstMedia('file')->getPath();

        try {
            Excel::import(new ListingsImport, $path);
            return redirect()->to(route('listing.index'))->with(['message' => 'Listings successfully uploaded']);
        } catch (ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->withErrors($failures);
        }
    }
}
