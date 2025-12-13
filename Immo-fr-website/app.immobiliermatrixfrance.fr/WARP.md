# WARP Configuration - Immobilier Matrix France

This file contains development guidelines, conventions, and project-specific rules for working with the Immobilier Matrix France real estate platform.

> **Marketing Site Updates**: 
> - **Nov 29, 2025**: Immo-Erichi rebrand deployed ✅ (live)
> - **Dec 13, 2025**: Landing page sandbox created (work in progress)
>   - `../public_html/en-sandbox.html`
>   - `../public_html/fr-sandbox.html`
>   - `../public_html/styles-sandbox.css` (shared by both)
> - The public marketing website (`../public_html/`) focuses exclusively on agents
> - Language persistence: All auth links include `?locale=fr` or `?locale=en`
> - See `../README.md` and `../CHANGELOG.md` for complete details

## Project Context

**Project Type**: Full-stack Laravel + Vue 3 SaaS application
**Domain**: Real estate property management platform
**Primary Users**: Agents, Sellers, Buyers, Admins (Backend supports all; Marketing site promotes Agents only)
**Key Technologies**: Laravel 10, Vue 3, Stripe, Google Maps

---

## Development Workflow

### Getting Started

The project is a monolithic Laravel application with Vue 3 frontend. All code resides in the `app.immobiliermatrixfrance.fr/` directory.

**Before running any development commands**, ensure:
- Node.js dependencies are installed: `npm install`
- PHP dependencies are installed: `composer install`
- Environment is configured: Copy `.env.example` to `.env` and set credentials
- Database is migrated: `php artisan migrate`

**To start development**, you must run BOTH services:
```bash
# Terminal 1: Vite development server (rebuilds on file changes)
npm run dev

# Terminal 2: Laravel development server
php artisan serve
```

The application will be available at `http://localhost:8000`. Vite hot-reload handles automatic frontend updates.

### Required Environment Variables

```
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=immobilier_matrix
DB_USERNAME=root
DB_PASSWORD=

# Stripe
STRIPE_PUBLIC_KEY=
STRIPE_SECRET_KEY=
STRIPE_SELLER_PRODUCT_ID=
STRIPE_BUYER_PRODUCT_ID=
STRIPE_AGENT_PRODUCT_ID=

# Google Maps
GOOGLE_MAPS_API_KEY=

# Email (optional for development)
MAIL_FROM_ADDRESS=noreply@immobiliermatrixfrance.fr
```

---

## Code Organization

### Backend Structure

```
app/
├── Actions/              # Business logic & use cases
│   ├── Auth/            # Authentication flows
│   ├── Listing/         # Listing operations
│   ├── Agent/           # Agent-related actions
│   └── ...
├── Http/
│   ├── Controllers/     # Request handlers
│   ├── Middleware/      # Request/response middleware
│   ├── Requests/        # Form validation rules
│   └── Resources/       # API response transformers
├── Models/              # Eloquent models (8 total)
├── Policies/            # Authorization logic
├── Notifications/       # Email notifications
└── Providers/           # Service registration
```

### Frontend Structure

```
resources/js/
├── app.js              # Application entry point
├── Pages/              # Page-level components
│   ├── Auth/          # Authentication pages
│   ├── Listings/      # Listing management
│   ├── Dashboard/     # User dashboards
│   └── ...
├── Components/         # Reusable Vue components
├── Layouts/           # Layout wrappers
└── Composables/       # Vue composition functions
```

**Total Vue Components**: 99 (organized by feature)

---

## Key Models & Relationships

### User Model
- **Attributes**: first_name, last_name, email, password, type (admin|agent|buyer|seller), telephone, address fields, siren
- **Relations**: 
  - `agent()` - BelongsTo Agent
  - `listings()` - HasMany Listing
  - `favouriteListings()` - BelongsToMany Listing
  - `recentlyViewed()` - BelongsToMany Listing

### Listing Model
- **Attributes**: address_line_one, address_line_two, postcode, province, city, country, property_type, property_size, land_size, bedrooms, bathrooms, asking_price, description, specification, status, reference, latitude, longitude
- **Relations**:
  - `user()` - BelongsTo User (owner)
  - `agent()` - BelongsTo Agent
  - `features()` - BelongsToMany Feature
  - `interest()` - HasMany ListingInterest
- **Media**: Uses Spatie Media Library for photo gallery (collection: `property_photos`)

### Agent Model
- **Attributes**: Standard model with agent-specific data
- **Relations**: HasMany Listing, HasMany ListingInterest

### Feature Model
- Represents property amenities/features (pool, garden, etc.)
- BelongsToMany Listing

### ListingInterest Model
- Tracks agent/buyer interest expressions on listings
- Relations: BelongsTo User, BelongsTo Listing

---

## Authentication & Authorization

### Authentication
- Uses **Laravel Sanctum** for API token authentication
- **Jetstream** for user management UI
- **Fortify** for authentication logic

### Authorization
- Use **Policies** for resource authorization
- Example: `ListingPolicy` controls who can edit/delete listings
- Middleware: `CheckForActiveSubscription`, `ValidateAgentRegistration`

### User Types
1. **Admin** - Full system access, user management
2. **Agent** - Can list properties, view agent dashboard, interact with listings
3. **Seller** - Can list own properties (limited)
4. **Buyer** - Can search, favorite, and express interest

---

## Database

### Migrations
- Located in `database/migrations/` (26 total)
- Use Laravel's migration system: `php artisan make:migration`
- Always include proper foreign keys and constraints
- Timestamp all models

### Common Queries

```php
// Get published listings
$listings = Listing::published()->get();

// Get user's listings
$listings = auth()->user()->listings()->where('status', 'published')->get();

// Get favorites
$favorites = auth()->user()->favouriteListings;

// Search listings
$results = Listing::where('property_type', 'villa')
    ->where('asking_price', '<=', 500000)
    ->whereDistance('coordinates', $lat, $lng, 5)
    ->get();
```

---

## Frontend Development

### Vue 3 Conventions

- **Use Composition API** for new components (not Options API)
- **Props**: Define with type validation
- **Emits**: Explicitly declare component emits
- **State**: Use `ref()` and `reactive()` for reactivity
- **Watchers**: Use `watch()` for computed reactivity

### Example Component Structure

```vue
<template>
  <div class="listing-card">
    <h2>{{ listing.address_line_one }}</h2>
    <p>${{ listing.asking_price }}</p>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  listing: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['favorite', 'view'])

const isFavorite = ref(false)

const formattedPrice = computed(() => {
  return new Intl.NumberFormat('fr-FR').format(props.listing.asking_price)
})
</script>

<style scoped>
/* Use Tailwind classes in templates when possible */
</style>
```

### CSS

- **Use Tailwind CSS** for styling (no custom CSS where possible)
- Custom colors defined in `tailwind.config.js`: `brandorange: '#FFA163'`
- Import custom CSS in `resources/css/app.css`

### Inertia.js Integration

This project uses **Inertia.js** for seamless Vue-Laravel integration:

```php
// In Controllers
return Inertia::render('Listings/Show', [
    'listing' => $listing,
    'relatedListings' => $relatedListings
]);
```

```vue
<!-- In Vue Components -->
<script setup>
import { usePage } from '@inertiajs/vue3'

const listing = usePage().props.listing
</script>
```

---

## Forms & Validation

### Server-Side Validation

Use **Form Requests** in `app/Http/Requests/`:

```php
// Example: app/Http/Requests/StoreListingRequest.php
class StoreListingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'address_line_one' => 'required|string|max:255',
            'property_type' => 'required|in:house,apartment,villa,land',
            'asking_price' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:0|max:20'
        ];
    }
}
```

### Client-Side Validation

Validate in Vue before submission. Use Inertia's form helpers for better UX:

```vue
<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  address: '',
  price: '',
  bedrooms: 0
})

const submit = () => {
  form.post('/listings', {
    onSuccess: () => console.log('Saved!'),
    onError: () => console.log('Errors:', form.errors)
  })
}
</script>
```

---

## Payments & Subscriptions

### Stripe Integration

Using **Laravel Cashier** with Stripe:

```php
// Create subscription
$user->newSubscription('agent', 'stripe_agent_product_id')
    ->checkout([
        'success_url' => route('dashboard'),
        'cancel_url' => route('dashboard'),
        'subscription_data' => ['trial_period_days' => 90]
    ]);

// Check subscription
if ($user->subscribed('agent')) {
    // User has active subscription
}

// Subscription tiers
// - Agents: 90-day free trial
// - Sellers: One free listing
// - Buyers: Access to search/favorites
```

### Webhook Handling

Stripe webhooks are handled in `routes/web.php`:
```php
Route::post('stripe/webhook', [WebhookController::class, 'handleWebhook']);
```

---

## Testing

### Unit & Feature Tests

Tests are organized in `tests/` using **Pest PHP**:

```bash
# Run all tests
./vendor/bin/pest

# Run specific test
./vendor/bin/pest tests/Feature/ListingTest.php

# Coverage report
./vendor/bin/pest --coverage
```

### Example Test

```php
// tests/Feature/ListingTest.php
test('user can create listing', function () {
    $user = User::factory()->create(['type' => 'seller']);
    
    $response = $this->actingAs($user)
        ->post('/listings', [
            'address_line_one' => '123 Rue de Paris',
            'property_type' => 'villa',
            'asking_price' => 500000
        ]);
    
    $this->assertDatabaseHas('listings', [
        'address_line_one' => '123 Rue de Paris'
    ]);
});
```

---

## Performance Considerations

### Query Optimization

- Use **eager loading** to avoid N+1 queries:
  ```php
  $listings = Listing::with('user', 'features', 'media')->get();
  ```

- Use **scopes** for common queries:
  ```php
  public function scopePublished(Builder $query)
  {
      return $query->where('published_at', '!=', null);
  }
  ```

### Caching

- Cache frequently accessed data (property types, features)
- Use Redis for session storage in production
- Cache Laravel routes and config:
  ```bash
  php artisan route:cache
  php artisan config:cache
  ```

### Media Library

- Images are stored via Spatie Media Library
- Use responsive images for mobile optimization
- Collection: `property_photos`

---

## Deployment

### Production Checklist

- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Generate application key: `php artisan key:generate`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Cache configuration: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Install dependencies with `--no-dev`: `composer install --optimize-autoloader --no-dev`
- [ ] Build frontend: `npm run build`
- [ ] Set proper file permissions for `storage/` and `bootstrap/cache/`
- [ ] Configure SSL certificate
- [ ] Set up email (Mailgun, SendGrid, etc.)
- [ ] Configure backup strategy
- [ ] Monitor error logs

### Environment

Current hosting: **cPanel shared hosting** (UNIX-like)
- Ensure PHP 8.1+ is enabled
- Enable `mod_rewrite` for Apache
- Set correct file permissions

---

## Common Tasks

### Adding a New Feature

1. **Create migration**: `php artisan make:migration add_feature_to_table`
2. **Create model** (if needed): `php artisan make:model FeatureName`
3. **Create controller**: `php artisan make:controller FeatureController`
4. **Add routes** in `routes/web.php`
5. **Create Vue component** in `resources/js/Components/`
6. **Write tests** in `tests/`
7. **Test locally** with `npm run dev` and `php artisan serve`

### Debugging

- Use **Laravel Debugbar**: visible in dev mode
- Use **dd()** or **dump()** to inspect data
- Use **ray()** for remote debugging (if ray.so installed)
- Check logs: `storage/logs/laravel.log`

### Database Issues

```bash
# Fresh migration
php artisan migrate:fresh

# Rollback specific steps
php artisan migrate:rollback --step=5

# See migration status
php artisan migrate:status
```

---

## Code Style & Formatting

### PHP

- Use **Laravel Pint** for code formatting
  ```bash
  ./vendor/bin/pint              # Format all files
  ./vendor/bin/pint --test       # Check without changes
  ```

### JavaScript/Vue

- Follow ESLint rules (configured in project)
- Use **Prettier** for consistent formatting
- 2-space indentation

### Git Commits

Use clear, descriptive commit messages:

```
feat: Add property search by location
fix: Resolve agent interest approval bug
docs: Update README with deployment steps
refactor: Extract listing card to component
test: Add tests for subscription workflow
```

---

## Known Limitations & TODO

- Localization: Currently French/English only (extensible)
- Google Maps: Ensure API key has correct restrictions
- Media Storage: Configure storage location in production
- Email: Configure mail driver before deployment

---

## Project Resources

- **Laravel Docs**: https://laravel.com/docs/10.x
- **Vue 3 Docs**: https://vuejs.org/
- **Inertia.js**: https://inertiajs.com/
- **Stripe Docs**: https://stripe.com/docs
- **Tailwind CSS**: https://tailwindcss.com/docs

---

## Contact & Support

For project-specific questions or issues:
- Review README.md for general information
- Check Laravel/Vue documentation for framework questions
- Refer to database schema in migrations

---

**Last Updated**: November 2025
**Project Version**: 1.0.2
