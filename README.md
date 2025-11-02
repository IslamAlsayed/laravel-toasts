# Laravel Toast and Confirm Component

**A simple, elegant, and flexible Laravel package for toast notifications and confirmation alerts.**

## ✅ Features

- Multiple toast types: ✅ Success, ❌ Error, ⚠️ Warning, ℹ️ Info
- Custom icons, emojis, titles, and messages
- Pin support (persistent toasts)
- Control toast duration and display position
- LTR/RTL direction support
- Built-in themes and styling
- Interactive confirm/cancel buttons
- Fully customizable behavior and actions

---

## ⚙️ Installation

1. **Install via Composer:**

```bash
composer require halaby/laravel-toasts
```

2. **Publish assets and config:**

```bash
# Publish everything (config, views, and all assets)
php artisan vendor:publish --tag=toast-all

# Or publish individually:
php artisan vendor:publish --tag=toast-config    # Config file only
php artisan vendor:publish --tag=toast-views     # Blade views only
php artisan vendor:publish --tag=toast-css       # CSS files only
php artisan vendor:publish --tag=toast-js        # JavaScript files only
php artisan vendor:publish --tag=toast-webfonts  # Webfonts only
```

3. **Inject the toast view into your layout:**

```bash
php artisan toasts:inject
```

---

## 🔧 Configuration (.env)

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

TOASTS_DEFAULT_MESSAGE=Hello there!
TOASTS_DEFAULT_TITLE=Notification

TOASTS_CONFIRM_TITLE=Please Confirm
TOASTS_CONFIRM_MESSAGE=Do you really want to proceed?
TOASTS_CONFIRM_TEXT=Sure
TOASTS_CANCEL_TEXT=Cancel
```

---

## ✨ Usage

### ✅ Confirm Toasts

#### 1. Using global helper functions:

```php
addConfirm('Are you sure?');
addConfirmSuccess('Operation completed successfully');
addConfirmError('Delete this item?')->icon('trash')->title('Error');
addConfirmWarning('Please fill all fields')->icon('warning')->title('Warning');
addConfirmInfo('Block this user?')->icon('user-lock')->title('Info');
```

#### 2. Using the `Toast` static class:

```php
Toast::confirm()->icon('check')->title('Confirm');
Toast::confirm('Update item?')->emoji('✅')->onConfirm('Yes')->onCancel('No');
Toast::confirm('Delete?')->title('Confirm')->theme('error')->withAction('More Info', '/details');
```

#### 3. Using the `ToastManager` object:

```php
(new ToastManager)->add('confirm', 'Are you sure?')->theme('info');
(new ToastManager)->add('confirm', 'Delete this item?')->theme('error');
```

![Confirms](./src/Resources/assets/images/confirms.png)

---

### ✅ Toast Notifications

#### 1. Success Toast

```php
addToastSuccess('Saved successfully')->duration('2s');
addToast('success', 'Saved!')->pin()->emoji('🎉')->title('Success');
Toast::success('Data updated')->icon('check-circle')->duration('1s')->withAction('Undo', '/undo');
```

![Success](./src/Resources/assets/images/success.png)

#### 2. Error Toast

```php
addToastError('Something went wrong')->icon('bug')->duration('2s');
addToast('error', 'Failed')->pin()->emoji('💥')->title('Error');
Toast::error('Server error')->icon('bomb')->withAction('Retry', '/retry');
```

![Error](./src/Resources/assets/images/error.png)

#### 3. Warning Toast

```php
addToastWarning('Check your input')->icon('car-on')->duration('2s');
addToast('warning', 'Unsaved changes')->pin()->icon('radiation');
Toast::warning('Form incomplete')->icon('skull')->withAction('Fix', '/form');
```

![Warning](./src/Resources/assets/images/warning.png)

#### 4. Info Toast

```php
addToastInfo('Update available')->icon('infinity')->pin();
Toast::info('System restart at 10PM')->icon('clock')->withAction('Dismiss', '/dismiss');
```

![Info](./src/Resources/assets/images/info.png)

---

### ✅ With Redirects

```php
return redirect()->back()->with('success', 'Action completed!');
return redirect()->route('dashboard')->with('info', 'Welcome to the dashboard');
return redirect()->route('profile')->with('error', 'Something went wrong');
```

Or

```php
return redirect()->back()->withSuccess('Action completed!');
return redirect()->route('dashboard')->withInfo('Welcome to the dashboard');
return redirect()->route('profile')->with('error', 'Something went wrong');
```

---

### Simple toast

```php
addToast('success', 'Operation completed successfully!');

### Or use specific helpers
addToastSuccess('Saved successfully!');
addToastError('Something went wrong!');
addToastWarning('Please check your input!');
addToastInfo('Did you know?');
```

---

## Advanced Usage (Chaining Methods):

```php
addToast('success', 'User created!')
    ->title('Success') // Custom title
    ->emoji('🎉') // Add emoji (will replace icon)
    ->pin() // Make it sticky (won't auto-hide)
    ->duration(5000) // Custom duration in milliseconds
    ->position('top') // Position: top, bottom, left, right
    ->dir('rtl') // Direction: rtl or ltr
    ->theme('success'); // Custom theme
```

---

## With Action Buttons:

```php
addToast('info', 'New message received')
    ->title('Notification')
    ->emoji('📬')
    ->withAction('View', '/messages/1')
    ->withAction('Dismiss', '#');
```

---

## Confirmation Dialog:

```php
addConfirm('Are you sure you want to delete this item?')
    ->title('Confirm Delete')
    ->emoji('⚠️')
    ->link('/delete/123')        // Link for confirm button
    ->onConfirm('Yes, Delete')   // Custom confirm button text
    ->onCancel('Cancel')         // Custom cancel button text
    ->target('_self');           // Link target
```

---

## Old Session Flash (Still Supported):

```php
session()->flash('success', 'Item created!');
session()->flash('error', 'Invalid data!');
session()->flash('warning', 'Check your email!');
session()->flash('info', 'New feature available!');
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
    $this->safeDestroy($id, 'tourGuide');
    // Toast is already added in the trait!
}
```

#### Example 3: Livewire component

```php
public function save()
{
    $this->validate();

    TourGuide::create($this->form);

    addToast('success', 'Tour guide added!')
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

## 🌍 RTL & Arabic Support

All features work perfectly with Arabic text and RTL direction.

![RTL Example - Confirm](./src/Resources/assets/images/confirms_ar.png)
![RTL Example - Success](./src/Resources/assets/images/success_ar.png)
![RTL Example - Error](./src/Resources/assets/images/error_ar.png)
![RTL Example - Warning](./src/Resources/assets/images/warning_ar.png)
![RTL Example - Info](./src/Resources/assets/images/info_ar.png)

---

## 🧩 Toast Properties

```php
public $type;
public $message;
public $title = null;
public $emoji = null;
public $icon = null;
public $duration = null;
public $position = null;
public $pin = null;
public $theme = null;
public $dir = null;
public $confirm = null;
public $cancel = null;
public $actions = [];
```

| Property | Type   | Description                                  |
| -------- | ------ | -------------------------------------------- |
| type     | string | success, error, info, warning                |
| message  | string | Toast message                                |
| title    | string | Optional toast title                         |
| emoji    | string | Emoji next to title                          |
| icon     | string | Icon name (FontAwesome or emoji)             |
| duration | string | Toast duration (e.g., 2s, 500ms, 1m)         |
| position | string | Position: top, bottom, left, right           |
| pin      | bool   | If true, toast remains until manually closed |
| theme    | string | Theme color: success, error, etc.            |
| dir      | string | ltr or rtl                                   |
| confirm  | string | Confirm button label                         |
| cancel   | string | Cancel button label                          |
| actions  | array  | Array of actions [label + url]               |

---

## 💡 Future Ideas

- Toast queueing (stacked alerts)
- Audio alerts on confirm
- Persistent toasts across page loads
- Built-in animation presets (slide, fade, bounce)

---

## 🛠️ Contributing

Want to improve or suggest a feature?

- Open an issue
- Or submit a pull request

---

## 📬 Contact

- 📧 **Email**: [eslamalsayed8133@gmail.com](mailto:eslamalsayed8133@gmail.com)
- 💼 **LinkedIn**: [IslamAlsayed](https://www.linkedin.com/in/islam-alsayed7)
- 💼 **Facebook**: [IslamAlsayed](https://www.facebook.com/islamalsayed00)

---

> 🚀 Built for developers who want elegant, expressive, and flexible notifications in Laravel apps.
