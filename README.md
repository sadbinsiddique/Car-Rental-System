# Car Rental System

## 1. Introduction

This project is a web-based Car Rental System designed to facilitate the management of car rentals, user accounts, and vehicle inventory. It provides a platform for customers to browse and book vehicles, for vehicle owners to list their cars, and for administrators to manage the overall system.
The system features role-based access control, directing users to specific dashboards (Admin, Customer, Driver/Owner) upon login.

## 2. Features

### Implemented Features:
*   **User Authentication**: Secure registration and login functionality for all user types.
*   **Role-Based Dashboards**:
    *   **Admin Dashboard**: Centralized management interface for administrators.
        *   Links for User Management (List Users, Register New User, Register New Driver, Register New Owner).
        *   Links for Vehicle Management (List Vehicles, Register New Car).
        *   Links for Booking Management (List Bookings).
        *   (Note: Backend CRUD operations for these links are in progress).
    *   **Customer Dashboard**: Personalized space for customers (details to be implemented).
    *   **Driver/Owner Dashboard**: Interface for drivers/owners (details to be implemented).
*   **Role-Based Access Control**: Secure routing and access protection for dashboards and specific functionalities based on user roles (admin, super_admin, customer, driver, owner).
*   **Homepage**: Includes a "Showroom" section for customers to view available cars (dynamic loading and 3D viewing are planned).
*   **Checkout Process (Basic)**:
    *   Page for users to input rental details (pickup/dropoff location, dates, estimated distance).
    *   Dynamic price calculation based on vehicle's `cost_per_km`, distance, and basic location-based surcharges.
    *   (Note: Full booking creation, payment integration, and advanced fare calculation are pending).
*   **Password Management**: Forgot password and reset password functionality (structure in place).

### Planned/Future Features:
*   Full CRUD (Create, Read, Update, Delete) operations for Admin dashboard sections (Users, Vehicles, Bookings).
*   Dynamic vehicle listing in the Showroom with images and details.
*   Advanced fare calculation (incorporating duration, daily rates, insurance, add-ons, taxes).
*   Complete booking management system.
*   Payment gateway integration.
*   User profile management.
*   Vehicle details page with 3D viewing capabilities.
*   Search and filtering for vehicles.
*   Rating and review system for vehicles and drivers.
*   Notifications system.

## 3. Tech Stack

*   **Backend**: PHP (following an MVC-like architectural pattern)
*   **Database**: MySQL
*   **Frontend**: HTML, CSS, JavaScript (minimal JS used so far)
*   **Web Server**: Apache (typically used with XAMPP/WAMP)

## 4. Project Structure

```
Car-Rental-System/
├── app/
│   ├── controllers/  # Handles user requests, business logic
│   ├── core/         # Core framework classes (App router, Controller, Model, Database)
│   ├── models/       # Database interaction logic
│   ├── views/        # Presentation layer (PHP/HTML templates)
│   └── helpers/      # (Optional, if you add helper functions)
├── database/         # SQL schema, sample data
│   ├── car_rental_schema.sql
│   └── insert_sample_data.sql
├── public/           # Web server document root, entry point
│   ├── assets/       # Images, fonts, etc.
│   ├── css/          # CSS stylesheets
│   ├── js/           # JavaScript files
│   └── index.php     # Main entry point for all requests
│   └── .htaccess     # Apache rewrite rules
├── vendor/           # (If Composer is used for dependencies)
└── README.md         # This file
```

*   `app/controllers`: Contains controller classes like `AuthController.php`, `AdminController.php`, `CheckoutController.php`.
*   `app/core`: Includes `App.php` (routing), `Controller.php` (base controller), `Model.php` (base model), `Database.php` (database connection).
*   `app/models`: Contains model classes like `User.php`, `Vehicle.php`.
*   `app/views`: Organized by feature/controller (e.g., `auth/`, `admin/`, `checkout/`, `layouts/`).
*   `public`: Contains all publicly accessible files. `index.php` acts as the front controller.
*   `database`: Stores SQL files for database schema creation and sample data insertion.

## 5. Setup and Installation

### Prerequisites:
*   A web server environment like XAMPP, WAMP, MAMP, or LAMP.
    *   PHP (version 7.4+ recommended)
    *   MySQL/MariaDB
    *   Apache webserver with `mod_rewrite` enabled.
*   A database management tool (e.g., phpMyAdmin, DBeaver).

### Steps:

1.  **Clone/Download Project**:
    *   Place the project files in your web server's document root (e.g., `htdocs` for XAMPP).
    *   The project root directory will be `Car-Rental-System`.

2.  **Database Setup**:
    *   Open your database management tool (e.g., phpMyAdmin).
    *   Create a new database. For example, name it `car_rental_system`.
    *   Select the created database and import the schema from `database/car_rental_schema.sql`.
    *   (Optional) To populate the database with sample data, import `database/insert_sample_data.sql`.

3.  **Configure Database Connection**:
    *   Open `app/core/Database.php`.
    *   Update the database connection parameters if they differ from the defaults:
        ```php
        private $host = 'localhost';
        private $user = 'root'; // Your DB username
        private $pass = '';      // Your DB password
        private $dbname = 'car_rental_system'; // Your DB name
        ```

4.  **Web Server Configuration (Apache)**:
    *   Ensure `mod_rewrite` is enabled in your Apache configuration.
    *   The document root for your site should ideally point to the `Car-Rental-System/public` directory. If you are running it from a subdirectory (e.g., `http://localhost/Car-Rental-System/`), the `.htaccess` file in the `public` directory and the `BASE_URL` constant in `public/index.php` are configured to handle this.
    *   The `BASE_URL` is dynamically determined in `public/index.php` but ensure it resolves correctly. It should be something like `http://localhost/Car-Rental-System` (without `/public` at the end if using the root `.htaccess` or if `public` is the document root).
    *   The `<base href="<?= BASE_URL ?>/">` in `app/views/layouts/main.php` relies on this `BASE_URL`.

5.  **File Permissions (if on Linux/macOS)**:
    *   Ensure that web server has write permissions for any directories where file uploads will occur (e.g., `public/uploads/` if you create such a directory for vehicle images, etc.).

## 6. Running the Application

*   Start your Apache and MySQL services from XAMPP/WAMP Control Panel.
*   Open your web browser and navigate to the `BASE_URL` (e.g., `http://localhost/Car-Rental-System/` or `http://localhost/Car-Rental-System/public` depending on your setup).

## 7. Key Functionalities & Usage

*   **Homepage**: `http://localhost/Car-Rental-System/`
*   **Registration**: Navigate to `/auth/register`.
*   **Login**: Navigate to `/auth/login`.
    *   **Admin Login**: Use admin credentials. Redirects to `/admin/index`.
    *   **Customer Login**: Use customer credentials. Redirects to `/customer/index`.
    *   **Driver/Owner Login**: Use driver/owner credentials. Redirects to `/driver/index`.
*   **Admin Dashboard**: Access `/admin/index` (requires admin login).
*   **Checkout Page**: Access `/checkout/index/{vehicle_id}` (e.g., `/checkout/index/1`). Requires login and a valid, existing vehicle ID.

## 8. Database Structure Overview

The database schema (`database/car_rental_schema.sql`) defines the following key tables:

*   `users`: Stores information for all user types (admins, customers, riders/drivers, owners).
*   `customer_profiles`: Additional details for customers.
*   `rider_profiles`: Details specific to riders/drivers, including license information.
*   `owner_profiles`: Details specific to vehicle owners.
*   `vehicles`: Information about the rental vehicles, including `cost_per_km`, `location`, etc.
*   `bookings`: Records of vehicle bookings, including pickup/dropoff details, price, and status.
*   `payments`: Payment transaction details related to bookings.
*   `ratings`: Stores ratings and reviews for vehicles and riders.
*   `damage_reports`: For reporting and managing vehicle damages.
*   `notifications`: System-wide notifications for users.
*   `otps`: For One-Time Passwords used in email verification and password resets.
*   `coupons`: Discount coupon information.
*   (Other tables for system settings, logs, etc. might be present or added later)

## 9. Development Notes

*   **Routing**: Managed in `app/core/App.php`. New routes can be added by extending the switch case in the `parseUrl()` or a similar method that handles controller loading.
*   **Controllers**: Create new controller files in `app/controllers/`. They should extend the base `Controller` class.
*   **Models**: Create new model files in `app/models/`. They should extend the base `Model` class.
*   **Views**: Create new view files in `app/views/` typically within a subdirectory named after the controller.
*   **Error Reporting**: Ensure PHP error reporting is enabled during development (e.g., `error_reporting(E_ALL); ini_set('display_errors', 1);` in `public/index.php` or php.ini).

## 10. Troubleshooting

*   **404 Errors**: Check `.htaccess` rules, `BASE_URL` configuration, and controller/method naming in `app/core/App.php`.
*   **Database Connection Errors**: Verify credentials and database name in `app/core/Database.php`.
*   **Styling Issues**: Ensure CSS paths are correct, especially with `BASE_URL`. Check browser console for errors.
*   **Redirect Loops**: Often caused by incorrect session handling or routing logic in authentication checks.

---
This README provides a comprehensive overview. As the project evolves, remember to update this file, especially the "Features" and "Setup" sections.
