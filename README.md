# Healthcare Portal - Web Framework Programming Project

This project is a **Healthcare Portal** web application developed as a class activity for the Semester 6 **Web Framework Programming (WFP)** course. It is designed to simulate the management of healthcare services, medical articles, doctor appointments, and consultation transactions.

The application is built using **Laravel 10** with an admin panel interface integrated with **AdminLTE 4**, focusing on enhanced user experience through **AJAX Modals CRUD** operations.

## Key Features

- **Doctor & Article Management**: Associates doctors with the medical articles they author using a *One-to-Many* relationship.
- **Category & Service Cataloging**: Dynamic classification of medical services and health articles by categories.
- **Transaction & Booking System**: Facilitates consultation bookings and medical service checkouts (using a *Many-to-Many* relationship with the `service_transaction` pivot table).
- **AJAX CRUD Modals**: Interactive Create, Read, Update, and Delete (CRUD) operations utilizing Bootstrap Modals and AJAX (without reloading the page for a smoother UX).
- **Soft Deletes**: Secure soft-deletion implementation for critical entities such as Transactions.
- **Admin Dashboard**: A clean, responsive, and intuitive administration panel powered by AdminLTE 4.

## Tech Stack

- **Core Framework**: PHP ^8.1 & Laravel ^10.0
- **Database**: MySQL (Eloquent ORM, Migrations, & Seeders)
- **Frontend / UI Layout**: Laravel Blade, Bootstrap / TailwindCSS, AdminLTE 4
- **Asynchronous Actions**: AJAX (jQuery / Axios)
