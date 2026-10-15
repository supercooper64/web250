# Active Record Sandbox Notes

## Experiment A - Change the Sort Direction

### Prediction
The birds would appear in reverse alphabetical order. The number of objects returned would stay the same.

### Result
The bird list appeared in reverse alphabetical order.

### Explanation
Only the sorting changed. The HTML loop did not need any changes because it simply displays whatever objects are returned by the model.

---

## Experiment B - Limit the Results

### Prediction
Only 3 SandboxBird objects would be returned, even though the database contains more records.

### Result
The page displayed 3 birds and the count returned 3.

### Explanation
count($birds) returns the number of objects in the array, not the total number of records in the database. Once LIMIT 3 was added, only 3 rows were returned.

---

## Experiment C - Hydrate an Additional Property

### Prediction
Accessing a typed property before assigning a value could cause an error.

### Result
The scientific_name property was added successfully and displayed with the common name.

### Explanation
The SELECT statement, hydration loop, and HTML output all needed to be updated so the additional property could be displayed.

---

## Experiment D - Skip set_database()

### Prediction
The query would fail because the model would not have a PDO connection.

### Result
An error occurred when find_all() attempted to run a query.

### Explanation
The model requires a PDO connection before database operations can be performed. Sharing a single PDO connection is more efficient than creating a new connection for every object or query.

---

## Key Concepts Learned

- Static methods are called on the class itself, such as Bird::find_all().
- Object properties belong to a specific object, such as $bird->common_name.
- Hydration converts a database row into a PHP object.
- PDO::FETCH_ASSOC returns rows as associative arrays.
- Prepared statements should be used when user input is involved.
- The Bird model separates database logic from page presentation.