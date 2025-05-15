# 1 Construction Solutions - Project Management System

## Overview

1 Construction Solutions is a comprehensive web application designed to streamline the management of construction projects, permits, and documentation. Built on Laravel, it provides a dual-interface system for both administrators and contractors/clients, facilitating efficient communication and project oversight.

## Features

### For Administrators
- **Dashboard**: Get a quick overview of projects, permits, and contractor activity
- **Contractor Management**: Easily view, add, and manage contractors
- **Permit Oversight**: Review, approve, or reject permit applications
- **Document Management**: Organize, approve, and manage project documentation
- **Messaging System**: Direct communication with contractors
- **Invoice Management**: Create and track invoices for projects

### For Contractors/Clients
- **Project Creation**: Submit and manage construction projects
- **Permit Applications**: Apply for construction permits with document attachments
- **Dashboard View**: Monitor project status, pending approvals, and recent activities
- **Document Management**: Upload and organize project-related documents
- **Communication**: Direct messaging with administrators
- **Invoice Management**: View and process payments for invoices

## Technical Architecture

- **Backend**: Laravel PHP framework
- **Frontend**: Blade templates with Tailwind CSS and Alpine.js
- **Database**: MySQL for data persistence
- **Authentication**: Laravel's built-in authentication with role-based access control
- **File Storage**: Local storage with Laravel's file system abstraction

## Key Components

- **Dual Interface**: Separate but integrated admin and client panels
- **Polymorphic Relationships**: Flexible data relationships for comments and notifications
- **Real-Time Updates**: Dashboard statistics and notifications
- **Document Preview**: Built-in previewing for PDFs and images

## Getting Started

### Prerequisites
- PHP 8.0 or higher
- Composer
- MySQL or compatible database
- Node.js and NPM (for frontend assets)

### Installation

1. Clone the repository
   ```
   git clone https://github.com/yourusername/1-construction.git
   cd 1-construction
   ```

2. Install dependencies
   ```
   composer install
   npm install
   ```

3. Set up environment variables
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database in the `.env` file

5. Run migrations and seeders
   ```
   php artisan migrate --seed
   ```

6. Compile assets
   ```
   npm run dev
   ```

7. Create symbolic link for storage
   ```
   php artisan storage:link
   ```

8. Start the development server
   ```
   php artisan serve
   ```

## Usage

### Admin Login
- Access `/login` and enter admin credentials
- Default admin: admin@example.com (customize in seeder)

### Contractor/Client Login
- Access `/login` and enter contractor credentials
- New contractors can register at `/register`

## Future Enhancements

- Integration with mapping services for project locations
- Mobile application for on-site permit verification
- Advanced reporting and analytics
- Calendar integration for project timelines
- Electronic signature for permit approvals

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements

- [Laravel Framework](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
