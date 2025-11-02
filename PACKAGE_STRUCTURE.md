# 📦 Laravel Toasts Package Structure

```
vendor/islamalsayed/laravel-toasts/
│
├── .github/
│   └── workflows/
│       └── tests.yml                    # GitHub Actions CI/CD
│
├── src/
│   ├── Console/
│   │   └── InjectToastViewCommand.php   # Artisan command for injection
│   │
│   ├── Facades/
│   │   └── ToastFacade.php              # Laravel facade
│   │
│   ├── Resources/
│   │   ├── assets/
│   │   │   ├── css/
│   │   │   │   └── toasts.css           # Toast styles
│   │   │   ├── js/
│   │   │   │   ├── global.js            # Core JavaScript functions
│   │   │   │   └── toasts.js            # Toast initialization
│   │   │   └── webfonts/                # Font Awesome fonts
│   │   │
│   │   ├── config/
│   │   │   └── toasts.php               # Configuration file
│   │   │
│   │   └── views/
│   │       └── toasts.blade.php         # Main Blade template
│   │
│   ├── Helpers.php                      # Helper functions
│   ├── Toast.php                        # Toast model class
│   ├── ToastFactory.php                 # Toast factory
│   ├── ToastManager.php                 # Toast manager
│   └── ToastServiceProvider.php         # Service provider
│
├── tests/
│   ├── Feature/
│   │   └── ToastFeatureTest.php         # Feature tests (18 tests)
│   │
│   ├── Unit/
│   │   ├── ToastFactoryTest.php         # Factory tests (17 tests)
│   │   └── ToastManagerTest.php         # Manager tests (9 tests)
│   │
│   └── TestCase.php                     # Base test case
│
├── .gitignore                           # Git ignore rules
├── CHANGELOG.md                         # Version history
├── composer.json                        # Package dependencies
├── CONTRIBUTING.md                      # Contribution guide
├── GITHUB_PREPARATION_SUMMARY.md        # Preparation summary
├── LICENSE                              # MIT License
├── phpunit.xml                          # PHPUnit configuration
├── QUICK_REFERENCE.md                   # Quick reference card
└── README.md                            # Main documentation

```

## 📋 File Purposes

### Core Files

#### `src/Toast.php`

Main toast object class with properties and methods for building toasts.

```php
class Toast {
    public $type;
    public $message;
    public $title;
    public $emoji;
    // ... more properties

    public function title($title) { /* ... */ }
    public function emoji($emoji) { /* ... */ }
    // ... more methods
}
```

#### `src/ToastFactory.php`

Factory for creating toast instances with static methods.

```php
class ToastFactory {
    public static function success($message) { /* ... */ }
    public static function error($message) { /* ... */ }
    public static function confirm($message) { /* ... */ }
}
```

#### `src/ToastManager.php`

Manages toast addition to session.

```php
class ToastManager {
    public function add($type, $message) { /* ... */ }
}
```

#### `src/Helpers.php`

Global helper functions.

```php
function addToast($type, $message) { /* ... */ }
function addToastSuccess($message) { /* ... */ }
function addConfirm($message) { /* ... */ }
```

---

### Service Provider

#### `src/ToastServiceProvider.php`

Registers package services and publishes assets.

```php
class ToastServiceProvider extends ServiceProvider {
    public function boot() {
        $this->publishes([/* assets */], 'toast-all');
        $this->commands([InjectToastViewCommand::class]);
    }

    public function register() {
        $this->mergeConfigFrom(/* ... */);
        $this->app->singleton(ToastManager::class);
    }
}
```

**Publish Tags:**

- `toast-all` - Everything
- `toast-config` - Configuration only
- `toast-views` - Blade templates only
- `toast-css` - Stylesheets only
- `toast-js` - JavaScript files only
- `toast-webfonts` - Font files only

---

### Commands

#### `src/Console/InjectToastViewCommand.php`

Artisan command to inject toast view into layout.

```bash
php artisan toasts:inject
```

---

### Resources

#### `src/Resources/views/toasts.blade.php`

Main Blade template that renders toasts from session.

```blade
@php
    $toasts = session()->pull('toasts', []);
@endphp

@if (count($toasts) > 0)
    <!-- Toast rendering logic -->
@endif
```

#### `src/Resources/assets/js/global.js`

Core JavaScript functions exported to window.

```javascript
export function pushToast(type, message, options) {
  /* ... */
}
export function pushToastConfirm(message, link, options) {
  /* ... */
}
```

#### `src/Resources/assets/js/toasts.js`

Initialization and imports.

```javascript
import './global.js';
// Additional setup
```

#### `src/Resources/assets/css/toasts.css`

All toast styling including animations and themes.

---

### Configuration

#### `src/Resources/config/toasts.php`

Package configuration with all default values.

```php
return [
    'move' => env('TOASTS_MOVE', 'enable'),
    'enter_time' => env('TOASTS_ENTER_TIME', '0.3s'),
    // ... more config
];
```

---

### Testing

#### `tests/TestCase.php`

Base test case using Orchestra Testbench.

#### `tests/Unit/ToastFactoryTest.php`

Tests for toast creation, chaining, and configurations.

#### `tests/Unit/ToastManagerTest.php`

Tests for toast session management.

#### `tests/Feature/ToastFeatureTest.php`

Tests for all helper functions and integrations.

#### `phpunit.xml`

PHPUnit configuration with testsuites and coverage settings.

---

### Documentation

#### `README.md` (700+ lines)

Complete package documentation with:

- Installation guide
- Configuration
- Basic & advanced usage
- Livewire integration
- JavaScript API
- Testing guide
- Examples
- API reference

#### `CHANGELOG.md`

Version history following Keep a Changelog format.

#### `CONTRIBUTING.md`

Contribution guidelines and code of conduct.

#### `QUICK_REFERENCE.md`

Quick reference card for common usage patterns.

#### `GITHUB_PREPARATION_SUMMARY.md`

Summary of GitHub preparation and publishing checklist.

---

### GitHub Integration

#### `.github/workflows/tests.yml`

GitHub Actions workflow for:

- Multi-OS testing (Ubuntu, Windows)
- PHP 8.0, 8.1, 8.2, 8.3
- Laravel 10.x, 11.x
- Both prefer-lowest and prefer-stable

---

## 📊 Statistics

| Category                | Count  |
| ----------------------- | ------ |
| **Source Files**        | 10     |
| **Test Files**          | 4      |
| **Test Methods**        | 44     |
| **Documentation Files** | 6      |
| **Asset Files**         | 5+     |
| **Total Lines of Code** | ~5000+ |
| **Documentation Lines** | ~1500+ |

---

## 🎯 Key Components

### 1. Toast Creation System

- `Toast.php` - Base model
- `ToastFactory.php` - Static creation methods
- `ToastManager.php` - Session management

### 2. Integration Layer

- `Helpers.php` - Global functions
- `ToastServiceProvider.php` - Laravel integration
- `ToastFacade.php` - Facade access

### 3. Frontend Assets

- `toasts.css` - Styling
- `global.js` - Core JavaScript
- `toasts.js` - Initialization

### 4. Developer Tools

- Artisan command for injection
- Comprehensive testing suite
- GitHub Actions CI/CD

### 5. Documentation

- README with examples
- API reference
- Quick reference card
- Contributing guide

---

## 🚀 Usage Flow

```
User Code
   ↓
Helper Functions (Helpers.php)
   ↓
ToastFactory (creates Toast object)
   ↓
ToastManager (adds to session)
   ↓
Session Storage
   ↓
Blade Template (renders on page)
   ↓
JavaScript (animations & interactions)
   ↓
User sees Toast!
```

---

## 📝 Notes

- **PSR-4 Autoloading**: `IslamAlsayed\\Toasts\\`
- **Namespace**: `IslamAlsayed\Toasts`
- **Laravel Auto-Discovery**: ✅ Enabled
- **Livewire Compatible**: ✅ Version 3.x
- **RTL Support**: ✅ Full Arabic support
- **Testing Framework**: PHPUnit with Orchestra Testbench
- **Minimum PHP**: 8.0
- **Minimum Laravel**: 10.0
