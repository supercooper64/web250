# WEB-250 | Debugging Setup — 100 points

This is a **separate assignment from asgn08**, and it has a **separate 100-point rubric**.

1. Create `web250/debugging_setup` alongside `web250/asgn08` in your MAMP/XAMPP document root.
2. Extract the **contents** of this ZIP into `debugging_setup` (not inside an extra nested folder).
3. Read `debugging_setup_instructions.md` and follow **all** setup steps for your operating system.
4. Open the `debugging_setup` folder in VS Code and install the **PHP Debug** extension from Xdebug.
5. Enable Xdebug 3 in the PHP configuration used by your **browser**. Use debug port **9003** in both Xdebug and `.vscode/launch.json`; our class Apache port is **55000**.
6. **Mac/MAMP:** Follow **Section 2.5** of the instructions before debugging: back up `httpd.conf`, update the existing `FastCgiServer` directive to include **`-idle-timeout 600`**, save, and restart MAMP. **Windows/XAMPP:** Skip the Mac-specific FastCGI step.
7. Run `sandbox/sandbox_breakpoints.php` through `http://localhost:55000/web250/debugging_setup/sandbox/sandbox_breakpoints.php`. On Mac, verify that a **45-second pause** at a breakpoint does not cause an HTTP 500 error, then Step Over and Continue.
8. Complete the **four** exercises in `exercises/`, save screenshots to `evidence/`, and fill in `README.md`.
9. Commit and push `debugging_setup` to the course GitHub repository. Upload **only** `index.php`, `sandbox/`, and `exercises/` to your webhost; update the web250 index. Do **not** upload debugger configuration, screenshots, logs, or diagnostic phpinfo output.
10. Paste **both** GitHub and webhost URLs into the separate **Debugging Setup** Moodle activity.

No database, API key, `.env` file, or Homebrew installation is needed.
