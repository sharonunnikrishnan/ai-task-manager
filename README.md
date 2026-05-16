# AI Assisted Task Management System

A Laravel-based AI Assisted Task Management System built as part of a machine test.

The application allows users to create, manage, and track tasks with AI-generated summaries (Mocked AI responses are used for stability and demonstration purposes) and priority analysis.

---

# Tech Stack

## Backend

* Laravel 13
* PHP 8.3
* MySQL
* Repository Pattern
* Service Layer Architecture
* REST API
* Laravel Policies
* Laravel Breeze Authentication

## Frontend

* Blade Templates
* Tailwind CSS 

## AI Integration

* Dedicated AIService layer
* Mocked AI response implementation
* Architecture prepared for OpenAI integration

---

# Features

## Authentication

* User Registration
* User Login
* User Logout
* Protected Routes

---

## Task Management

* Create Task
* Edit Task
* Delete Task
* View Task Details
* Task Status Management
* Task Assignment

---

## AI Features (Mocked AI responses used for stability and demonstration purposes)

* AI-generated task summary
* AI-generated priority analysis
* AI insights section in task detail page
* AI processing simulation during task creation

---

## Dashboard

* Total Tasks
* Pending Tasks
* Completed Tasks
* High Priority Tasks
* Recent Tasks Table
* Task Analytics Chart using Chart.js

---

## Authorization

### Admin

* Full access to all tasks
* Can edit any task
* Can delete any task

### User

* Can view assigned tasks only
* Can edit assigned tasks only
* Cannot delete other users' tasks

Authorization implemented using Laravel Policies.

---

## API Endpoints

| Method | Endpoint                   | Description        |
| ------ | -------------------------- | ------------------ |
| GET    | /api/tasks                 | Get all tasks      |
| POST   | /api/tasks                 | Create new task    |
| PATCH  | /api/tasks/{id}/status     | Update task status |
| GET    | /api/tasks/{id}/ai-summary | Get AI summary     |

---

# Project Architecture

The application follows clean architecture principles.

## Architecture Flow

```text
Controller
→ Service Layer
→ Repository Layer
→ Database
```

AI processing is separated into a dedicated AIService.

---

# Folder Structure

```text
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
│
├── Models/
│
├── Policies/
│
├── Repositories/
│   ├── Contracts/
│   └── Eloquent/
│
├── Services/
│
resources/views/
├── dashboard.blade.php
└── tasks/
```

---

# Repository Pattern

Repository Pattern is used to separate database logic from controllers.

Example:

```text
TaskRepositoryInterface
TaskRepository
```

Benefits:

* Cleaner controllers
* Better maintainability
* Easier testing
* Better separation of concerns

---

# Service Layer

Business logic is handled inside service classes.

Example:

```text
TaskService
AIService
```

Responsibilities:

* Task creation workflow
* AI processing
* Transaction handling
* Business rules

---

# AI Integration

The application includes a dedicated AIService responsible for generating:

* AI Summary
* AI Priority

Currently, mocked AI responses are used for stability and demonstration purposes.

The architecture is designed in a way that real OpenAI integration can be enabled easily without changing controller or business logic.

Example future implementation:

```php
$client = OpenAI::client(env('OPENAI_API_KEY'));
```

---

# Database Tables

## users

* id
* name
* email
* password
* role

## tasks

* id
* title
* description
* priority
* status
* due_date
* assigned_to
* ai_summary
* ai_priority
* timestamps

---

# Installation Steps

## 1. Clone Project

```
git clone project-url
```

---

## 2. Move Into Project

```
cd ai-task-manager
```

---

## 3. Install Dependencies

```
composer install
```

```
npm install
```

---

## 4. Create Environment File

```
cp .env.example .env
```

---

## 5. Configure Database

Update `.env`

```env
DB_DATABASE=ai_task_manager
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Generate App Key

```
php artisan key:generate
```

---

## 7. Run Migrations

```
php artisan migrate
```

---

## 8. Seed Database

```
php artisan db:seed
```

---

## 9. Run Frontend

```
npm run dev
```

---

## 10. Run Application

```
php artisan serve
```

Application URL:

```text
http://127.0.0.1:8000
```

---

# Default Users

## Admin User

```text
Email: admin@gmail.com
Password: admin@123
```

---

## Normal User

```text
Email: user@gmail.com
Password: user@123
```

---

# API Testing

APIs can be tested using:

* Postman
* Thunder Client

Example:

```text
GET /api/tasks
```
   

The application demonstrates how AI features can be integrated into a modern Laravel task management system while maintaining clean and scalable code architecture. 
