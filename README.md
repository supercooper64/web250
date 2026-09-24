# Assignment 05: Bike and Bird Challenge

## Go Further Choices
*   **Choice 1: Option 2 (Filter by Habitat)** – Added a dynamic `$_GET['habitat']` parameter check that strips out unmatching bird entities and displays a narrowed down inventory table.
*   **Choice 2: Option 5 (Filter Link Navigation)** – Built an active filter list panel with `u()` encoding on path generation and interactive fallback states to view all entries.

--- 

## Concept Check Answers

### 1. ParseCSV::\$delimiter vs Bicycle::CATEGORIES
A constant is completely immutable and remains identical for every context. The CSV delimiter needs to change dynamically at runtime depending on whether you are parsing a comma-separated bike file or a pipe-separated bird file, making a mutable static property the correct architectural choice for loose coupling.

### 2. Constructor Array Parameter vs Ten Positional Parameters
Because the `$args` array uses associative keys mapped directly from the CSV headers via `array_combine()`, reordering the columns changes nothing; the keys still match. With a 10-parameter positional constructor, reordering the CSV columns would completely misalign and break the data mapping, leading to corrupted data objects.

### 3. Public vs Protected Properties
Making a property protected forces external data through explicit getter and setter methods. This allows you to sanitize or validate inputs (e.g., forcing weights to be a float), trigger automated side-effects, or handle internal multi-unit transformations seamlessly while keeping properties safe from direct, uncontrolled modification.

### 4. Private reset() Method Bug Scenario
If `reset()` were public, an external script could accidentally trigger it mid-execution during file parsing. This would wipe out the internal row array or tracking cache right before an output operation, resulting in unexpected empty tables or completely broken dataset counts.

### 5. self:: vs \$this-> for Constants
Constants belong directly to the class blueprint itself rather than to any individual instantiated object instance. Using `self::` targets the class definition directly, preventing PHP from wasting memory checking instance variable scopes for properties that do not change.

### 6. money_format() Deprecation & Germany Localization
`money_format()` automatically handled localized currency styling, symbols, and formatting structures based on the server's locale system. To sell to Germany using `number_format()`, you would have to manually swap the decimal point to a comma, use periods for thousands separators, and append the Euro (€) symbol to the end of the text instead of prepending a dollar sign.

---

## Git Log Output
```text
* 007688e (origin/asgn05-bird, asgn05-bird) asgn05: Finalized main web250 README with concept answers and git history
* 7af2627 asgn05-bird: Configured dynamic class autoloader for bird environment
* b8fa33c asgn05-bird: Configured external CSV pipe delimiter and set up front-end table output
* d2d3e6d asgn05-bird: Implemented Bird class core properties and null-coalescing constructor
* 7352f8f (origin/asgn05-bike, asgn05-bike) asgn05-bike: Finalized validation hooks for bike condition
* 2e8ab8a asgn05-bike: Added calculation methods for gear ratios
* aac391d asgn05-bike: Bike class definition and initial properties
* 8d8f709 asgn05-bike: starter code in place
```


## AI Log
*   **What I asked:** Asked for clarification on how to set a public static utility class property from outside the class scope before executing an extraction method.
*   **What I did with the answer:** Used the feedback to assign `ParseCSV::$delimiter = '|';` inside `birds.php` prior to triggering `$parser->parse()`, satisfying the condition to read the pipe-delimited data file without changing the core engine file.
