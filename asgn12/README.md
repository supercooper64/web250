# Assignment 12 - Member Administration

## Student

Daniel Joseph Filz

## Project Overview

This project extends the WNC Birds application by implementing authentication, authorization, role-based navigation, and member administration.

The application supports three user roles:

- Visitor
- Member
- Administrator

Visitors can browse bird records. Members can create, edit, and delete bird records. Administrators can manage both bird records and member accounts.

---

## Setup

1. Clone the repository.
2. Run:

```bash
composer install
```

3. Create a `.env` file and configure your database credentials:

```env
DB_HOST=
DB_PORT=
DB_NAME=
DB_USER=
DB_PASS=
```

4. Import the database schema.
5. Start Apache and MySQL.
6. Open the application in your browser.

The `.env` file is excluded from GitHub using `.gitignore`.

---

## User Roles

### Visitor

Can:

- View bird directory
- View bird details
- Register
- Login

Cannot:

- Create birds
- Edit birds
- Delete birds
- Access administrative pages

### Member

Can:

- View birds
- Create birds
- Edit birds
- Delete birds
- Logout

Cannot:

- Access member administration pages

### Administrator

Can:

- Perform all member actions
- View members
- Create members
- Edit members
- Delete members
- Access all administrative pages

---

## Administrator Pages

- `admin/index.php`
- `admin/members.php`
- `admin/member.php`
- `admin/new_member.php`
- `admin/edit_member.php`
- `admin/delete_member.php`

---

## Features

### Authentication

- Member registration
- Member login
- Member logout
- Session-based authentication
- Password hashing using `password_hash()`
- Password verification using `password_verify()`

### Authorization

- Visitor, Member, and Administrator roles
- Protected pages using authentication checks
- Administrator-only member management

### Bird Management

- View bird records
- Create bird records
- Edit bird records
- Delete bird records

### Member Administration

- View all members
- View member details
- Create members
- Edit members
- Delete members
- Self-delete protection
- Self-demotion protection

### Security

- PDO prepared statements
- CSRF protection
- Environment variables using `vlucas/phpdotenv`

---

## Testing

Verified:

- Member registration
- Member login
- Member logout
- Password hashing
- Session authentication
- Bird creation
- Bird updates
- Bird deletion
- Member creation
- Member updates
- Member deletion
- Visitor access restrictions
- Member access restrictions
- Administrator access restrictions
- Personalized navigation
- Self-delete prevention
- Self-demotion prevention

---

## Assignment Questions

### Why do we need `require_admin()` when the Admin link is hidden?

Hiding a navigation link only removes it from the user interface. A user can still manually enter the URL. The `require_admin()` function protects administrative pages on the server and prevents unauthorized access.

### What does `from_row()` return, and how does the member list use it?

The `from_row()` method converts a database row into a Member object. The member list uses these
