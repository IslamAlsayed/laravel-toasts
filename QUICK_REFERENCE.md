# 🎯 Laravel Toasts - Quick Reference Card

## Installation

```bash
composer require islamalsayed/laravel-toasts
php artisan vendor:publish --tag=toast-all
php artisan toasts:inject
```

## Basic Usage

### Simple Toasts

```php
addToastSuccess('User created!');
addToastError('Failed to save');
addToastWarning('Please check input');
addToastInfo('New update available');
```

### With Chaining

```php
addToast('success', 'Saved!')
    ->title('Success')
    ->emoji('🎉')
    ->pin()
    ->duration('5s')
    ->withAction('View', '/path');
```

### Confirmation Dialogs

```php
addConfirm('Delete this?')
    ->link('/delete/1')
    ->onConfirm('Yes, Delete')
    ->onCancel('Cancel');
```

## Livewire Integration

### Dispatch from Frontend

```blade
<button wire:click="$dispatch('toast', {
    type: 'success',
    message: 'Done!'
})">
    Click Me
</button>
```

### Use in Component

```php
public function delete($id)
{
    $this->safeDestroy($id, 'model');
}

// Or with custom toast
public function deleteCustom($id)
{
    $success = $this->safeDestroy($id, 'model', showToast: false);

    if ($success) {
        addToast('success', 'Deleted!')
            ->emoji('🎯')
            ->duration('3s');
    }
}
```

## JavaScript Usage

### Browser Console

```javascript
// Simple toast
window.pushToast('success', 'It works!');

// Advanced toast
window.pushToast('error', 'Failed!', {
  title: 'Error',
  emoji: '❌',
  pin: true
});

// Confirmation
window.pushToastConfirm('Sure?', '/action', {
  onConfirm: 'Yes',
  onCancel: 'No'
});
```

### From Alpine.js

```blade
<button @click="window.pushToast('info', 'Clicked!', { emoji: '🖱️' })">
    Test Toast
</button>
```

## Available Methods

| Method         | Example                         |
| -------------- | ------------------------------- |
| `title()`      | `->title('Success')`            |
| `emoji()`      | `->emoji('🎉')`                 |
| `icon()`       | `->icon('check')`               |
| `duration()`   | `->duration('5s')`              |
| `position()`   | `->position('top')`             |
| `pin()`        | `->pin()`                       |
| `theme()`      | `->theme('error')`              |
| `dir()`        | `->dir('rtl')`                  |
| `withAction()` | `->withAction('View', '/path')` |
| `link()`       | `->link('/confirm')`            |
| `onConfirm()`  | `->onConfirm('Yes')`            |
| `onCancel()`   | `->onCancel('No')`              |

## Common Emojis

```php
// Success
->emoji('✅') ->emoji('🎉') ->emoji('👍') ->emoji('✔️')

// Error
->emoji('❌') ->emoji('⛔') ->emoji('💥') ->emoji('🔥')

// Warning
->emoji('⚠️') ->emoji('⚡') ->emoji('🔔') ->emoji('📢')

// Info
->emoji('ℹ️') ->emoji('💡') ->emoji('📌') ->emoji('🔍')

// Actions
->emoji('🗑️') ->emoji('👁️') ->emoji('✏️') ->emoji('💾')
```

## Testing

```bash
# Run all tests
composer test

# Run with coverage
composer test-coverage

# Run specific test
vendor/bin/phpunit tests/Unit/ToastFactoryTest.php
```

## Configuration (.env)

```env
TOASTS_MOVE=enable
TOASTS_ENTER_TIME=0.3s
TOASTS_EXIT_TIME=0.3s
TOASTS_VISIBLE_TIME=4s
TOASTS_START_DELAY_TIME=0.5s

TOASTS_CONFIRM_PIN=true

TOASTS_DEFAULT_DIR=ltr
TOASTS_DEFAULT_POSITION=bottom
TOASTS_DEFAULT_THEME=info
```

## Publishing Assets

```bash
# All assets
php artisan vendor:publish --tag=toast-all

# Individual components
php artisan vendor:publish --tag=toast-config
php artisan vendor:publish --tag=toast-views
php artisan vendor:publish --tag=toast-css
php artisan vendor:publish --tag=toast-js
php artisan vendor:publish --tag=toast-webfonts
```

---

📖 **Full Documentation:** [README.md](README.md)  
🐛 **Issues:** [GitHub Issues](https://github.com/IslamAlsayed/laravel-toasts/issues)  
💬 **Contact:** [eslamalsayed8133@gmail.com](mailto:eslamalsayed8133@gmail.com)
