# Assignment 09 - Create Record with Active Record

## Overview

This assignment extends the Bird Directory application by implementing the Create portion of CRUD (Create, Read, Update, Delete) using the Active Record pattern.

Users can now add new bird records through a form. Submitted data is validated and stored in the database using PDO prepared statements.

## Features

- Display all bird records
- View individual bird details
- Create new bird records
- Form validation for required fields
- PDO prepared statements for secure database inserts
- Automatic retrieval of the newly created record ID

## Files Modified

### public/birds.php

Added a **Create Bird** link above the bird directory table.

### public/bird_new.php

Implemented:

- POST request processing
- Form validation
- Creation of Bird objects from submitted form data
- Redirect after successful record creation

### private/classes/Bird.php

Added:

```php
public function create(): bool
