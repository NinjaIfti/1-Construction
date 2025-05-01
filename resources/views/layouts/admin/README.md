# Admin Views Structure

This directory contains all admin-related views for the application. All admin views should be placed in this folder or its subdirectories.

## Directory Structure

- `dashboard.blade.php` - Main admin dashboard view
- `/contractors` - Views related to contractor management
- `/verifications` - Views related to verification management
- (Add additional admin module directories as needed)

## Standards and Guidelines

1. All admin views should extend the admin layout:
   ```php
   @extends('layouts.admin.app')
   ```

2. Use consistent section names:
   ```php
   @section('title', 'Admin Dashboard')
   @section('content')
       <!-- View content here -->
   @endsection
   ```

3. Keep admin-related CSS and JavaScript within admin assets
4. Use proper naming conventions for files and variables
5. Maintain consistent indentation and formatting

## Adding New Admin Views

When adding new admin view modules:
1. Create a new directory under `/layouts/admin/`
2. Add appropriate routes in the admin route group in `routes/web.php`
3. Create controller(s) in the `App\Http\Controllers\Admin` namespace
4. Update this README to document the new module 