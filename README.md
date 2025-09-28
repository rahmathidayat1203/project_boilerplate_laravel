# 🚀 Laravel Pro-Boilerplate

> A feature-rich, production-ready starting point for new Laravel web applications. Skip the repetitive setup process and jump straight to building your core business logic.

<div align="center">
  
  [![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://www.php.net)
  [![License](https://img.shields.io/github/license/rahmatnurfauzi/laravel-pro-boilerplate?style=for-the-badge)](LICENSE)
  
  <p align="center">
    <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" width="100" height="100">
  </p>
  
  <p align="center">
    <b>Quick Links:</b>
    <a href="#installation">Installation</a> •
    <a href="#features">Features</a> •
    <a href="#usage">Usage</a> •
    <a href="#api">API</a> •
    <a href="#deployment">Deployment</a>
  </p>

</div>

## 📋 Table of Contents
- [✨ Features](#-features)
- [📦 What's Included](#-whats-included)
- [_requirements Requirements](#-requirements)
- [🚀 Installation](#-installation)
- [🔐 Authentication & Authorization](#-authentication--authorization)
- [📊 Usage Guide](#-usage-guide)
- [⚙️ API Ready](#️-api-ready)
- [🧪 Testing](#-testing)
- [🔧 Deployment](#-deployment)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)
- [📞 Support](#-support)

## ✨ Features

<div align="center">

| Feature | Description | Status |
|:-------:|:-----------:|:------:|
| 🔐 **Authentication** | Complete auth system with registration, login, logout & password reset | ✅ |
| 🛡️ **Authorization** | Role-based access control (RBAC) with Spatie Laravel Permission | ✅ |
| 🖥️ **Modern UI** | Responsive interface built with Blade and Bootstrap 5 | ✅ |
| 📊 **Data Tables** | Server-side processed tables with Yajra Laravel Datatables | ✅ |
| 🛠️ **Developer Tools** | Helper functions, activity logging, and more | ✅ |
| ⚡ **API Ready** | Built-in Sanctum for token-based API authentication | ✅ |
| 🧪 **Testing** | Pre-configured PHPUnit tests for core functionality | ✅ |

</div>

## 📦 What's Included

### 🔐 Authentication System
- User registration with validation
- Secure login with "Remember Me" option
- Password reset via email
- Profile management
- Clean separation of concerns with `AuthHelper`

### 🛡️ Authorization (RBAC)
- Role & Permission management
- Admin UI for managing roles/permissions
- Middleware protection for routes
- User role assignment interface

### 🖥️ User Interface
- Responsive layout with sidebar navigation
- Bootstrap 5 components
- Reusable Blade components
- Dashboard with user statistics

### 📊 Data Management
- Server-side processed DataTables
- Search, sort, and pagination
- CRUD operations for users
- Export functionality

### 🛠️ Developer Experience
- Global helper functions
- Activity logging for audit trails
- Application settings module
- User profile management

### ⚡ API Ready
- Sanctum token authentication
- Ready for SPA or mobile app integration

## 🧩 Requirements

Before you begin, ensure you have the following installed:

| Requirement | Version |
|-------------|--------|
| 🐘 PHP | 8.2+ |
| 🧰 Composer | Latest |
| 🗄️ MySQL/PostgreSQL | Latest |
| 🟨 Node.js | 18+ |
| 📦 NPM | Latest |

> **Note:** Make sure you have all necessary PHP extensions enabled (BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML).

## 🚀 Installation

### Quick Start

1.  **Clone the repository**
    ```bash
    git clone https://github.com/rahmatnurfauzi/laravel-pro-boilerplate.git your-project-name
    cd your-project-name
    ```

2.  **Install dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Configure environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure database**

    Open the `.env` file and set your database credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5.  **Run database migrations and seeders**
    ```bash
    php artisan migrate --seed
    ```

6.  **Compile assets**
    ```bash
    # For development
    npm run dev

    # For production
    npm run build
    ```

7.  **Start development server**
    ```bash
    php artisan serve
    ```

8.  **Access your application**
    - Visit `http://localhost:8000`
    - Login with: `admin@example.com` / `password`

### 🎨 UI Theme Installation (Optional)
This boilerplate comes with an AdminLTE theme installer. If you need to install or reinstall the AdminLTE theme, you can use the following command:

```bash
php artisan install:ui-theme
```

This command will:
- Install AdminLTE 3.2 as the UI theme
- Update package.json with necessary dependencies
- Configure Vite for asset compilation
- Update Tailwind CSS configuration
- Create necessary asset files (adminlte.css, adminlte.js)
- Create the AdminLTE layout file
- Update all existing Blade files to use the new layout

After running the theme installer, make sure to compile the assets:
```bash
npm install && npm run dev
```

###  switching UI Themes

This boilerplate supports both AdminLTE and Argon themes. You can switch between them by running the `install:ui-theme` command and selecting your desired theme. 

**Important:** After switching themes, you must reinstall the npm dependencies and recompile the assets for the new theme to be applied correctly.

```bash
npm install && npm run dev
```

### 🛠️ One-Command Setup
For a faster setup, you can use this script:

```bash
# Run these commands in sequence
git clone https://github.com/rahmatnurfauzi/laravel-pro-boilerplate.git && \
cd laravel-pro-boilerplate && \
composer install && \
npm install && \
cp .env.example .env && \
php artisan key:generate && \
# Update .env with your DB credentials here
php artisan migrate --seed && \
npm run dev
```

## 🔐 Authentication & Authorization

### Default Credentials
After installation, use these credentials to login:

| Role | Email | Password | Access |
|------|-------|----------|--------|
| 🧑‍💼 Admin | `admin@example.com` | `password` | Full access |
| 👤 User | `user@example.com` | `password` | Limited access |

> ⚠️ **Important:** Change the default credentials immediately in production!

### Available Routes
| Feature | Path | Description |
|---------|------|-------------|
| 📝 Register | `/register` | User registration |
| 🔓 Login | `/login` | User login |
| 🔄 Password Reset | `/password/reset` | Password reset |
| 🚪 Logout | `POST /logout` | User logout |
| 👤 Profile | `/profile` | User profile management |

### Authorization Setup
This boilerplate uses Spatie's Laravel Permission package for role-based access control:

- **Admin Role**: Full access to all features
- **User Role**: Basic access with limited permissions
- **Custom Roles**: Create additional roles as needed

## 📊 Usage Guide

### Managing Roles & Permissions
Access these routes after logging in:

- `/roles` - Role management
- `/permissions` - Permission management  
- `/users` - User management with role assignment

### Creating New Features

#### 1. Generate Controllers/Models
```bash
php artisan make:controller YourController
php artisan make:model YourModel
```

#### 2. Add Routes
```php
// routes/web.php
Route::resource('your-resource', YourController::class)->middleware('auth');
```

#### 3. Apply Authorization
```php
// In your controller
public function __construct()
{
    $this->middleware('can:your-permission');
}
```

#### 4. Add to Navigation
Edit `resources/views/layouts/app.blade.php` to add your feature to the sidebar:
```html
<li class="nav-item">
    <a class="nav-link" href="{{ route('your-route') }}">
        Your Feature
    </a>
</li>
```

### Customizing the UI

| Component | Path |
|-----------|------|
| 🎨 Layout | `resources/views/layouts/app.blade.php` |
| 🎨 Guest Layout | `resources/views/layouts/guest.blade.php` |
| 🎨 Components | `resources/views/components/` |
| 🎨 Styles | `resources/css/app.css` |
| 🎨 Scripts | `resources/js/app.js` |

### Adding New Permissions

1. **Create permission** in the database or via seeder:
   ```php
   use Spatie\Permission\Models\Permission;
   
   Permission::create(['name' => 'your-permission']);
   ```

2. **Assign to roles** in the admin panel or via code:
   ```php
   $role->givePermissionTo('your-permission');
   ```

3. **Use in controllers**:
   ```php
   Route::get('/your-route', [YourController::class, 'index'])
       ->middleware('can:your-permission');
   ```

4. **Use in views**:
   ```html
   @can('your-permission')
       <!-- Content for users with permission -->
   @endcan
   ```

### Helper Functions

This boilerplate includes several global helper functions:

| Function | Description | Usage |
|----------|-------------|-------|
| `formatDate()` | Format dates consistently | `formatDate($date, 'Y-m-d H:i:s')` |
| `uploadFile()` | Upload files | `uploadFile($file, 'uploads')` |
| `generateApiResponse()` | Standard API responses | `generateApiResponse(true, 'Success message', $data, 200)` |
| `getSetting()` | Get application settings | `getSetting('app_name', 'Default Name')` |

## ⚡ API Ready

This boilerplate is API-ready with Laravel Sanctum:

### API Setup
1. Install Sanctum if needed: `composer require laravel/sanctum`
2. Run `php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`
3. Run `php artisan migrate`

### Authentication
To use API authentication:
1. Generate API token for users
2. Include token in request header: `Authorization: Bearer {token}`

Example API route:
```php
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
```

### Example API Controller
```php
class Api\UserController extends Controller
{
    public function index()
    {
        return generateApiResponse(
            true, 
            'Users retrieved successfully',
            User::all()
        );
    }
}
```

## 🧪 Testing

Run the complete test suite:
```bash
php artisan test
```

Or run specific test types:
```bash
# Unit tests
php artisan test --testsuite=Unit

# Feature tests
php artisan test --testsuite=Feature
```

### Test Structure
- `tests/Unit/` - For unit tests
- `tests/Feature/` - For feature tests
- `tests/CreatesApplication.php` - Application bootstrap for tests

## 🔧 Deployment

### Production Setup

1. **Optimize autoloader**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

2. **Cache configuration**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Set file permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

4. **Environment variables**
   Ensure your `.env` file has:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

5. **Optimize assets**
   ```bash
   npm run build
   ```

### Server Requirements

Make sure your server meets these requirements:

- **PHP:** 8.2 or higher
- **Extensions:** BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML
- **Database:** MySQL 8.0+, PostgreSQL 12+, SQLite 3.8.8+, SQL Server 2017+
- **Node.js:** 18+ for asset compilation

### Environment Configuration

| Setting | Recommended Value | Description |
|---------|------------------|-------------|
| `APP_ENV` | `production` | Application environment |
| `APP_DEBUG` | `false` | Disable detailed error messages |
| `LOG_LEVEL` | `error` | Log level in production |
| `DB_CONNECTION` | `mysql` | Database connection |
| `CACHE_DRIVER` | `redis` | Recommended for performance |
| `SESSION_DRIVER` | `redis` | Recommended for performance |
| `QUEUE_CONNECTION` | `redis` | Recommended for performance |

## 🤝 Contributing

I welcome contributions! Here's how you can help:

### 🐛 Bug Reports
1. Check existing issues before creating a new one
2. Include detailed steps to reproduce
3. Provide your environment information
4. Describe expected vs actual behavior

### ✨ Feature Requests
1. Explain the problem you're trying to solve
2. Describe your proposed solution
3. Consider the impact on existing functionality

### 🧑‍💻 Code Contributions
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Make your changes
4. Add tests if applicable
5. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
6. Push to the branch (`git push origin feature/AmazingFeature`)
7. Open a pull request

### 📝 Code Standards
- Follow PSR-12 coding standards
- Write clear, descriptive commit messages
- Add documentation for new features
- Include tests for new functionality

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2025 Rahmat Hidayat

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 🙏 Acknowledgements

<div align="center">

| Package | Purpose |
|---------|---------|
| [Laravel](https://laravel.com) | The PHP Framework for web artisans |
| [Spatie](https://spatie.be) | Amazing packages for Laravel developers |
| [Yajra](https://github.com/yajra) | Laravel DataTables package |
| [Bootstrap](https://getbootstrap.com) | Frontend framework for developing responsive websites |

</div>

## 📞 Support

If you encounter any issues or have questions:

1. 📚 **Check the documentation** above
2. 🔍 **Search existing issues** on GitHub
3. ❓ **Create a new issue** with detailed information
4. 📨 **Contact the maintainer** at [rh63800@gmail.com]

---

<div align="center">
  <p>⭐ If you find this boilerplate useful, please consider starring the repository!</p>
  
  <p>Made with ❤️ by developers, for developers</p>
</div>
