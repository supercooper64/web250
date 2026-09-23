<?php
require_once('../private/initialize.php');
$page_title = 'Sightings';

// GO FURTHER CHOICES
// Choice 1: 2. Filter by habitat
// Choice 2: 4. __toString()

/*
 * TODO 1 -- The delimiter
 *
 * How it is used: Configures the dynamic parsing boundary before opening the file.
 * Why it exists: Setting the delimiter from outside works because static properties 
 * are bound to the class blueprint rather than individual object instances. This is 
 * vastly superior to editing parsecsv.class.php because it preserves code reuse; the 
 * exact same core class can parse a comma-separated bike file and a pipe-separated bird 
 * file on the exact same server without maintaining duplicated codebase variations.
 */
ParseCSV::$delimiter = '|';


/*
 * TODO 2 -- Parse the file
 */
$csv_file = PRIVATE_PATH . '/wnc-birds.csv';

$csv = new ParseCSV($csv_file);

$result = $csv->parse();


/*
 * TODO 3 -- Handle a missing or unreadable file
 */
$data_error = false;

if($result === false) {
  $data_error = true;
}


/*
 * TODO 4 -- Build the objects
 */
$birds = [];

if(!$data_error) {
  foreach($result as $row) {
    $bird = new Bird($row);
    
    // Defensive Check: Skipping an empty trailing row if present in the data file
    if(empty($bird->common_name)) {
      continue;
    }
    
    $birds[] = $bird;
  }
}


/*
 * GO FURTHER OPTION 2
 * Filter by habitat
 */
$habitats = [];

foreach($birds as $bird) {
  if(!in_array($bird->habitat, $habitats)) {
    $habitats[] = $bird->habitat;
  }
}

sort($habitats);

$current_habitat = $_GET['habitat'] ?? '';

if($current_habitat != '') {
  $filtered_birds = [];
  foreach($birds as $bird) {
    if($bird->habitat == $current_habitat) {
      $filtered_birds[] = $bird;
    }
  }
  $birds = $filtered_birds;
}

// --- DEFAULT SORT BY NAME ---
// Sorts the birds array alphabetically by common_name before rendering
usort($birds, function($a, $b) {
  return strcmp($a->common_name, $b->common_name);
});

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<h2>Bird inventory</h2>

<p>This is a short list -- start your birding!</p>

<?php if($data_error) { ?>

  <?php
  /*
   * TODO 5 -- Missing file message
   */
  ?>
  <p><strong>Error:</strong> Unable to load bird data. The data source file is currently missing or unreadable.</p>

<?php } else { ?>

  <?php
  /*
   * TODO 6 -- The record count
   */
  ?>
  <p>
    Showing <?php echo h(count($birds)); ?>
    of <?php echo h($csv->row_count()); ?>
    records in the data file.
    <?php echo h(Bird::$count); ?>
    Bird objects were created for this page.
  </p>

  <h3>Filter by habitat</h3>

  <ul>
    <li>
      <a href="birds.php">All habitats</a>
    </li>

    <?php foreach($habitats as $habitat) { ?>
      <li>
         <!-- FIXED: Cleaned up the broken HTML tag/link syntax -->
         <a href="birds.php?habitat=<?php echo u($habitat); ?>">
          <?php echo h($habitat); ?>
        </a>
      </li>
    <?php } ?>
  </ul>

  <?php
  /*
   * TODO 7 -- The table
   * TODO 8 -- The rows
   */
  ?>
  <table border="1">
    <caption>
       Birds of western North Carolina, sorted by name.
    </caption>

    <thead>

      <tr>
        <!-- Added sorting anchors for Go Further Option 1 layout metrics -->
        <th scope="col"><a href="birds.php?sort=bird">Bird</a></th>
        <th scope="col"><a href="birds.php?sort=habitat">Habitat</a></th>
        <th scope="col"><a href="birds.php?sort=food">Food</a></th>
        <th scope="col">Nest</th>
        <th scope="col"><a href="birds.php?sort=behavior">Behavior</a></th>
        <th scope="col">Wingspan</th>
        <th scope="col">Weight</th>
        <th scope="col">Size</th>
        <th scope="col">Conservation</th>
        <th scope="col">Backyard tips</th>

      </tr>

    </thead>

    <tbody>
    <?php foreach($birds as $bird) { ?>
      <tr>
        <td>
          <?php echo h($bird->common_name); ?>
          <br>
          <em><?php echo h($bird->scientific_name); ?></em>
        </td>
        <td><?php echo h($bird->habitat); ?></td>
        <td><?php echo h($bird->food); ?></td>
        <td><?php echo h($bird->nest_placement); ?></td>
        <td><?php echo h($bird->behavior); ?></td>
        <td>
          <?php echo h($bird->wingspan_cm()); ?>
          /
          <?php echo h($bird->wingspan_in()); ?>
        </td>
        <td>
          <?php echo h($bird->weight_g()); ?>
          /
          <?php echo h($bird->weight_oz()); ?>
        </td>
        <td><?php echo h($bird->size_class()); ?></td>
        <td><?php echo h($bird->conservation()); ?></td>
        <td><?php echo h($bird->backyard_tips); ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

<?php } ?>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
