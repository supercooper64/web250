<?php

  ob_start(); // turn on output buffering

  // session_start(); // turn on sessions if needed

  /*
   * PROVIDED. You should not need to change anything in this file, but read
   * the comments -- two of them explain failures that will otherwise cost you
   * an afternoon.
   *
   * Path constants, built from __FILE__ so they do not depend on which file
   * is running. A relative path like '../private/wnc-birds.csv' is resolved
   * against the file that is EXECUTING, not the file that contains the path,
   * so it breaks as soon as an include moves.
   */
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  /*
   * Find everything in the URL up to "/public" so url_for() can build links.
   *
   * Note the === false check. The video version is:
   *
   *   $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
   *
   * When "/public" is not in the URL, strpos() returns false, false + 7 is 7,
   * and every link on the site loses its first seven characters. That happens
   * when you upload the CONTENTS of public/ to your web root instead of the
   * whole project -- a normal way to deploy on shared hosting. The site works
   * locally and every link 404s on the host.
   */
  $public_pos = strpos($_SERVER['SCRIPT_NAME'], '/public');
  if ($public_pos === false) {
    define("WWW_ROOT", '');
  } else {
    define("WWW_ROOT", substr($_SERVER['SCRIPT_NAME'], 0, $public_pos + 7));
  }

  require_once(PRIVATE_PATH . '/functions.php');

  /*
   * Class loading.
   *
   * The assignment asks you to get the page working with manual loading
   * first, then switch to the autoloader. Uncomment one of the two manual
   * options, confirm your page runs, then comment it back out and let the
   * autoloader take over. Leave whichever you are not using in place, with a
   * comment saying which is active and what autoloading buys you.
   */

  // -- Manual, one class at a time
  // require_once(PRIVATE_PATH . '/classes/bird.class.php');
  // require_once(PRIVATE_PATH . '/classes/parsecsv.class.php');

  // -- Manual, every class in the directory
  // foreach (glob(PRIVATE_PATH . '/classes/*.class.php') as $file) {
  //   require_once($file);
  // }

  /*
   * -- Autoload
   *
   * Called automatically when PHP meets a class name it has not seen. Three
   * details matter here:
   *
   * The path is built from PRIVATE_PATH. The video uses a relative path,
   * which depends on the working directory of whichever script is running.
   *
   * strtolower() is what lets the class Bird find the file bird.class.php.
   * Without it, PHP looks for Bird.class.php. macOS and Windows do not care
   * about the capital B; your Linux webhost does. This is the usual reason a
   * project runs on your laptop and returns a 500 on SiteGround.
   *
   * The file_exists() check means a typo'd class name gives you a clean
   * "Class not found" error instead of an include warning about a missing
   * file, which is a much more confusing thing to debug.
   */
  function my_autoload($class) {
    if (preg_match('/\A\w+\Z/', $class)) {
      $path = PRIVATE_PATH . '/classes/' . strtolower($class) . '.class.php';
      if (file_exists($path)) {
        include($path);
      }
    }
  }
  spl_autoload_register('my_autoload');

?>
