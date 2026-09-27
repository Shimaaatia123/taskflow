# TaskFlow — Technical Documentation

> **TaskFlow is an independently designed and developed full-stack Laravel application, built from scratch as a personal portfolio project.**

TaskFlow is a project and task management platform designed for freelancers and small teams. It combines project management, task assignment, role-based authorization, REST API functionality, bilingual localization, and a responsive SaaS-style interface.

The project was built independently from scratch, covering both backend and frontend development rather than relying on a pre-built application or template.

---

## 1. Project Goals

TaskFlow was created to demonstrate practical full-stack Laravel development through a realistic application.

The project focuses on:

* Clean Laravel application structure
* Relational database design
* Eloquent relationships
* Authentication and authorization
* Backend-enforced permissions
* RESTful API development
* API authentication with Laravel Sanctum
* Request validation
* Structured API responses
* Arabic / English localization
* RTL / LTR support
* Responsive SaaS-style UI
* Light / Dark mode

---

## 2. Core Application

TaskFlow is organized around three main entities:

```text
User
 ├── Projects
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

### Projects

Projects provide the main organizational structure of the application.

Depending on permissions, users can:

* Create projects
* View projects
* Update projects
* Delete projects
* Manage project members
* View project-related tasks

### Tasks

Tasks belong to projects and can be assigned to permitted users.

Each task supports:

* Title
* Description
* Project
* Assignee
* Priority
* Due date
* Workflow status

Available statuses:

```text
To Do
In Progress
Completed
```

---

# 3. Authorization & Permission Model

Authorization is one of the main architectural concerns of TaskFlow.

Access is determined through a combination of:

```text
User Role
     +
Project Ownership
     +
Project Membership
     +
Requested Action
```

### Roles

| Role        | Main Access                                                      |
| ----------- | ---------------------------------------------------------------- |
| **Admin**   | Full application access and user management                      |
| **Manager** | Project and task management according to application permissions |
| **Owner**   | Manage owned projects, members, and related tasks                |
| **Member**  | View permitted shared projects and tasks                         |
| **Visitor** | No protected project/task access                                 |

Permissions are enforced **server-side**.

Frontend visibility is used for user experience, but it is not treated as a security mechanism. Restricted actions remain protected when accessed directly through URLs or requests.

---

# 4. Database Design

TaskFlow uses **MySQL**, Laravel migrations, and Eloquent ORM.

The main relationships are:

```text
User
 ├── hasMany → Owned Projects
 ├── belongsToMany → Projects
 └── hasMany → Assigned Tasks

Project
 ├── belongsTo → Owner
 ├── belongsToMany → Members
 └── hasMany → Tasks

Task
 ├── belongsTo → Project
 └── belongsTo → Assigned User
```

The project membership relationship allows users to participate in multiple projects while keeping ownership separate from membership.

This relationship structure is also used by the authorization layer when determining whether an operation is permitted.

---

# 5. REST API

TaskFlow provides a RESTful API for its main resources.

### Resources

* Projects
* Tasks
* Users

### Projects

```http
GET     /api/projects
POST    /api/projects
GET     /api/projects/{project}
PUT     /api/projects/{project}
PATCH   /api/projects/{project}
DELETE  /api/projects/{project}
```

### Tasks

```http
GET     /api/tasks
POST    /api/tasks
GET     /api/tasks/{task}
PUT     /api/tasks/{task}
PATCH   /api/tasks/{task}
DELETE  /api/tasks/{task}
```

### Users

```http
GET     /api/users
POST    /api/users
GET     /api/users/{user}
PUT     /api/users/{user}
PATCH   /api/users/{user}
DELETE  /api/users/{user}
```

The API uses dedicated route naming conventions:

```text
api.projects.*
api.tasks.*
api.users.*
```

---

# 6. API Authentication & Security

The API is protected using **Laravel Sanctum**.

The general request flow is:

```text
API Request
     ↓
Authentication
     ↓
Authorization
     ↓
Validation
     ↓
Controller
     ↓
Eloquent / Database
     ↓
API Resource
     ↓
JSON Response
```

The API handles common error conditions including:

```text
401 — Unauthenticated
403 — Forbidden
404 — Resource Not Found
```

API responses are structured through Laravel API Resources rather than exposing model data directly.

---

# 7. Validation & Data Handling

Incoming data is validated before being processed.

Validation is applied to operations such as:

* Project creation
* Project updates
* Task creation
* Task updates
* User operations
* API requests

This keeps invalid data from reaching the main application logic and provides predictable behavior for both web and API requests.

---

# 8. Pagination

Project and task API collections support pagination.

Example:

```http
GET /api/projects?per_page=10
```

Pagination helps prevent large collections from being returned in a single response.

---

# 9. Localization

TaskFlow supports:

* **English**
* **Arabic**

The interface supports both:

```text
English → LTR
Arabic  → RTL
```

Localization is integrated into the application so the same core workflows remain available in both languages.

---

# 10. User Interface

The frontend combines Laravel Blade with Bootstrap and lightweight JavaScript technologies.

### Frontend stack

* Blade
* Bootstrap 5
* Bootstrap Icons
* Alpine.js
* JavaScript
* CSS
* Vite

The interface includes:

* Responsive navigation
* Sidebar
* Dashboard statistics
* Project cards
* Task cards
* Search
* Status filtering
* Priority indicators
* Due-date information
* Permission-aware actions
* Responsive layouts

The visual design follows a modern SaaS direction with glassmorphism-inspired surfaces, cards, badges, gradients, and consistent spacing and typography.

---

# 11. Light & Dark Mode

TaskFlow supports:

* Light mode
* Dark mode

The selected theme is persisted in the browser.

The interface is designed to maintain consistent layouts and usability across both themes.

---

# 12. Architecture

TaskFlow follows Laravel's MVC architecture.

### Web application flow

```text
Browser
   ↓
Web Route
   ↓
Controller
   ↓
Validation / Authorization
   ↓
Eloquent Model
   ↓
MySQL
   ↓
Blade View
```

### API flow

```text
API Client
   ↓
API Route
   ↓
Sanctum Authentication
   ↓
Authorization
   ↓
Validation
   ↓
Controller
   ↓
Eloquent Model
   ↓
API Resource
   ↓
JSON Response
```

This separation allows the web interface and REST API to use the same underlying application models and relationships while maintaining different response layers.

---

# 13. Project Structure

TaskFlow follows Laravel's conventional project structure.

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
└── views/

routes/
├── api.php
└── web.php
```

The application keeps web and API routing separate while sharing the same core domain models.

---

# 14. Development & Testing

TaskFlow was developed incrementally from the initial database structure through backend functionality, API development, authorization, localization, and frontend refinement.

The REST API was tested during development using **Postman**.

Testing and verification focused on:

* CRUD operations
* Authentication
* Authorization
* Validation
* HTTP status codes
* JSON responses
* Project relationships
* Task relationships
* Pagination
* Restricted actions

Backend permissions were also verified against different user roles and project relationships.

---

# 15. Technology Stack

### Backend

* Laravel 12
* PHP 8.2
* MySQL
* Eloquent ORM
* Laravel Sanctum
* Laravel Breeze
* Blade
* Alpine.js

### Frontend

* Bootstrap 5
* Bootstrap Icons
* JavaScript
* CSS
* Vite

### Development Tools

* Git
* GitHub
* Visual Studio Code
* Postman

---

# 16. Installation

### Requirements

* PHP 8.2+
* Composer
* Node.js & npm
* MySQL
* Git

### Clone

```bash
git clone https://github.com/Shimaaatia123/taskflow.git
cd taskflow
```

### Install dependencies

```bash
composer install
npm install
```

### Environment

Create `.env` from `.env.example` and configure the MySQL connection.

Example:

```env
DB_DATABASE=taskflow
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Application key

```bash
php artisan key:generate
```

### Database

Create the database and run:

```bash
php artisan migrate
```

### Build assets

```bash
npm run build
```

### Run application

```bash
php artisan serve
```

For frontend development:

```bash
npm run dev
```

---

# 17. Future Improvements

Potential future enhancements include:

* Task comments
* Activity history
* In-app notifications
* Expanded automated feature testing
* Expanded automated API testing

These items are intentionally documented as future improvements and are not presented as currently implemented features.

---

# 18. Project Ownership

TaskFlow is an **independently designed and developed personal portfolio project, built from scratch**.

The project covers both backend and frontend responsibilities, including:

* Application architecture
* Database design
* Laravel development
* Authentication
* Authorization
* REST API development
* Validation
* UI implementation
* Localization
* Responsive design
* API testing
* Iterative refinement

The purpose of the project is to demonstrate practical full-stack development ability through an independently built application with realistic business rules and technical requirements.

---

## Repository

**TaskFlow — Full-Stack Laravel Project**

https://github.com/Shimaaatia123/taskflow
