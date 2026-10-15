# Assignment 08 - Active Record Directory

## Project Purpose

This project implements a read-only Active Record directory for the WNC Birds database. Bird records are retrieved through a Bird model class and displayed in a directory page and a details page.

## Technologies Used

- PHP 8
- PDO
- MySQL
- Git
- XAMPP

## Folder Structure

```text
asgn08/
├── private/
│   ├── classes/
│   │   ├── Bird.php
│   │   ├── Database.php
│   │   └── SandboxBird.php
│   ├── functions.php
│   ├── initialize.php
│   └── db_credentials.php
├── public/
│   ├── index.php
│   ├── birds.php
│   ├── bird.php
│   └── sandbox_active_record.php
└── README.md
```

## Running the Project

### Home Page

```text
http://localhost/web250/asgn08/public/index.php
```

### Bird Directory

```text
http://localhost/web250/asgn08/public/birds.php
```

### Bird Details

Example:

```text
http://localhost/web250/asgn08/public/bird.php?id=1
```

Use an ID that exists in your database.

## Bird Model Methods

### find_all()

Retrieves all bird records from the database and returns an array of Bird objects sorted by common name.

### find_by_id()

Uses a prepared statement to retrieve a single bird record by ID. Returns a Bird object when found or null when no matching record exists.

### from_row()

Converts an associative database row into a fully populated Bird object. Both finder methods reuse this helper method.

### count_all()

Returns the number of rows in the birds table.

## Refactoring Notes

I moved the bird retrieval SQL from page files into the Bird model class.

This improves organization because the pages focus on displaying information while the model handles database access and object creation.

## Git Workflow

Development work was completed on the `dev-active-record` branch.

After testing, the branch was merged into `main` and pushed to GitHub.

## Navigation

Home Page:

```text
public/index.php
```

Bird Directory:

```text
public/birds.php
```

Bird Details:

```text
public/bird.php?id=<id>
```
