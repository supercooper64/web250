# Assignment 07 - WNC Birds Database Check

## Why are three tables used?

Three tables are used because birds and images have a many-to-many relationship. A bird can have multiple images, and an image can be associated with multiple birds. The bird_image_links table acts as a junction table connecting the birds and bird_images tables.

## What happens when a species is deleted?

When a bird record is deleted, the related records in bird_image_links are automatically removed because the foreign keys use ON DELETE CASCADE. The records in bird_images remain in the database, and the image files are not deleted from disk.

## What does the PDO DSN contain and why is the connection static?

The PDO DSN contains the database driver, host name, port number, database name, and character set. The connection is stored as a static property so the application can reuse a single PDO connection during the request.

## Difference between query() and fetchColumn()

The query() method executes a SQL statement and returns a PDOStatement object. The fetchColumn() method retrieves a single value from the first column of the result set.

## Database Counts

- birds: 8
- bird_images: 17
- bird_image_links: 18

## Error Test

The database name was temporarily changed to an invalid value to test error handling. The application displayed an expected database error message. After restoring the correct database name (wnc_birds), the application connected successfully and displayed the database record counts.