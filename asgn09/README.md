# WEB 250 - asgn09: Create a Record

This starter is based on the completed reference version of asgn08. It already contains the read-only Active Record methods and pages so everyone can begin asgn09 from roughly the same structure.

## Assignment goal

Add the **Create** portion of CRUD using:

- `public/bird_new.php`
- a `Bird::create()` instance method
- a PDO prepared `INSERT`
- named placeholders and `bindValue()`

## Database

Use the existing `wnc_birds` database and `birds` table from the previous assignments.

## Credentials

Copy:

```text
private/db_credentials.example.php
```

to:

```text
private/db_credentials.php
```

Then enter the database settings for your own local or hosted environment.

`private/db_credentials.php` is ignored by Git and must not be committed.

## Student README TODO

Before submitting asgn09, replace or expand this README with the information requested in the assignment instructions, including your create flow, prepared-statement explanation, MVC direction, Git branch workflow, and final URLs.
