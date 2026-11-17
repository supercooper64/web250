# Assignment 10 - Update and Delete Bird Records

## Purpose
This assignment extends the Bird Directory application (`wnc_birds` database, `birds` table) by implementing the **Update** and **Delete** operations using the Active Record pattern. Adding these features **completes full CRUD** (Create, Read, Update, Delete) functionality across the application.

## Model Responsibilities (`private/classes/Bird.php`)
- **`Bird::update(): bool`**: Prepares a parameterized SQL `UPDATE` query, binds all six bird properties along with `:id` via `bindValue()`, and executes the statement to save changes to an existing row.
- **`Bird::delete(): bool`**: Prepares a parameterized SQL `DELETE` query, binds `:id` as `PDO::PARAM_INT`, and executes the statement to remove that specific row from the database.

## Request Flow (`GET` vs. `POST`)
- **`public/bird_edit.php`**: Uses a **`GET`** request (`?id=...`) to fetch the target record with `Bird::find_by_id()` and prefill the edit form. On **`POST`**, it assigns submitted values to the `Bird` object, validates required fields, calls `$bird->update()`, and redirects to `birds.php`.
- **`public/bird_delete.php`**: Uses a **`GET`** request (`?id=...`) to load the bird's details and render a confirmation prompt so records are never deleted by visiting a link. On **`POST`**, it calls `$bird->delete()` and redirects back to `birds.php`.

## Why `WHERE id = :id` Is Essential
Including `WHERE id = :id` targets only the single record matching that primary key. Without a `WHERE` clause, an `UPDATE` statement would overwrite every row in the `birds` table, and a `DELETE` statement would wipe out the entire table.

## Running Locally
1. Copy `private/db_credentials.example.php` to `private/db_credentials.php` (kept out of Git via `.gitignore`).
2. Enter your local MySQL credentials for the `wnc_birds` database.
3. Start your local server (MAMP/XAMPP) and open `public/birds.php` in your browser.

## Git Branch Workflow (`dev-update-delete`)
1. Created and switched to the `dev-update-delete` branch from an up-to-date `main` branch (`git switch -c dev-update-delete`).
2. Built and tested the edit/delete links, `bird_edit.php`, `bird_delete.php`, and `Bird::update()` / `Bird::delete()` methods with incremental commits.
3. Pushed `dev-update-delete` to GitHub (`git push -u origin dev-update-delete`), merged it into `main` via Pull Request / merge, and pushed the final `main` branch.

## Project Links

- **GitHub Repository:** https://github.com/supercooper64/web250/tree/main/asgn10

- **Hosted Application:** https://webtech-182.com/web250/asgn10/public/birds.php
