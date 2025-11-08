# Changelog

All notable changes to `laravel-toasts` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Comprehensive testing suite with PHPUnit
- Unit tests for ToastFactory and ToastManager
- Feature tests for all helper functions
- GitHub Actions workflow for automated testing
- Orchestra Testbench integration

### Changed

- Enhanced README with Livewire integration examples
- Updated composer.json with testing dependencies
- Improved documentation structure

## [1.0.0] - 2025-01-21

### Added

- Initial release
- Toast notification system with multiple types (success, error, danger, warning, info)
- Confirmation dialog system
- Emoji support for toast notifications 🎉
- Configurable position (top, bottom, left, right)
- Customizable duration and animations
- Pin support for persistent notifications
- Artisan command to inject toast view into layouts (`php artisan toasts:inject`)
- **Livewire 3.x integration** with event dispatching
- **JavaScript API** for client-side toast management (`window.pushToast`, `window.pushToastConfirm`)
- Comprehensive helper functions (showToast, showToastSuccess, showToastErrorMessage, etc.)
- FontAwesome icon support
- **Full RTL support** with Arabic language compatibility
- Action buttons with custom callbacks
- HandlesCrudSafely trait for safe CRUD operations

### Features

- **Chainable builder pattern** for fluent API
- Session-based toast persistence
- Automatic layout injection with body tag detection
- **Granular asset publishing** with individual tags (toast-config, toast-views, toast-css, toast-js, toast-webfonts)
- Multiple color themes
- Configurable animations (enter, exit, visible time)
- ES6 module system for JavaScript
- Responsive design
- Browser console testing support

### Configuration

- Environment-based configuration via `.env`
- Customizable default messages and titles
- Animation timing controls
- Default theme and position settings
- Pin behavior for confirmations

### Documentation

- Comprehensive README with examples
- Installation guide
- Configuration instructions
- Basic and advanced usage examples
- Livewire integration guide
- JavaScript usage documentation
- Testing guide
- Contributing guidelines
- MIT License

---

## Upgrade Guide

### From 0.x to 1.0

This is the initial stable release. If migrating from a development version:

1. Republish assets: `php artisan vendor:publish --tag=toast-all --force`
2. Clear config cache: `php artisan config:clear`
3. Update any custom implementations to use the new helper functions

---

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this project.
