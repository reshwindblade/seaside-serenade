# Laravel User Management Portal

A full-featured user management portal built with Laravel, Livewire, AlpineJS, and Tailwind CSS.

## Project Overview

This application is a robust user management portal with the following features:

- User authentication (login, registration, password reset)
- Email verification
- Admin dashboard with analytics
- User management (view, add, edit, delete)
- User profile management
- API endpoints with documentation
- Dark mode support
- Responsive design
- Data export functionality (PDF, Excel, CSV)

## Project Structure

The application follows Laravel's standard structure with some additional organization:

### Core Directories

- `app/` - Contains the core PHP code
  - `Http/Controllers/` - Application controllers
  - `Http/Middleware/` - Custom middleware
  - `Models/` - Database models
  - `Providers/` - Service providers
  - `Livewire/` - Livewire components
  - `Services/` - Service classes
  - `Helpers/` - Helper classes

- `resources/` - Frontend assets and views
  - `views/` - Blade templates
    - `components/` - Reusable UI components
    - `layouts/` - Page layouts
    - `livewire/` - Livewire view components
    - `pages/` - Page templates (used by Laravel Folio)
  - `css/` - CSS files
  - `js/` - JavaScript files

- `routes/` - Route definitions
  - `web.php` - Web routes
  - `api.php` - API routes
  - `admin.php` - Admin panel routes

### Key Components

#### Views and Components

The application uses a component-based approach with Blade components:

- `resources/views/components/` - Reusable UI components
  - `ui/` - Common UI elements (buttons, cards, inputs, etc.)
  - `layouts/` - Page layout templates

#### Pages

Page templates are located in `resources/views/pages/` and follow Laravel Folio conventions:

- `auth/` - Authentication-related pages
- `admin/` - Admin panel pages
- `profile/` - User profile pages

#### Livewire Components

Livewire components provide interactive functionality:

- `app/Livewire/Admin/UsersTable.php` - User management table with sorting, searching, and pagination
- Various Volt components defined directly in the pages

## How to Modify Existing Pages

### Modifying Page Content

1. Locate the page in `resources/views/pages/`
2. Edit the Blade template or Volt component as needed
3. For pages with Volt components, you can modify both the PHP logic and HTML markup in the same file

Example of a page with a Volt component:

```php
<?php
// Page configuration and imports
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('home'); // Route name
middleware(['auth']); // Applied middleware

// Volt component definition
new class extends Component
{
    // Component properties and methods
    public function someMethod()
    {
        // Method implementation
    }
};
?>

<x-layouts.app>
    <!-- Page content using Blade syntax -->
    @volt('home')
    <div>
        <!-- Volt component template -->
    </div>
    @endvolt
</x-layouts.app>
```

### Modifying UI Components

1. Find the component in `resources/views/components/ui/`
2. Edit the component's Blade template
3. Components are designed to be customizable via props

Example of modifying a button component:

```blade
@props([
    'type' => 'primary', 
    'size' => 'md', 
    'tag' => 'button',
    'href' => '/',
    'submit' => false,
    'rounded' => 'md',
    'icon' => false,
    'loading' => false
])

<!-- Component template -->
```

### Modifying Layouts

Layouts are in `resources/views/components/layouts/`:

- `main.blade.php` - Base layout with minimal structure
- `app.blade.php` - Application layout with header and content area
- `marketing.blade.php` - Marketing pages layout

## How to Add New Pages

### Using Laravel Folio

1. Create a new Blade file in `resources/views/pages/`
2. Add PHP configuration section at the top
3. Implement the page content using Blade or Volt

Example of adding a new page:

```php
<?php
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('my-new-page'); // Route name
middleware(['auth']); // Applied middleware

// Optional Volt component
new class extends Component
{
    // Component properties and methods
};
?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('My New Page') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Page content -->
        </div>
    </div>
</x-layouts.app>
```

### Creating Traditional Routes

For more complex pages or special routing needs:

1. Add a new route in `routes/web.php` or `routes/admin.php`
2. Create a controller method if needed
3. Create a Blade view in the appropriate directory

## Working with Livewire Components

### Creating a New Livewire Component

1. Create a new PHP file in `app/Livewire/`
2. Create a corresponding Blade view in `resources/views/livewire/`
3. Register the component in `app/Providers/LivewireComponentProvider.php`

Example Livewire component:

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    public $someProperty = '';

    public function someMethod()
    {
        // Method implementation
    }

    public function render()
    {
        return view('livewire.my-component');
    }
}
```

### Using Volt Components

For simpler components, use Volt directly in your pages:

```php
@volt
<div>
    <?php
    new class extends Component 
    {
        public $counter = 0;
        
        public function increment()
        {
            $this->counter++;
        }
    };
    ?>
    
    <div class="p-6">
        <p>Count: {{ $counter }}</p>
        <button wire:click="increment">Increment</button>
    </div>
</div>
@endvolt
```

## Working with API Endpoints

To add new API endpoints:

1. Add a new route in `routes/api.php`
2. Create a controller method in the appropriate controller
3. Update the API documentation in `resources/views/pages/api-docs.blade.php`

## Modifying the Theme

### Tailwind Configuration

The application uses Tailwind CSS with a dark mode toggle:

- Modify `tailwind.config.js` to customize colors, spacing, etc.
- Update `resources/css/app.css` for global styles

### Dark Mode

Dark mode is implemented using Tailwind's dark mode with a preference stored in local storage:

- Toggle is implemented in `resources/views/components/ui/light-dark-switch.blade.php`
- Dark mode classes are applied throughout the application using `dark:` prefixed classes

## Development Workflow

1. Make sure all dependencies are installed:
   ```
   composer install
   npm install
   ```

2. Run the development server:
   ```
   php artisan serve
   ```

3. Compile assets in watch mode:
   ```
   npm run dev
   ```

## Deployment

1. Optimize the application for production:
   ```
   php artisan optimize
   npm run build
   ```

2. Set appropriate environment variables in your `.env` file
3. Configure your web server to point to the `public/` directory

## Social Login Integration

### Features

- Facebook and Google social login
- Configurable via environment variables
- Seamless account creation and authentication
- Flexible registration control

### Configuration

#### Environment Variables

Add the following to your `.env` file to configure social login:

```env
# Enable/Disable Social Logins
FACEBOOK_LOGIN_ENABLED=false
GOOGLE_LOGIN_ENABLED=false

# Facebook Login Credentials
FACEBOOK_CLIENT_ID=your_facebook_client_id
FACEBOOK_CLIENT_SECRET=your_facebook_client_secret
FACEBOOK_REDIRECT_URL=/login/facebook/callback

# Google Login Credentials
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URL=/login/google/callback

# Disable new account registration globally
APP_DISABLE_REGISTRATION=false
```

### Social Login Workflow

1. **Provider Configuration**
   - Register applications with Facebook and Google
   - Obtain client ID and client secret
   - Configure redirect URLs

2. **Login Process**
   - Users can choose to log in with Facebook or Google
   - Automatically creates or links existing accounts
   - Respects registration disable flag

### Customization Options

- Control social login providers via environment variables
- Disable new registrations while allowing existing users to log in
- Extend `SocialLoginController` for custom logic

### Security Considerations

- Prevents unauthorized account creation
- Validates and secures social login callbacks
- Provides flexible configuration options

### Troubleshooting

- Verify callback URLs match exactly
- Check environment configuration
- Ensure Socialite package is correctly installed

### Advanced Customization

You can extend the `SocialLoginController` to:
- Add custom user role assignment
- Implement additional verification steps
- Collect extra profile information
- Restrict login to specific email domains

### Potential Improvements

- Add more social login providers
- Implement more granular registration controls
- Add social account linking for existing users


## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://laravel-livewire.com/docs)
- [AlpineJS Documentation](https://alpinejs.dev/start-here)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Laravel Socialite Documentation](https://laravel.com/docs/socialite)
- [OAuth 2.0 Authentication Guide](https://oauth.net/2/)
- [Social Login Best Practices](https://developer.okta.com/blog/2019/07/08/social-login-oauth)