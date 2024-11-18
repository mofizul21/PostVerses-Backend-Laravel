# PostVerses - Backend (Laravel API)
PostVerses Backend is the server-side API for the **PostVerses** blog application. It is built with **Laravel** and provides a secure API for handling user authentication, CRUD operations for blog posts, and user permissions.

## Features
- **User Authentication**: Secure user registration, login, and logout using Sanctum.
- **Post Management**: Full CRUD operations for blog posts.
- **User Permissions**: Only the author of a post can edit or delete it.
- **User Information**: Retrieve details of the authenticated user.

## Tech Stack
- **Backend**: Laravel
- **Database**: MySQL (or your choice of database)
- **Authentication**: JWT (JSON Web Tokens)

## API Endpoints
| Method | Endpoint               | Description                                  |
|--------|------------------------|----------------------------------------------|
| POST   | `/api/register`        | Register a new user                          |
| POST   | `/api/login`           | Authenticate user and generate JWT           |
| POST   | `/api/logout`          | Logout user and invalidate JWT               |
| GET    | `/api/user`            | Get details of the authenticated user        |
| GET    | `/api/posts`           | Retrieve a list of all posts                 |
| POST   | `/api/posts`           | Create a new post (requires authentication)  |
| GET    | `/api/posts/{post}`    | View details of a specific post              |
| PUT    | `/api/posts/{post}`    | Update a specific post (requires ownership)  |
| DELETE | `/api/posts/{post}`    | Delete a specific post (requires ownership)  |

## Installation

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL or a compatible database

### Clone the Repository
```bash
git clone https://github.com/mofizul21/PostVerses-Backend-Laravel
cd PostVerses-Backend-Laravel
```
## Setup

### Install Dependencies:
```bash
composer install
```

### IRun migration
```bash
php artisan migrate
```
