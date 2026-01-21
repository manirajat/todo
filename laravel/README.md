# Todo / Project Management Application

A robust Project Management application built with **Laravel 10**. This application allows users to organize their work by creating projects and managing tasks within them, potentially supporting workflows like Kanban boards.

## Features

- **Project Management**:
    - Create new projects with start and end dates.
    - Categorize projects by type.
    - Edit and update project details.
    - Delete projects.

- **Task Management**:
    - Add tasks to specific projects.
    - Manage task details including title, description, and status.
    - Set due dates for tasks.
    - Organize tasks (ordering support).

## Tech Stack

- **Framework**: [Laravel 10.x](https://laravel.com)
- **Language**: PHP 8.1+
- **Database**: MySQL (configurable)

## Installation & Setup

Follow these steps to get the project running on your local machine.

### 1. Prerequisites

Ensure you have the following installed:
- [PHP](https://www.php.net/) (v8.1 or higher)
- [Composer](https://getcomposer.org/)
- A local database server (e.g., MySQL, MariaDB)

### 2. Clone the Repository

```bash
git clone <repository_url>
cd <repository_folder>
```

### 3. Install Dependencies

Install the backend dependencies using Composer:

```bash
composer install
```

### 4. Environment Configuration

Copy the example environment file and rename it to `.env`:

```bash
cp .env.example .env
```

Open the `.env` file and configure your database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 5. Generate Application Key

Generate the unique application key:

```bash
php artisan key:generate
```

### 6. Run Migrations

Create the database tables:

```bash
php artisan migrate
```

### 7. Serve the Application

Start the local development server:

```bash
php artisan serve
```

The application will be accessible at [http://localhost:8000](http://localhost:8000).

## Usage

1.  **Dashboard**: Navigate to the home page to view a list of all existing projects.
2.  **Create Project**: Use the provided form to create a new project.
3.  **Manage Tasks**: Click on a project to enter its detailed view. Here you can add new tasks, update their status (e.g., Todo, In Progress, Done), and manage their order.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
