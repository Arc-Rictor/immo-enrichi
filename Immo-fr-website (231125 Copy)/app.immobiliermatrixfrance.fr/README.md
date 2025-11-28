# Immobilier Matrix France - Real Estate Platform

A modern, full-stack real estate management platform built with Laravel, Vue 3, and Stripe integration. Enable agents, buyers, and sellers to manage property listings, subscriptions, and interactions.

> **Note**: As of November 2025, the marketing website (`public_html/`) has been updated to focus exclusively on real estate agents. While the backend application still supports buyers and sellers, the public-facing landing pages now promote only agent features and subscriptions. 
> 
> **November 23, 2025 - B2B Redesign**: New redesigned landing pages (`fr-redesign.html` and `en-redesign.html`) are under client review. These feature a professional B2B SaaS aesthetic with focus on the three core benefits: Collaboration, Direct Leads, and Shared Revenue. See `../public_html/CHANGELOG.md` for details.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Database](#database)
- [Development](#development)
- [Deployment](#deployment)
- [API Documentation](#api-documentation)
- [Contributing](#contributing)

## Overview

Immobilier Matrix France is a subscription-based real estate platform that facilitates property listings management, agent interactions, and user engagement. The platform supports multiple user types (Admin, Agents, Buyers, Sellers) with tailored features and subscription tiers.

**Key Purpose**: Streamline real estate transactions by providing a centralized hub for property discovery, agent networking, and subscription management.

## Features

### User Management
- **Multi-tenant system** with three user types: Admin, Agents, Buyers, Sellers
- User profiles with contact information and verification
- Subscription management with Stripe integration
- Two-factor authentication support
- Profile photo management

### Property Listings
- **Full CRUD operations** for property listings
- Detailed property information:
  - Address, location (latitude/longitude with Google Maps)
  - Property type, size, land size
  - Bedrooms, bathrooms
  - Asking price and description
- **Photo gallery** with responsive images (Spatie Media Library)
- Publish/unpublish workflow
- Status tracking (draft, published, etc.)
- Reference numbers for tracking

### Agent Features
- Agent registration and profile completion
- Express interest in listings
- Approval workflow for listing interests
- Agent-specific subscription tier
- Commission and interaction tracking

### Buyer & Seller Features
- Property search with location filters
- Favorite listings management
- Recently viewed listings tracking
- Express interest in properties
- One free listing for sellers

### Search & Discovery
- **Advanced property search** by location, price, type, size
- Google Maps integration for location visualization
- Location-based filtering
- Property feature filtering

### Subscription Management
- **Stripe payment integration** via Laravel Cashier
- Separate subscription tiers for:
  - Agents (90-day trial period)
  - Buyers
  - Sellers
- Billing portal integration
- Promotion code support
- Trial period management

### Admin Dashboard
- User management and moderation
- System monitoring
- Listing approval workflows
- Analytics and reporting

### Additional Features
- **CSV/Excel import** for bulk listing uploads
- **Email notifications** for agent approvals and seller updates
- **Multi-language support** (French/English)
- **Toast notifications** for user feedback

## Tech Stack

### Backend
- **Framework**: Laravel 10.10
- **PHP Version**: 8.1+
- **Authentication**: Laravel Sanctum, Fortify, Jetstream
- **Payments**: Laravel Cashier (Stripe)
- **Media Management**: Spatie Media Library Pro v2
- **Excel Operations**: Maatwebsite Excel v3.1
- **HTTP Client**: Guzzle HTTP

### Frontend
- **Framework**: Vue 3
- **Build Tool**: Vite 4.3+
- **CSS Framework**: Tailwind CSS 3.1
- **UI Components**: HeadlessUI, Heroicons
- **Form Handling**: Vue 3 with Inertia.js
- **Maps**: Google Maps API
- **Toasts/Notifications**: vue-toastification
- **Carousel**: Hooper

### Database
- 26 migrations defining database schema
- Eloquent ORM for data access
- Factories for testing

### DevTools
- Laravel Pint (code styling)
- PHPUnit + Pest (testing)
- Laravel Debugbar
- Collision error reporting

## Installation

### Prerequisites
- PHP 8.1 or higher
- Node.js 16+ with npm
- Composer
- MySQL/PostgreSQL database
- Stripe account (for payment processing)
- Google Maps API key

### Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd app.immobiliermatrixfrance.fr
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database connection** in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=immobilier_matrix
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Configure Stripe** in `.env`:
   ```
   STRIPE_PUBLIC_KEY=your_stripe_public_key
   STRIPE_SECRET_KEY=your_stripe_secret_key
   ```

7. **Configure Google Maps** in `.env`:
   ```
   GOOGLE_MAPS_API_KEY=your_google_maps_api_key
   ```

8. **Run migrations**
   ```bash
   php artisan migrate
   ```

9. **Seed database** (optional)
   ```bash
   php artisan db:seed
   ```

10. **Build frontend assets**
    ```bash
    npm run build
    ```

## Configuration

### Subscriptions
Configure subscription products in `config/app.php`:

```php
'subscriptions' => [
    'seller' => env('STRIPE_SELLER_PRODUCT_ID'),
    'buyer' => env('STRIPE_BUYER_PRODUCT_ID'),
    'agent' => env('STRIPE_AGENT_PRODUCT_ID'),
]
```

### Media Library
Media storage is configured via Spatie Media Library. Default: `public/media`

### Localization
Supported locales: French (fr), English (en)
Toggle language via `/language/{language}` route.

## Usage

### Development Server

Start the development environment:

```bash
# Terminal 1 - Vite development server
npm run dev

# Terminal 2 - Laravel development server
php artisan serve
```

Visit `http://localhost:8000`

### Building for Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Creating Listings

1. Log in as Agent or Seller
2. Navigate to `/listings/create`
3. Fill in property details (address, price, features, etc.)
4. Upload photos
5. Save as draft or publish immediately

### Managing Subscriptions

Users can manage subscriptions via:
- `/subscription-checkout` - Initiate subscription
- `/billing` - Access Stripe billing portal

### Admin Functions

Admins access user management at `/admin/users`

## Project Structure

```
app.immobiliermatrixfrance.fr/
├── app/
│   ├── Actions/           # Business logic (Auth, Listing, etc.)
│   ├── Http/
│   │   ├── Controllers/   # Route handlers
│   │   ├── Middleware/    # Custom middleware
│   │   ├── Requests/      # Form validation
│   │   └── Resources/     # API response formatting
│   ├── Models/            # Eloquent models
│   ├── Policies/          # Authorization policies
│   ├── Notifications/     # Email notifications
│   ├── Exports/           # Excel exports
│   ├── Imports/           # Excel imports
│   └── Providers/         # Service providers
├── bootstrap/             # Application bootstrap
├── config/                # Configuration files
├── database/
│   ├── migrations/        # Database schema
│   ├── factories/         # Model factories
│   └── seeders/           # Database seeders
├── public/                # Web root
├── resources/
│   ├── js/               # Vue components (99 total)
│   ├── views/            # Blade templates
│   ├── css/              # Tailwind styles
│   └── lang/             # Translation files
├── routes/               # Route definitions
├── storage/              # Application storage
├── tests/                # Test suite
├── vendor/               # Composer dependencies
├── vite.config.js        # Vite configuration
├── tailwind.config.js    # Tailwind configuration
├── composer.json         # PHP dependencies
├── package.json          # Node dependencies
└── artisan               # Artisan CLI
```

## Database

### Core Tables

| Table | Purpose |
|-------|----------|
| `users` | User accounts (agents, buyers, sellers, admins) |
| `agents` | Agent profiles and metadata |
| `listings` | Property listings |
| `features` | Property amenities (pool, garden, etc.) |
| `favourite_listings` | User favorites (many-to-many) |
| `recently_viewed_listings` | User browsing history |
| `listing_interests` | Agent/buyer interest in properties |
| `uploads` | Media file tracking |

### Relationships

- **User** → Many **Listings**
- **User** → Many **Agents** (agent_id)
- **Listing** → One **User**, One **Agent**
- **Listing** → Many **Features** (many-to-many)
- **User** → Many **Favorite Listings** (many-to-many)
- **ListingInterest** → One **User**, One **Listing**

## Development

### Running Tests

```bash
# Run all tests
./vendor/bin/pest

# Run specific test file
./vendor/bin/pest tests/Feature/ListingTest.php

# Run with coverage
./vendor/bin/pest --coverage
```

### Code Quality

```bash
# Format code with Pint
./vendor/bin/pint

# Run Pint check (no changes)
./vendor/bin/pint --test
```

### Database Migrations

```bash
# Create new migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset all migrations
php artisan migrate:reset
```

### Vue Components

Vue components are located in `resources/js/`. Common components:

- Listings display and filters
- Property search interface
- User profile management
- Subscription checkout
- Admin dashboards

### Available Artisan Commands

```bash
php artisan make:model ModelName         # Create model
php artisan make:controller ControllerName
php artisan make:migration migration_name
php artisan tinker                       # Interactive shell
```

## Deployment

### Prerequisites
- Web server with PHP 8.1+ support
- SSL certificate
- Database server (MySQL/PostgreSQL)

### Steps

1. **Clone to production server**
   ```bash
   git clone <repository-url> /var/www/immobilier-matrix
   ```

2. **Install dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm ci --production
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   # Configure .env with production credentials
   ```

4. **Build assets**
   ```bash
   npm run build
   ```

5. **Run migrations**
   ```bash
   php artisan migrate --force
   ```

6. **Configure web server** (Nginx/Apache)
   - Point document root to `public/`
   - Enable mod_rewrite for Apache

7. **Set permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

8. **Cache configuration**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## API Documentation

### Authentication
All API endpoints require authentication via `auth:sanctum` middleware.

### Key Endpoints

#### Listings
- `GET /listings` - List all listings
- `POST /listings` - Create listing
- `GET /listings/{listing:reference}` - View listing
- `PATCH /listings/{listing:reference}` - Update listing
- `POST /listings/{listing:reference}/publish` - Publish listing
- `POST /listings/{listing:reference}/unpublish` - Unpublish listing

#### Search
- `GET /search` - Search properties (query parameters: price, location, type, etc.)

#### Agents
- `POST /listing-interest` - Express interest in listing
- `GET /listings/{listing:reference}/agent-interest` - View agent interest

#### User Management
- `GET /admin/users` - List all users (admin only)
- `DELETE /admin/users/{user}` - Delete user (admin only)

#### Media
- `POST /listings/upload` - Upload listing photos

### Response Format
All responses follow standard JSON format with appropriate HTTP status codes.

## Contributing

### Workflow
1. Create feature branch: `git checkout -b feature/your-feature`
2. Make changes and commit: `git commit -m "Add your feature"`
3. Push to repository: `git push origin feature/your-feature`
4. Create pull request for review

### Code Standards
- Follow Laravel conventions
- Use Pint for code formatting
- Write tests for new features
- Add documentation for public APIs

## License

This project is proprietary software. All rights reserved.

## Support

For issues, questions, or feature requests, contact the development team.

---

**Last Updated**: November 2025
**Version**: 1.0.0
