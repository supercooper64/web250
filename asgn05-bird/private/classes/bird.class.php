<?php

/*
 * Bird class -- COMPLETED IMPLEMENTATION
 *
 * Reuses the architectural pattern of Chapter 7 to map avian data sets.
 */

class Bird {

  /*
   * TODO 1 -- Properties
   *
   * How it is used: Keeps text metadata public while protecting numerical metrics.
   * Why it exists: $common_name is public because it contains raw string data with no
   * strict units, logic formatting, or boundary constraints. Conversely, variables like
   * $wingspan_cm are protected so that external files cannot corrupt our internal data state
   * by writing negative numbers or bypassing unit conversion logic.
   */
  public $common_name;
  public $scientific_name;
  public $habitat;
  public $food;
  public $nest_placement;
  public $behavior;
  public $backyard_tips;

  protected $wingspan_cm;
  protected $weight_g;
  protected $conservation_id;


  /*
   * TODO 2 -- A static counter
   *
   * How it is used: Increments every time a new Bird object instance is initialized.
   * Why it exists: Bird::$count tracks Bird objects created in memory.
   * ParseCSV::row_count() counts rows read from the file. The numbers
   * may differ if empty rows are skipped or if objects are manually
   * created elsewhere in the application.
   */
  public static $count = 0;


  /*
   * TODO 3 -- Public constants
   *
   * Values extracted directly from the CSV data.
   */
  public const HABITATS = [
    'Open woodlands',
    'Forests',
    'Scrub',
    'High elevation',
    'Fields',
    'Wetland',
    'Cliff'
  ];

  public const FOOD_TYPES = [
    'Insects',
    'Nectar',
    'Omnivore',
    'Seeds',
    'Small mammals',
    'Fish',
    'Birds',
    'Nuts'
  ];


  /*
   * TODO 4 -- A protected constant for the conservation scale
   *
   * How it is used: Maps conservation IDs to readable labels.
   * Why it exists: The CSV stores stable numeric identifiers instead
   * of text labels. This keeps stored data compact and allows wording
   * changes without editing every record in the file.
   */
  protected const CONSERVATION_OPTIONS = [
    1 => 'Low concern',
    2 => 'Moderate concern',
    3 => 'Extreme concern',
    4 => 'Extinct'
  ];


  /*
   * TODO 5 -- The constructor
   *
   * How it is used: Builds a Bird object from one CSV row.
   * Why it exists: Accepting one $args array allows properties to
   * be matched by name instead of position. Reordering CSV columns
   * does not break object creation.
   */
  public function __construct($args = []) {

    $this->common_name =
      $args['common_name'] ?? '';

    $this->scientific_name =
      $args['scientific_name'] ?? '';

    $this->habitat =
      $args['habitat'] ?? '';

    $this->food =
      $args['food'] ?? '';

    $this->nest_placement =
      $args['nest_placement'] ?? '';

    $this->behavior =
      $args['behavior'] ?? '';

    $this->backyard_tips =
      $args['backyard_tips'] ?? '';

    $this->set_wingspan_cm(
      $args['wingspan_cm'] ?? 0
    );

    $this->set_weight_g(
      $args['weight_g'] ?? 0
    );

    $this->conservation_id =
      (int)($args['conservation_id'] ?? 1);

    self::$count++;
  }


  /*
   * TODO 6 -- Getters and setters for wingspan
   *
   * How it is used: Allows display in either centimeters or inches.
   * Why it exists: The class stores one internal value and converts
   * to alternate units when needed.
   */
  public function wingspan_cm() {
    return number_format($this->wingspan_cm, 1) . ' cm';
  }

  public function set_wingspan_cm($value) {
    $this->wingspan_cm = (float)$value;
  }

  public function wingspan_in() {
    return number_format(
      $this->wingspan_cm * 0.393701,
      1
    ) . ' in';
  }

  public function set_wingspan_in($value) {
    $this->wingspan_cm =
      (float)$value / 0.393701;
  }


  /*
   * TODO 7 -- Getters and setters for weight
   */
  public function weight_g() {
    return number_format(
      $this->weight_g,
      1
    ) . ' g';
  }

  public function set_weight_g($value) {
    $this->weight_g = (float)$value;
  }

  public function weight_oz() {
    return number_format(
      $this->weight_g * 0.0352740,
      2
    ) . ' oz';
  }

  public function set_weight_oz($value) {
    $this->weight_g =
      (float)$value / 0.0352740;
  }


  /*
   * TODO 8 -- conservation()
   *
   * How it is used: Converts stored ID values into readable labels.
   * Why it exists: The page should never display raw conservation IDs
   * to users. The method centralizes the lookup and safely handles
   * invalid IDs.
   */
  public function conservation() {

    if(isset(self::CONSERVATION_OPTIONS[$this->conservation_id])) {
      return self::CONSERVATION_OPTIONS[$this->conservation_id];
    }

    return 'Unknown';
  }


  /*
   * TODO 9 -- size_class()
   *
   * How it is used: Groups birds based on wingspan.
   * Why it exists: Categories are easier for users to understand than
   * raw measurements alone.
   */
  public function size_class() {

    if($this->wingspan_cm < 25) {
      return 'Small';
    } elseif($this->wingspan_cm < 75) {
      return 'Medium';
    } else {
      return 'Large';
    }

  }


  /*
   * TODO 10 -- display_name()
   *
   * How it is used: Combines common and scientific names for display.
   * Why it exists: This method returns plain text and leaves HTML
   * formatting to birds.php. Keeping markup in the view layer avoids
   * conflicts with h() escaping.
   */
  public function display_name() {
    return $this->common_name . ' (' . $this->scientific_name . ')';
  }

  /*
   * GO FURTHER OPTION 4 -- __toString()
   *
   * How it is used: Allows an individual Bird object instance to be treated directly as a string.
   * Why it exists: It lets us quickly output a string summary of the object without 
   * needing to explicitly call an instance formatting method like summary() or display_name().
   */
  public function __toString() {
    return $this->common_name . ' (' . $this->size_class() . ')';
  }

}

?>
