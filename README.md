# TaskFlow

### Full-Stack Laravel Project & Task Management Platform

TaskFlow is a **full-stack project and task management platform built from scratch with Laravel 12**, designed for freelancers and small teams to organize projects, manage tasks, assign team members, track priorities and deadlines, and control access through role-based permissions.

The project focuses on **clean Laravel development, backend-enforced authorization, relational database design, REST API development, bilingual localization, and a polished responsive SaaS-style interface**.

---

## Overview

TaskFlow provides a structured workflow for managing projects and tasks while ensuring that users can only perform actions permitted by their role and relationship to the project.

The application combines a Laravel web application with a secured REST API and a responsive bilingual interface.

### Core capabilities

* Project management
* Task management
* Project ownership and membership
* Task assignment
* Priorities and due dates
* Task workflow statuses
* Role-based authorization
* Backend-enforced permissions
* RESTful API
* Laravel Sanctum authentication
* API Resources and pagination
* Request validation
* Arabic / English localization
* RTL / LTR interface support
* Light / Dark mode
* Responsive SaaS-style UI
* MySQL relational database

---

## Key Features

### Project Management

* Create, view, update, and delete projects according to the user's permissions
* Assign project ownership
* Add and remove project members
* View project members and related tasks
* Manage project information and status

### Task Management

* Create tasks within projects
* Assign tasks to permitted project members
* Set task priority
* Set due dates
* Track task workflow
* Search and filter tasks

Available task statuses:

* **To Do**
* **In Progress**
* **Completed**

### User & Access Control

TaskFlow uses role-based permissions combined with project ownership and membership rules.

| Role        | Access                                                           |
| ----------- | ---------------------------------------------------------------- |
| **Admin**   | Full application access, including user management               |
| **Manager** | Project and task management according to application permissions |
| **Owner**   | Manage owned projects, members, and related tasks                |
| **Member**  | View permitted shared projects and tasks                         |

Authorization is enforced **server-side**. Hiding a button in the interface is not treated as a security mechanism; restricted actions are also blocked by the backend.

---

## Permission Model

TaskFlow distinguishes between **role-level permissions** and **project-level ownership/membership**.

The general access model is:

```text
Admin
 └── Full application access

Manager
 └── Project & task management within allowed permissions

Owner
 └── Own projects
      ├── Manage project
      ├── Manage members
      └── Manage related tasks

Member
 └── Shared projects
      └── View permitted project/task data

Visitor
 └── No protected project/task access
```

This approach keeps authorization decisions on the server and prevents users from bypassing restrictions through direct URLs or manipulated requests.

---

## REST API

TaskFlow includes a RESTful API protected by **Laravel Sanctum**.

### API Resources

* Projects
* Tasks
* Users

### Project Endpoints

```http
GET     /api/projects
POST    /api/projects
GET     /api/projects/{project}
PUT     /api/projects/{project}
PATCH   /api/projects/{project}
DELETE  /api/projects/{project}
```

### Task Endpoints

```http
GET     /api/tasks
POST    /api/tasks
GET     /api/tasks/{task}
PUT     /api/tasks/{task}
PATCH   /api/tasks/{task}
DELETE  /api/tasks/{task}
```

### User Endpoints

```http
GET     /api/users
POST    /api/users
GET     /api/users/{user}
PUT     /api/users/{user}
PATCH   /api/users/{user}
DELETE  /api/users/{user}
```

### API capabilities

The API includes:

* Laravel Sanctum authentication
* Role-based authorization
* Request validation
* Laravel API Resources
* Pagination
* Structured JSON responses
* `401 Unauthenticated` handling
* `403 Forbidden` handling
* `404 Resource not found` handling

API routes use dedicated route naming conventions such as:

```text
api.projects.*
api.tasks.*
api.users.*
```

API endpoints were tested during development using **Postman**.

---

## Database Design

TaskFlow uses **MySQL** with Laravel migrations and Eloquent relationships.

The main entities are:

```text
User
 ├── Owned Projects
 ├── Project Memberships
 └── Assigned Tasks

Project
 ├── Owner
 ├── Members
 └── Tasks

Task
 ├── Project
 └── Assigned User
```

### Relationship Model

* A user can own multiple projects.
* Users can belong to multiple projects through project membership.
* A project can contain multiple tasks.
* A task belongs to a project.
* Tasks can be assigned to users according to the application's permission rules.

The relational structure is implemented using **Eloquent models and relationships**, with database changes managed through Laravel migrations.

---

## Localization

TaskFlow supports a bilingual interface:

* **English**
* **Arabic**

The interface supports both:

```text
English → LTR
Arabic  → RTL
```

Localized content is handled through Laravel's localization system, allowing the same application workflow to operate in both languages.

---

## UI & User Experience

TaskFlow uses a modern SaaS-inspired interface designed around clarity and usability.

### Interface features

* Responsive layout
* Sidebar navigation
* Dashboard statistics
* Project cards
* Task cards
* Search
* Status filtering
* Priority indicators
* Due-date display
* Permission-aware actions
* Arabic RTL layout
* English LTR layout
* Light mode
* Dark mode

The UI uses a **glassmorphism-inspired visual language**, with consistent cards, badges, spacing, typography, and responsive layouts.

### Theme Support

Users can switch between:

* Light mode
* Dark mode

The selected theme is persisted in the browser.

---

## Tech Stack

### Backend

* **Laravel 12**
* **PHP 8.2**
* **MySQL**
* **Eloquent ORM**
* **Laravel Sanctum**
* **Laravel Breeze**
* **Blade**
* **Alpine.js**

### Frontend

* **Bootstrap 5**
* **Bootstrap Icons**
* **JavaScript**
* **CSS**
* **Vite**

### Development & API Tools

* **Git**
* **GitHub**
* **VS Code**
* **Postman**

---

## Architecture

TaskFlow follows Laravel's MVC architecture while separating responsibilities across the application's web and API layers.

```text
                    ┌─────────────────────┐
                    │       Browser       │
                    │  Blade / Bootstrap  │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │       Web Routes    │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │     Controllers     │
                    └──────────┬──────────┘
                               │
                  ┌────────────┴────────────┐
                  ▼                         ▼
        ┌──────────────────┐      ┌──────────────────┐
        │ Validation /     │      │ Authorization /  │
        │ Request Handling │      │ Permission Rules │
        └────────┬─────────┘      └────────┬─────────┘
                 └────────────┬────────────┘
                              ▼
                    ┌─────────────────────┐
                    │ Eloquent Models     │
                    │ & Relationships     │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │       MySQL         │
                    └─────────────────────┘


                    REST API Layer
                           │
                           ▼
                    ┌─────────────────────┐
                    │   API Routes        │
                    │   Sanctum Auth      │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │ API Resources       │
                    │ Validation          │
                    │ Authorization       │
                    │ Pagination          │
                    └─────────────────────┘
```

### Separation of concerns

The application keeps the main responsibilities separated:

* **Routes** define application endpoints.
* **Controllers** handle application flow.
* **Validation** handles incoming data rules.
* **Authorization** controls access to protected actions.
* **Models** represent application entities and relationships.
* **API Resources** control API response structure.
* **Blade views** handle the web interface.
* **Eloquent** manages database interaction.

---

## Project Structure

The project follows Laravel's conventional structure, with dedicated areas for web and API functionality.

```text
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
├── Models/
└── ...

database/
└── migrations/

resources/
├── views/
└── ...

routes/
├── api.php
└── web.php
```

The structure keeps backend logic organized while allowing the web interface and REST API to use the same underlying domain models and relationships.

---

## Installation

### Requirements

Make sure the following are installed:

* PHP 8.2+
* Composer
* Node.js & npm
* MySQL
* Git

### 1. Clone the repository

```bash
git clone https://github.com/Shimaaatia123/taskflow.git
cd taskflow
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Create the environment file

```bash
cp .env.example .env
```

On Windows, you can also copy the file manually:

```text
.env.example → .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Configure the database

Update the database values in `.env`:

```env
DB_DATABASE=taskflow
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Create the corresponding MySQL database, then run:

```bash
php artisan migrate
```

### 7. Build frontend assets

```bash
npm run build
```

### 8. Start the Laravel server

```bash
php artisan serve
```

The application will be available through the local Laravel development server.

For frontend development with Vite:

```bash
npm run dev
```

---

## Screenshots

Screenshots will be maintained in the repository under the project's documentation/assets directory.

Suggested documentation structure:

```text
docs/
└── screenshots/
    ├── landing-page.png
    ├── dashboard-dark.png
    ├── dashboard-light.png
    ├── projects.png
    └── tasks-ar-light.png
```

### Landing Page

<!-- Add screenshot here -->

### Dashboard — Dark Mode

<!-- Add screenshot here -->

### Dashboard — Light Mode

<!-- Add screenshot here -->

### Projects

<!-- Add screenshot here -->

### Tasks — Arabic / RTL

<!-- Add screenshot here -->

---

## What This Project Demonstrates

TaskFlow was built as a practical full-stack project to demonstrate the ability to work across the main layers of a Laravel application:

* Building a Laravel application from scratch
* Designing relational database structures
* Working with Eloquent relationships
* Implementing role-based authorization
* Enforcing permissions on the backend
* Building RESTful APIs
* Securing APIs with Laravel Sanctum
* Using API Resources
* Implementing validation
* Handling API errors
* Supporting Arabic and English interfaces
* Building RTL and LTR layouts
* Creating responsive SaaS-style interfaces
* Working with Git and GitHub
* Testing API behavior with Postman

---

## Future Improvements

Potential future enhancements include:

* Task comments
* Activity history
* In-app notifications
* Expanded automated feature and API test coverage

---

## License

This project was created as a personal portfolio project.

---

### TaskFlow

**A full-stack Laravel project demonstrating practical application architecture, authorization, REST API development, relational data modeling, localization, and responsive SaaS UI.**
