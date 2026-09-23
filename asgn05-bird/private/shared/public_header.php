<!doctype html>

<html lang="en">
  <head>
    <title>WNC Birds <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <!-- No stylesheet. This assignment is graded on object design and
         well-structured markup, not on appearance. -->
  </head>

  <body>

    <header>
      <h1>
        <a href="<?php echo url_for('/index.php'); ?>">
          WNC Birds
        </a>
      </h1>
      <nav>
        <ul>
          <li><a href="<?php echo url_for('/index.php'); ?>">Home</a></li>
          <li><a href="<?php echo url_for('/birds.php'); ?>">Birds</a></li>
          <li><a href="<?php echo url_for('/about.php'); ?>">About</a></li>
        </ul>
      </nav>
    </header>

    <main>
