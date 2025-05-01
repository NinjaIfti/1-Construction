# Admin Controllers

This directory contains all admin-related controllers for the application. All controllers that handle admin functionality should be placed in this namespace.

## Structure and Organization

- `AdminController.php` - Base controller that all admin controllers should extend
- `DashboardController.php` - Manages the admin dashboard display
- `ContractorController.php` - Handles contractor management
- `VerificationController.php` - Manages verification requests
- (Add additional controllers as needed for new admin functionality)

## Guidelines for Admin Controllers

1. All admin controllers must extend `AdminController`:
   ```php
   class YourController extends AdminController
   ```

2. Routes should be organized in the admin group in `routes/web.php` with the prefix 'admin.' and appropriate middleware.

3. Each controller should handle a specific admin domain/functionality.

4. Use proper documentation with PHPDoc comments for all methods.

5. Views should be placed in the corresponding directories under `resources/views/layouts/admin/`.

## Creating New Admin Controllers

When adding new admin functionality:
1. Create a new controller in this directory that extends `AdminController`
2. Add appropriate routes in the admin route group in `routes/web.php`
3. Create view files in the `resources/views/layouts/admin/` directory
4. Update this README to document the new controller 