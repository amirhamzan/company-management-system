# Company Management System

A robust Laravel-based CRUD application designed to manage corporate structures and personnel. This project utilizes the **Inertia.js** stack, combining the power of **Laravel** with the reactivity of **Vue 3** and the polished UI components of **Ant Design Vue**.

## Tech Stack & Packages

* **Language:** PHP 8.2
* **Framework:** Laravel 11.x
* **Frontend:** Vue 3 (Composition API)
* **Bridge:** InertiaJS
* **Starter Kit:** Laravel Breeze (Authentication)
* **UI Library:** Ant Design Vue 4.x
* **Styling:** Tailwind CSS
* **Database:** SQLite

---

## Features

### 1. Authentication & Security
* **Breeze Integration:** Full login functionality with the Registration feature removed for security.
* **Role-Based Access Control (RBAC):** * `admin@grtech.com`: Full access to Companies and Employees CRUD.
    * `user@grtech.com`: Restricted from accessing management routes via custom **Middleware**.
* **Auth Middleware:** All management routes are protected and require a valid session.

### 2. Companies Management
* **CRUD Operations:** Full Create, Read, Update, and Delete capabilities.
* **Media Handling:** Logos are stored in `storage/app/public` and linked via `php artisan storage:link`.
* **Data Structure:** Name (Required), Email, Logo, and Website.

### 3. Employees Management
* **CRUD Operations:** Full management of staff members.
* **Relational Data:** Employees are linked to Companies via foreign keys.
* **Data Structure:** First Name (Required), Last Name (Required), Company (Relationship), Email, and Phone.

### 4. Advanced UI Components (Ant Design Vue)
* **Server-Side Data Tables:** High-performance tables for both Companies and Employees featuring:
    * Server-side pagination.
    * Custom column rendering (Clickable website links, Logo previews).
    * **Interactive Company Links:** Clicking a company name in the Employee list opens a detailed info modal.

---

## Database Implementation

* **Migrations:** Structured schemas for `companies` and `employees` with proper cascading deletes and foreign key constraints.
* **Seeding:** Automated seeder to generate the default Admin and User accounts upon installation.
* **Resources:** Implementation of **Laravel API Resources** and **Collections** to ensure a standardized JSON structure between the server and the Ant Design components.

---

## Installation & Setup

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/amirhamzan/company-management-system.git
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install JS dependencies:**
    ```bash
    npm install && npm run build
    ```

4.  **Environment Setup:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Database & Seeding:**
    ```bash
    php artisan migrate --seed
    ```

6.  **Storage Link:**
    ```bash
    php artisan storage:link
    ```

7.  **Run the Project:**
    ```bash
    php artisan serve
    ```

---

## Default Credentials

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@grtech.com` | `password` |
| **Standard User** | `user@grtech.com` | `password` |