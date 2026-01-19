# BudgetX

BudgetX is a full-stack SaaS budget tracking application built with PHP (MVC), MySQL, and Tailwind CSS.

## Features

- **Authentication**: Secure login/registration with role-based access control.
- **Dashboard**: Financial overview with income/expense tracking and charts.
- **Income & Expenses**: detailed record keeping.
- **Goals**: Set and track financial goals with progress bars.
- **Shared Goals**: Premium feature for collaborative saving.
- **Admin Panel**: Audit logs and system activity.
- **PWA Support**: Installable on mobile devices.
- **Responsive Design**: Blue-themed, desktop-first but mobile-ready UI.

## Setup Instructions

1.  **Database Configuration**:
    -   Ensure MySQL is running (XAMPP Control Panel).
    -   Create a database named `budgetx` (or let the setup script do it).
    -   Import `database.sql` or run the setup script.

2.  **Run Setup Script**:
    -   Open your browser to: `http://localhost/BudgetX/public/setup.php`
    -   Click "Run Database Setup".

3.  **Application Access**:
    -   Navigate to `http://localhost/BudgetX/public/`

## Default Credentials

-   **Admin User**:
    -   Email: `admin@budgetx.com`
    -   Password: `password123`
    -   Role: Admin (Access to Admin Panel)

## Development

-   **CSS Build**:
    ```bash
    npm run build:css
    ```
    This watches for changes in PHP files and updates `public/css/output.css`.

## Tech Stack

-   **Backend**: PHP 8.x (PDO)
-   **Frontend**: HTML5, Tailwind CSS v4, JavaScript, Chart.js
-   **Database**: MySQL