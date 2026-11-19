# Assignment 11 - Member Registration and Authentication

## Overview

This assignment extends the WNC Birds application by adding member registration, login, logout, authentication, and authorization features.

Users can register for an account, log in, and access protected bird management features. Visitors can browse bird records, but only authenticated members can create, update, or delete bird records.

## Features

- Display all bird records
- View individual bird details
- Create bird records (members only)
- Update bird records (members only)
- Delete bird records (members only)
- Member registration
- Member login
- Member logout
- Password hashing using PHP password_hash()
- Authentication using PHP sessions
- Environment variables using vlucas/phpdotenv
- PDO prepared statements for secure database operations

## Composer

This project uses:

```bash
vlucas/phpdotenv
```

to load environment variables from a `.env` file.

## Environment Variables

The application uses a `.env` file for database credentials.

Example:

```env
DB_HOST=
DB_PORT=
DB_NAME=
DB_USER=
DB_PASS=
```

The actual `.env` file is excluded from GitHub using `.gitignore`.

## Files Added

### private/classes/Member.php

Added support for:

- Member creation
- Member lookup by username
- Member lookup by email

### public/register.php

Implements:

- Member registration
- Form validation
- Password hashing
- Duplicate username checking
- Duplicate email checking

### public/login.php

Implements:

- Member login
- Password verification
- Session creation

### public/logout.php

Implements:

- Session destruction
- Secure logout

### private/functions/auth_functions.php

Adds:

```php
is_logged_in()
require_login()
```

to protect authenticated pages.

## Authorization

Visitors can:

- View bird directory
- View bird details
- Register
- Login

Authenticated members can:

- Create birds
- Update birds
- Delete birds
- Logout

## Testing

Verified:

1. Member registration
2. Member login
3. Member logout
4. Password hashing
5. Session authentication
6. Bird creation when logged in
7. Bird update when logged in
8. Bird deletion when logged in
9. Access restrictions when logged out

## Branch Workflow

Development was completed on the `dev-users-login` branch and merged into `main` using a Pull Request.