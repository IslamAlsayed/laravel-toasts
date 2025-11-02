# 🎉 Laravel Toast & Confirm Component

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-10.x%20%7C%2011.x-red.svg)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-purple.svg)](https://livewire.laravel.com)

**A modern, elegant, and powerful Laravel package for toast notifications and confirmation dialogs with full Livewire support.**

## ✨ Features

- 🎨 **Multiple toast types**: Success ✅, Error ❌, Warning ⚠️, Info ℹ️
- 🎭 **Custom icons & emojis** with Font Awesome support
- 📌 **Pin support** for persistent notifications
- ⏱️ **Configurable duration** and display positions
- 🌍 **RTL/LTR support** with full Arabic compatibility
- 🎯 **Livewire 3.x integration** with event dispatching
- ⚡ **JavaScript API** for client-side notifications
- 🎬 **Smooth animations** with customizable timing
- 🔘 **Action buttons** with custom callbacks
- 🛡️ **Interactive confirmation dialogs**
- 🧪 **Fully tested** with PHPUnit
- 📦 **Easy installation** with granular asset publishing

---

<<<<<<< HEAD
## � Screenshots

### English Toasts

![English Toast Examples](./src/Resources/assets/images/toasts.png)

### Arabic (RTL) Support

![Arabic Toast Examples](./src/Resources/assets/images/toasts_ar.png)

---

## �📦 Installation

=======
## 📦 Installation

>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
### 1. Install via Composer

```bash
composer require islamalsayed/laravel-toasts
```

### 2. Publish Assets

```bash
# Publish everything (recommended for first-time setup)
php artisan vendor:publish --tag=toast-all

# Or publish components individually:
php artisan vendor:publish --tag=toast-config    # Configuration file
php artisan vendor:publish --tag=toast-views     # Blade templates
php artisan vendor:publish --tag=toast-css       # CSS styles
php artisan vendor:publish --tag=toast-js        # JavaScript files
php artisan vendor:publish --tag=toast-webfonts  # Font Awesome fonts
```

### 3. Inject Toast View

Run the inject command to add the toast component to your master layout:

```bash
php artisan toasts:inject
```

This will automatically inject `@include('toasts')` into your layout file before the closing `</body>` tag.

---

## ⚙️ Configuration

### Environment Variables

Add these settings to your `.env` file:

```env
# Animation timing
TOASTS_MOVE=enable                    # Enable/disable toast movement
TOASTS_ENTER_TIME=0.3s               # Entry animation duration
TOASTS_EXIT_TIME=0.3s                # Exit animation duration
TOASTS_VISIBLE_TIME=4s               # How long toast stays visible
TOASTS_START_DELAY_TIME=0.5s         # Delay before showing toast

# Confirmation defaults
TOASTS_CONFIRM_PIN=true              # Keep confirms pinned by default

# Display settings
TOASTS_DEFAULT_DIR=ltr               # Text direction: ltr or rtl
<<<<<<< HEAD
TOASTS_DEFAULT_POSITION=top       # Toast position: top, right
=======
TOASTS_DEFAULT_POSITION=bottom       # Toast position: top, bottom, left, right
>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
TOASTS_DEFAULT_THEME=info            # Default theme: success, error, warning, info

# Default messages
TOASTS_DEFAULT_MESSAGE=Hello there!
TOASTS_DEFAULT_TITLE=Notification

# Confirmation texts
TOASTS_CONFIRM_TITLE=Please Confirm
TOASTS_CONFIRM_MESSAGE=Do you really want to proceed?
TOASTS_CONFIRM_TEXT=Sure
TOASTS_CANCEL_TEXT=Cancel
```

### Configuration File

After publishing, customize `config/toasts.php` for more advanced settings.

---

## 🚀 Basic Usage

### Simple Toasts

```php
// Using helper functions
addToastSuccess('User created successfully!');
addToastError('Failed to delete item');
addToastWarning('Please check your input');
addToastInfo('New update available');

// Generic helper
addToast('success', 'Operation completed!');
```

### With Session Flash

```php
// Automatic toast from session flash
return redirect()->back()->with('success', 'Data saved!');
return redirect()->route('dashboard')->withError('Access denied');

// All these work automatically:
session()->flash('success', 'Item created!');
session()->flash('error', 'Validation failed!');
session()->flash('warning', 'Action required!');
session()->flash('info', 'Did you know?');
```

### Using Toast Facade

```php
use IslamAlsayed\LaravelToasts\Facades\Toast;

Toast::success('Record saved!');
Toast::error('Something went wrong')->icon('bomb');
Toast::warning('Check your email')->emoji('📧');
Toast::info('System maintenance at 10PM')->pin();
```

---

## ✨ Advanced Usage

### Chaining Methods

```php
addToast('success', 'User profile updated!')
    ->title('Success')           // Custom title
    ->emoji('🎉')               // Add emoji (replaces icon)
    ->icon('user-check')        // Font Awesome icon
    ->pin()                     // Make sticky (won't auto-hide)
    ->duration('5s')            // Custom duration (2s, 500ms, 1m)
<<<<<<< HEAD
    ->position('top')           // Position: top, right
=======
    ->position('top')           // Position: top, bottom, left, right
>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
    ->dir('rtl')                // Direction: rtl or ltr
    ->theme('success');         // Theme: success, error, warning, info
```

### With Action Buttons

```php
addToast('info', 'New message received')
    ->title('Notification')
    ->emoji('📬')
    ->withAction('View', route('messages.show', 1))
    ->withAction('Mark as Read', '/messages/1/read');

Toast::warning('Unsaved changes detected')
    ->withAction('Save Now', '/save')
    ->withAction('Discard', '/discard')
    ->pin();
```

### Confirmation Dialogs

```php
// Simple confirmation
addConfirm('Are you sure you want to delete this?');

// Advanced confirmation
addConfirm('Permanently delete this user?')
    ->title('Confirm Deletion')
    ->emoji('⚠️')
    ->link(route('users.destroy', $user->id))
    ->onConfirm('Yes, Delete')
    ->onCancel('Cancel')
    ->target('_self');

// Type-specific confirmations
addConfirmSuccess('Save changes?');
addConfirmError('Delete permanently?');
addConfirmWarning('Overwrite existing file?');
addConfirmInfo('Mark all as read?');
```

---

## 🎯 Livewire Integration

### Event Dispatching

Livewire components can dispatch toast events from the frontend:

```php
// In your Livewire component
<button wire:click="$dispatch('toast', {
<<<<<<< HEAD
    type: 'success',message: 'Action completed!'
=======
    type: 'success',
    message: 'Action completed!'
>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
})">
    Click Me
</button>

// With full options
<button wire:click="$dispatch('toast', {
    type: 'warning',
    message: 'Are you sure?',
    title: 'Confirmation',
    emoji: '⚠️',
    pin: true,
    duration: '3s'
})">
    Show Toast
</button>
```

### Using HandlesCrudSafely Trait

The package provides a trait for safe CRUD operations with automatic toast notifications:

```php
namespace App\Livewire;

use Livewire\Component;
<<<<<<< HEAD

class Users extends Component
{

    public function destroy($id)
    {
        // Default toast notification
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->dispatch('show-toast', [
                'type' => 'success',
                'message' => 'Users deleted successfully.',
                'title' => 'Success',
                'emoji' => '✅'
            ]);
        } else {
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'Users not found.',
                'title' => 'Error',
                'emoji' => '❌'
            ]);
=======
use App\Traits\HandlesCrudSafely;

class TourGuides extends Component
{
    use HandlesCrudSafely;

    public function delete($id)
    {
        // Default toast notification
        $this->safeDestroy($id, 'tourGuide');
    }

    public function deleteWithCustomToast($id)
    {
        // Disable default toast and add custom one
        $success = $this->safeDestroy($id, 'tourGuide', showToast: false);

        if ($success) {
            addToast('success', 'Tour guide deleted successfully!')
                ->emoji('🎯')
                ->title('Deleted')
                ->duration('3s');
>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
        }
    }
}
```

### Complete Livewire Example

```php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserManager extends Component
{
    public $name;
    public $email;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            // Success toast
            addToast('success', 'User created successfully!')
                ->emoji('👤')
                ->title('Success')
                ->withAction('View Users', route('users.index'));

            $this->reset(['name', 'email']);

        } catch (\Exception $e) {
            // Error toast
            addToast('error', 'Failed to create user: ' . $e->getMessage())
                ->emoji('❌')
                ->title('Error')
                ->pin();
        }
    }

    public function render()
    {
        return view('livewire.user-manager');
    }
}
```

### Livewire Blade Template

```blade
<div>
    <form wire:submit="save">
        <input type="text" wire:model="name" placeholder="Name">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <input type="email" wire:model="email" placeholder="Email">
        @error('email') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save User</button>
    </form>

    {{-- Dispatch toast from frontend --}}
    <button wire:click="$dispatch('toast', {
        type: 'info',
        message: 'Form ready for input',
        emoji: 'ℹ️'
    })">
        Show Info
    </button>
</div>
```

---

## 🖥️ JavaScript Usage

### Browser Console

Test toasts directly in the browser console:

```javascript
// Simple toast
<<<<<<< HEAD
window.pushToast('success', 'It works!');

// Advanced toast
window.pushToast('error', 'Something went wrong', {
  title: 'Error',
  emoji: '💥',
  pin: true,
  duration: '5s'
});

// Confirmation dialog
window.pushToastConfirm('Are you sure?', '/delete/123', {
  title: 'Confirm',
  emoji: '⚠️',
  onConfirm: 'Yes',
  onCancel: 'No'
=======
window.pushToast("success", "It works!");

// Advanced toast
window.pushToast("error", "Something went wrong", {
    title: "Error",
    emoji: "💥",
    pin: true,
    duration: "5s",
});

// Confirmation dialog
window.pushToastConfirm("Are you sure?", "/delete/123", {
    title: "Confirm",
    emoji: "⚠️",
    onConfirm: "Yes",
    onCancel: "No",
>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
});
```

### Custom JavaScript Events

```javascript
// Dispatch from vanilla JavaScript
document.getElementById('myButton').addEventListener('click', function() {
    window.pushToast('success', 'Button clicked!', {
        emoji: '🖱️',
        duration: '2s'
    });
});

// With Livewire Alpine.js
<button @click="window.pushToast('info', 'Alpine works!', { emoji: '⚡' })">
    Click Me
</button>
```

### From External JavaScript Files

```javascript
// In your app.js or custom script
export function showSuccessToast(message) {
<<<<<<< HEAD
  window.pushToast('success', message, {
    title: 'Success',
    emoji: '✅',
    duration: '3s'
  });
}

export function confirmDelete(url) {
  window.pushToastConfirm('Are you sure you want to delete this?', url, {
    title: 'Confirm Deletion',
    emoji: '🗑️',
    onConfirm: 'Delete',
    onCancel: 'Cancel'
  });
=======
    window.pushToast("success", message, {
        title: "Success",
        emoji: "✅",
        duration: "3s",
    });
}

export function confirmDelete(url) {
    window.pushToastConfirm("Are you sure you want to delete this?", url, {
        title: "Confirm Deletion",
        emoji: "🗑️",
        onConfirm: "Delete",
        onCancel: "Cancel",
    });
>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
}
```

---

## Available Emojis:

````php
// Success
->emoji('✅') ->emoji('🎉') ->emoji('👍') ->emoji('✔️')

// Error
->emoji('❌') ->emoji('⛔') ->emoji('🚫') ->emoji('💥')

// Warning
->emoji('⚠️') ->emoji('⚡') ->emoji('🔔') ->emoji('📢')

// Info
->emoji('ℹ️') ->emoji('💡') ->emoji('📌') ->emoji('🔍')

// Delete
->emoji('🗑️') ->emoji('🚮') ->emoji('❌')

// Actions
->emoji('👁️') ->emoji('✏️') ->emoji('📝') ->emoji('💾')```

---

## Real-World Examples:

#### Example 1: After creating a record

```php
public function store(Request $request)
{
    $user = User::create($request->all());

    addToast('success', 'User created successfully!')
        ->title('Success')
        ->emoji('👤')
        ->withAction('View Profile', route('users.show', $user->id));

    return redirect()->route('users.index');
}
````

#### Example 2: Before deleting (your current use case)

```php
public function destroy($id)
{
    // Default toast notification
    $user = User::find($id);
    if ($user) {
        $user->delete();
        $this->dispatch('show-toast', [
            'type' => 'success',
            'message' => 'Users deleted successfully.',
            'title' => 'Success',
            'emoji' => '✅'
        ]);
    } else {
        $this->dispatch('show-toast', [
            'type' => 'error',
            'message' => 'Users not found.',
            'title' => 'Error',
            'emoji' => '❌'
        ]);
    }
}
```

#### Example 3: Livewire component

```php
public function save()
{
    $this->validate();

    User::create($this->form);

    addToast('success', 'User added!')
        ->emoji('🎯')
        ->title('Added')
        ->pin();
}
```

#### Example 4: Multiple toasts at once

```php
public function import()
{
    $success = 10;
    $failed = 2;

    if ($success > 0) {
        addToast('success', "$success items imported successfully")
            ->emoji('✅')
            ->duration(3000);
    }

    if ($failed > 0) {
        addToast('warning', "$failed items failed to import")
            ->emoji('⚠️')
            ->withAction('View Log', '/import/log');
    }
}
```

---

## 🧪 Testing

### Running Tests

```bash
# Run all tests
composer test

# Run specific test file
vendor/bin/phpunit tests/Feature/ToastFeatureTest.php

# Run with coverage
composer test-coverage
```

### Unit Tests Example

```php
namespace IslamAlsayed\LaravelToasts\Tests\Unit;

use IslamAlsayed\LaravelToasts\ToastFactory;
use IslamAlsayed\LaravelToasts\Tests\TestCase;

class ToastFactoryTest extends TestCase
{
    public function test_can_create_success_toast()
    {
        $toast = ToastFactory::success('User created!');

        $this->assertEquals('success', $toast->type);
        $this->assertEquals('User created!', $toast->message);
    }

    public function test_can_chain_methods()
    {
        $toast = ToastFactory::error('Failed!')
            ->title('Error')
            ->emoji('❌')
            ->pin()
            ->duration('5s');

        $this->assertEquals('Error', $toast->title);
        $this->assertEquals('❌', $toast->emoji);
        $this->assertTrue($toast->pin);
        $this->assertEquals('5s', $toast->duration);
    }

    public function test_can_add_actions()
    {
        $toast = ToastFactory::info('New message')
            ->withAction('View', '/messages')
            ->withAction('Dismiss', '#');

        $this->assertCount(2, $toast->actions);
        $this->assertEquals('View', $toast->actions[0]['label']);
        $this->assertEquals('/messages', $toast->actions[0]['url']);
    }
}
```

### Feature Tests Example

```php
namespace IslamAlsayed\LaravelToasts\Tests\Feature;

use IslamAlsayed\LaravelToasts\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToastFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_toast_is_added_to_session()
    {
        addToastSuccess('Test message');

        $toasts = session('toasts');

        $this->assertNotNull($toasts);
        $this->assertCount(1, $toasts);
        $this->assertEquals('success', $toasts[0]->type);
        $this->assertEquals('Test message', $toasts[0]->message);
    }

    public function test_multiple_toasts_can_be_queued()
    {
        addToastSuccess('First');
        addToastError('Second');
        addToastWarning('Third');

        $toasts = session('toasts');

        $this->assertCount(3, $toasts);
    }

    public function test_redirect_with_flash_creates_toast()
    {
        $response = $this->get('/test-redirect');

        $response->assertSessionHas('success', 'Operation completed!');
    }
}
```

### Testing Livewire Integration

```php
namespace Tests\Feature\Livewire;

use App\Livewire\UserManager;
use Livewire\Livewire;
use Tests\TestCase;

class UserManagerTest extends TestCase
{
    public function test_success_toast_on_user_creation()
    {
        Livewire::test(UserManager::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->call('save')
            ->assertDispatched('toast');

        $toasts = session('toasts');
        $this->assertNotNull($toasts);
        $this->assertEquals('success', $toasts[0]->type);
    }

    public function test_error_toast_on_validation_failure()
    {
        Livewire::test(UserManager::class)
            ->set('name', '')
            ->set('email', 'invalid-email')
            ->call('save')
            ->assertHasErrors(['name', 'email']);
    }
}
```

---

## 🌍 RTL & Arabic Support

All features work perfectly with Arabic text and RTL direction.

![RTL Example - Confirm](./src/Resources/assets/images/confirms_ar.png)
![RTL Example - Success](./src/Resources/assets/images/success_ar.png)
![RTL Example - Error](./src/Resources/assets/images/error_ar.png)
![RTL Example - Warning](./src/Resources/assets/images/warning_ar.png)
![RTL Example - Info](./src/Resources/assets/images/info_ar.png)

---

## 🧩 API Reference

### Toast Properties

```php
public $type;        // success, error, info, warning
public $message;     // Toast message text
public $title;       // Optional toast title
public $emoji;       // Emoji next to title
public $icon;        // Font Awesome icon name
public $duration;    // Display duration (e.g., 2s, 500ms, 1m)
<<<<<<< HEAD
public $position;    // Position: top, right
=======
public $position;    // Position: top, bottom, left, right
>>>>>>> 87589fe3a5d35a46d225f3e5868ac1af7870102a
public $pin;         // If true, toast remains until manually closed
public $theme;       // Theme color: success, error, etc.
public $dir;         // Text direction: ltr or rtl
public $confirm;     // Confirm button label
public $cancel;      // Cancel button label
public $actions;     // Array of actions [label + url]
```

### Helper Functions

| Function                      | Description                 |
| ----------------------------- | --------------------------- |
| `addToast($type, $message)`   | Create a generic toast      |
| `addToastSuccess($message)`   | Create success toast        |
| `addToastError($message)`     | Create error toast          |
| `addToastWarning($message)`   | Create warning toast        |
| `addToastInfo($message)`      | Create info toast           |
| `addConfirm($message)`        | Create confirmation dialog  |
| `addConfirmSuccess($message)` | Create success confirmation |
| `addConfirmError($message)`   | Create error confirmation   |
| `addConfirmWarning($message)` | Create warning confirmation |
| `addConfirmInfo($message)`    | Create info confirmation    |

### Facade Methods

```php
use IslamAlsayed\LaravelToasts\Facades\Toast;

Toast::success($message);
Toast::error($message);
Toast::warning($message);
Toast::info($message);
Toast::confirm($message);
```

---

## 🌍 RTL & Arabic Support

All features work perfectly with Arabic text and RTL direction.

![RTL Example - Confirm](./src/Resources/assets/images/confirms_ar.png)
![RTL Example - Success](./src/Resources/assets/images/success_ar.png)
![RTL Example - Error](./src/Resources/assets/images/error_ar.png)
![RTL Example - Warning](./src/Resources/assets/images/warning_ar.png)
![RTL Example - Info](./src/Resources/assets/images/info_ar.png)

---

## � Future Enhancements

- [ ] Toast queueing system (stacked notifications)
- [ ] Audio alerts on confirmations
- [ ] Persistent toasts across page reloads
- [ ] Built-in animation presets (slide, fade, bounce, zoom)
- [ ] Dark mode support
- [ ] Custom toast templates
- [ ] WebSocket integration for real-time notifications

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

1. **Fork the repository**
2. **Create a feature branch**: `git checkout -b feature/amazing-feature`
3. **Commit your changes**: `git commit -m 'Add amazing feature'`
4. **Push to the branch**: `git push origin feature/amazing-feature`
5. **Open a Pull Request**

### Development Setup

```bash
# Clone the repository
git clone https://github.com/IslamAlsayed/laravel-toasts.git
cd laravel-toasts

# Install dependencies
composer install

# Run tests
composer test
```

### Code Style

This project follows PSR-12 coding standards. Please ensure your code adheres to these standards before submitting.

```bash
# Check code style
composer phpcs

# Fix code style
composer phpcbf
```

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 📬 Support & Contact

- 📧 **Email**: [eslamalsayed8133@gmail.com](mailto:eslamalsayed8133@gmail.com)
- 💼 **LinkedIn**: [IslamAlsayed](https://www.linkedin.com/in/islam-alsayed7)
- � **Facebook**: [IslamAlsayed](https://www.facebook.com/islamalsayed00)
- 🐛 **Issues**: [GitHub Issues](https://github.com/IslamAlsayed/laravel-toasts/issues)

---

## 🙏 Acknowledgments

- Built with ❤️ for the Laravel community
- Inspired by modern notification libraries
- Font Awesome for the amazing icons

---

## 📝 Changelog

See [CHANGELOG.md](CHANGELOG.md) for recent changes.

---

> 🚀 **Built for developers who want elegant, expressive, and flexible notifications in Laravel applications.**
