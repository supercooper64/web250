<?php

/*
 * PROVIDED. Do not change.
 *
 * h() is the one you must use on every single value you echo into the page.
 * Get in the habit now: if it came from a data file, a URL, or a form, it
 * goes through h() on the way out.
 */

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  // The ?? '' guard is not in the video version. PHP 8.1 and later emit a
  // deprecation notice when NULL reaches htmlspecialchars(), which happens
  // the first time a constructor default is forgotten.
  return htmlspecialchars($string ?? '');
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

?>
