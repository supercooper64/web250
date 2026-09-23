<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Inventory'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<?php
// Initialize ParseCSV with the absolute path to your file
$parser = new ParseCSV(PRIVATE_PATH . '/used_bicycles.csv');

// Execute the parser loop to return an array of data rows
$bike_data = $parser->parse();
?>

<div id="main">

  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('/images/AdobeStock_55807979_thumb.jpeg') ?>" />
      <h2>Our Inventory of Used Bicycles</h2>
      <p>Choose the bike you love.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="inventory">
      <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Category</th>
        <th>Gender</th>
        <th>Color</th>
        <th>Weight (kg / lbs)</th>
        <th>Condition</th>
        <th>Price</th>
      </tr>

      <?php foreach ($bike_data as $args) { 
        // Skip empty row artifacts at the bottom of the CSV
        if (empty($args['brand'])) { continue; }

        // Instantiate our model object with the mapped database array keys
        $bike = new Bicycle($args);
      ?>
      <tr>
        <td><?php echo h($bike->brand); ?></td>
        <td><?php echo h($bike->model); ?></td>
        <td><?php echo h($bike->year); ?></td>
        <td><?php echo h($bike->category); ?></td>
        <td><?php echo h($bike->gender); ?></td>
        <td><?php echo h($bike->color); ?></td>
        <!-- Display weight in both units using our encapsulated object accessors -->
        <td><?php echo h($bike->weight_kg()) . ' / ' . h($bike->weight_lbs()); ?></td>
        <!-- Map the protected condition ID to its validated dictionary text string -->
        <td><?php echo h($bike->condition()); ?></td>
        <!-- PHP 8 required fix: Manual dollar notation with standalone number formatting -->
        <td><?php echo '$' . h(number_format($bike->price, 2)); ?></td>
      </tr>
      <?php } ?>

    </table>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
