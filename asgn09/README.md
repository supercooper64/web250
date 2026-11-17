# Assignment 09 - Create Record with Active Record

## Overview

This assignment extends the Bird Directory application (`wnc_birds` database, `birds` table) by implementing the **Create** operation of CRUD using the Active Record pattern, allowing users to add validated bird records via a form and PDO prepared statements.

## Key Features & Files Modified

* **`public/birds.php`:** Serves as the directory view with a new **Create Bird** link.
* **`public/bird_new.php`:** Handles POST requests, form validation, `Bird` object instantiation, and redirects upon creation.
* **`private/classes/Bird.php`:** Acts as the model, implementing `create(): bool` to execute safe database inserts with PDO named placeholders and `lastInsertId()`.

## Architecture & Database Security

* **MVC Direction:** Transitions toward MVC separation with the model handling database logic, `birds.php` managing presentation, and `bird_new.php` handling request flow.
* **PDO Prepared Statements:** Uses named placeholders and `bindValue()` to secure inserts against SQL injection and handle special characters cleanly.

## Setup & Workflow

* **Running Locally:** Configure credentials in `private/db_credentials.php` (from `private/db_credentials.example.php`) and launch `public/birds.php` via a local server (MAMP/XAMPP).
* **Git Workflow:** Developed on the `dev-create` branch, incrementally committed, tested, and merged into `main` before pushing to GitHub.


## Project Links

- **GitHub Repository:** https://github.com/supercooper64/web250/tree/main/asgn09

- **Hosted Application:** https://webtech-182.com/web250/asgn09/public/birds.php
