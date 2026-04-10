# MyTodo - Modern and Secure Task Manager

MyTodo is a premium, high-performance To-Do List application built with Laravel 12. Designed with a Security-First philosophy, it features a professional Blue and White modern UI, dark mode support, and robust protection against common web vulnerabilities.

## Key Features

- **Modern UI/UX**: Clean design system with glassmorphism and smooth transitions.
- **Smart Dark Mode**: Persistent theme toggle with a zero-flash initialization script.
- **AJAX-Powered**: Task toggling, searching, and filtering without page reloads.
- **Comprehensive Authentication**: Secure registration, login, and session management.
- **Mobile First**: Fully responsive design optimized for various screen sizes.

## Security Architecture

- **Content Security Policy (CSP)**: Hardened headers to mitigate XSS and data injection.
- **Script Nonces**: All internal scripts are protected by unique, one-time security nonces.
- **Brute Force Protection**: Advanced rate limiting on authentication routes.
- **SQLi Protection**: Powered by Eloquent ORM with strictly bound parameters.
- **CSRF Hardening**: Standardized AJAX headers for secure cross-site communication.

## Installation and Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Irfan3006/MyTodo-Laravel.git
   cd MyTodo-Laravel
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Configure Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database**:
   Configure your database in the .env file, then run:
   ```bash
   php artisan migrate
   ```

5. **Serve the application**:
   ```bash
   php artisan serve
   ```

## License

The MyTodo application is open-sourced software licensed under the MIT license.
