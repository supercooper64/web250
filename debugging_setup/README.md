# WEB-250 — Debugging Setup

**This README is your graded debugging notebook.** Complete the TODOs below with your **own** observations after using VS Code + Xdebug. Do not paste `phpinfo()` output or anything confidential.

## Local setup

- Operating system and local server (Mac/MAMP or Windows/XAMPP): Windows 11 with XAMPP 8.2.12
- PHP version shown in the browser's phpinfo: 8.2.12
- Xdebug version: 3.5.3
- Active php.ini path (no secrets): C:\xampp\php\php.ini
- Xdebug / VS Code port (recommended 9003): 9003
- Local Apache port (our class uses 55000): 80
- Mac/MAMP FastCGI -idle-timeout 600 configured? (Windows: N/A): N/A
- Mac/MAMP 45-second breakpoint pause, Step Over, Continue test result (Windows: N/A): N/A
- Local exercise index URL: http://localhost/web250/debugging_setup/index.php
- Hosted exercise index URL: https://webtech-182.com/web250/debugging_setup/index.php

## Exercise 01 — Variables and Watch

- Prediction for `$observations` before the `+=` line: 5
- Value before Step Over: 3
- Value after Step Over: 5
- What you learned about the breakpoint and Watch: The breakpoint paused execution before the line ran, and the Variables/Watch panel showed how the value changed after Step Over.
- Screenshot: `evidence/01_variables.png` — Breakpoint paused before `$observations += 2` showing the variable value before execution.

## Exercise 02 — Loop and conditional breakpoint

- Predicted total and average: Total = 10, Average = 2.50
- `$total` after the first two iterations: 6
- Values seen when `$dayIndex === 2` (index, count, total): $dayIndex = 2, $count = 1, $total = 6
- Why the conditional breakpoint helped: It skipped directly to the iteration I wanted to inspect instead of stopping during every loop cycle.
- Screenshot: `evidence/02_conditional.png` — Conditional breakpoint paused when `$dayIndex === 2`.

## Exercise 03 — Step Into / Step Out / Call Stack

- Predicted output: Eastern Towhee: 2 sightings
- Which function called `formatObservation()`?: `describeBird()`
- What Step Into showed that Step Over would skip: Step Into entered each function and allowed me to see how values were passed between functions.
- Where Step Out returned you: Back to `describeBird()`, and then to the main script.
- Screenshot: `evidence/03_call_stack.png` — Call Stack showing `formatObservation()`, `describeBird()`, and the main script.

## Exercise 04 — Find and fix the bug

- Original incorrect browser output: Birds counted: 4
- Values you observed while stepping through the loop: `$total` changed from 0 to 2, then 3, then 4 because it was being overwritten each iteration.
- Original error and minimal correction (in your words): The code replaced the running total with the current value. I changed `$total = $count;` to `$total += $count;`.
- Corrected output: Birds counted: 9
- Why PHP did not raise an exception: The code was syntactically correct and valid PHP. The problem was a logic error, not a PHP error.
- Screenshot: `evidence/04_fixed_bug.png` — Debugger showing the corrected running total of 9 before returning the result.

## How to view this project

- Local: Open `web250/debugging_setup/index.php` through your MAMP/XAMPP browser URL.
- Webhost: Open the course index and follow the Debugging Setup link.
- GitHub: Link to this folder on `main` in the Moodle Comments area.

**Safety reminder:** Never commit or deploy `php.ini`, `_local_phpinfo.php`, credentials, or logs. The project-level `.vscode/launch.json`, this README, and evidence screenshots belong on **GitHub** but **not** on the public webhost. Never activate Xdebug on your public webhost.
