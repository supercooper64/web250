# Assignment 10 - Update and Delete Bird Records

## Overview

This assignment extends the Bird Directory application by implementing the Update and Delete portions of CRUD (Create, Read, Update, Delete) using the Active Record pattern.

Users can now edit existing bird records and delete bird records through the web interface. All database operations are performed using PDO prepared statements.

## Features

- Display all bird records
- View individual bird details
- Create new bird records
- Update existing bird records
- Delete bird records
- Form validation for required fields
- PDO prepared statements for secure database operations

## Files Modified

### public/birds.php

Added:

- Update links for each bird record
- Delete links for each bird record

### public/bird_edit.php

Implemented:

- Retrieval of existing bird records
- Prefilled edit form
- Form validation
- Record updates using the Active Record pattern
- Redirect after successful update

### public/bird_delete.php

Implemented:

- Delete confirmation page
- Record deletion
- Redirect after successful deletion

### private/classes/Bird.php

Added:

```php
public function update(): bool
```

Updates an existing bird record in the database.

Added:

```php
public function delete(): bool
```

Deletes an existing bird record from the database.

## CRUD Functionality

| Operation | Status |
| ---------- | ---------- |
| Create | Complete |
| Read | Complete |
| Update | Complete |
| Delete | Complete |

## Testing

Verified the following functionality:

1. Create a new bird record
2. View bird details
3. Update an existing bird record
4. Confirm updated changes are displayed
5. Delete a bird record
6. Confirm deleted record is removed from the directory

## Branch Workflow

Development was completed on the `dev-update-delete` branch and merged into `main` using a Pull Request.
