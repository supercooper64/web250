# Start here — Bird Challenge starter code

## What you have

```
asgn05-bird/
├── private/
│   ├── classes/
│   │   ├── bird.class.php        ← YOU WRITE THIS. Ten TODOs.
│   │   └── parsecsv.class.php    ← provided, finished, do not edit
│   ├── shared/                   ← provided (header, footer, disclaimer)
│   ├── functions.php             ← provided (h(), u(), url_for())
│   ├── initialize.php            ← provided (paths, autoloader)
│   └── wnc-birds.csv             ← the data. Look at it first.
└── public/
    ├── birds.php                 ← YOU WRITE THIS. Eight TODOs.
    ├── index.php                 ← provided
    └── about.php                 ← provided
```

Two files to write: `bird.class.php` and `birds.php`. Everything else is
provided. There is no CSS, on purpose — a plain page is fine.

## First five minutes

1. Load `public/index.php` in a browser and click through all three links.
   The site should work before you change anything. If it does not, fix that
   first, because nothing later will make sense.
2. Open `private/wnc-birds.csv` in a plain text editor — not Excel, which
   will offer to reformat it and should be refused. Read the header row.
   Notice what separates the fields.
3. Open `private/classes/bicycle.class.php` from the chapter 7 videos beside
   `bird.class.php`. You will be referring to it constantly.

## The order that works

Do not write both files and then load the page. Write a little, load the
page, repeat.

1. `bird.class.php` TODO 1 — properties only.
2. `birds.php` TODO 1 through 4 — delimiter, parse, error flag, build objects.
3. `birds.php` TODO 7 and 8 — the table, with just the text columns at first.
   Get a real table on screen before you add anything clever.
4. Back to `bird.class.php` for the constants, `conservation()`, the
   measurement getters and setters, `size_class()`, `display_name()`.
5. Add the remaining columns to the table as each method starts working.
6. Last: the two "go further" items, the record count, and your `README.md`.

## Things that will happen to you

**Every cell in the table is empty.** The delimiter. See `birds.php` TODO 1.
This is the single most common outcome of a first attempt, and the error
message is no message at all.

**`Class "Bird" not found`.** Either the class name and file name disagree, or
the autoloader is not finding the file. See the comments in
`initialize.php` — especially the note about capital letters, which is a
problem on the webhost and not on your laptop.

**`Undefined array key "wingspan_cm"`.** Your constructor is not using `??`,
or the key you typed does not match the CSV column name exactly.

**`array_combine(): Argument #1 ... must be equal`.** A row in the CSV has a
different number of fields than the header row. Usually caused by an editor
inserting or deleting a delimiter.

**Tags printing as literal text on the page**, like `<em>Corvus corax</em>`.
That is `h()` doing exactly its job on a string that already contained HTML.
See `bird.class.php` TODO 10.

## Before you submit

- Every value on the page passes through `h()`.
- The page validates at validator.w3.org.
- Rename the CSV, load `birds.php`, confirm you get a readable message and
  not a blank page. Rename it back.
- Set a `conservation_id` of 99 on one row, confirm you get `Unknown`, and
  put it back.
- Your "why" comments explain decisions, not syntax. "Uses the null
  coalescing operator" earns nothing. "One array instead of ten parameters,
  so reordering the CSV columns cannot silently put values in the wrong
  properties" earns full credit.
- `README.md` has your concept-check answers, your `git log --oneline --graph
  --all --decorate` output, which two "go further" items you chose, and your
  AI log.

## Ask for help when

You have been stuck on the same error for more than about thirty minutes and
have read the relevant comment in the starter code. Bring the exact error
message and the line it points to.
