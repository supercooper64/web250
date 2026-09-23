<?php

class Bicycle {

  public $brand;
  public $model;
  public $year;
  public $category;
  public $color;
  public $description;
  public $gender;
  public $price;
  protected $weight_kg;
  protected $condition_id;

  public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];

  public const GENDERS = ['Mens', 'Womens', 'Unisex'];

  /*
   * How it is used: Maps internal numeric condition IDs (1-5) to human-readable strings like 'Good' or 'Great'.
   * Why it exists: It implements data normalization and encapsulation. Storing stable integer IDs in the database/CSV 
   * instead of descriptive strings prevents data duplication, saves disk storage, and makes indexing faster. Keeping 
   * the constant protected ensures that external application layers cannot accidentally overwrite or corrupt the 
   * predefined application-wide lookups, localizing all display changes to this single map definition.
   */
  protected const CONDITION_OPTIONS = [
    1 => 'Beat up',
    2 => 'Decent',
    3 => 'Good',
    4 => 'Great',
    5 => 'Like New'
  ];

  /*
   * How it is used: Instantiates the Bicycle object using a single associative array parameter.
   * Why it exists: Using an array decouples the data source structure from the class constructor interface. 
   * If a developer reorders columns or adds new columns to the raw CSV file, a standard 10-parameter signature 
   * would map values to the wrong properties or crash entirely. An associative array safely maps keys independently 
   * of their data file order, while the null-coalescing operator provides safe fallbacks to prevent undefined array key warnings.
   */
  public function __construct($args=[]) {
    $this->brand = $args['brand'] ?? '';
    $this->model = $args['model'] ?? '';
    $this->year = $args['year'] ?? '';
    $this->category = $args['category'] ?? '';
    $this->color = $args['color'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->gender = $args['gender'] ?? '';
    $this->price = $args['price'] ?? 0;
    $this->weight_kg = $args['weight_kg'] ?? 0.0;
    $this->condition_id = $args['condition_id'] ?? 3;
  }

  /*
   * How it is used: Restricts direct access to the raw $weight_kg and $condition_id values from outside the class.
   * Why it exists: Properties containing data that must undergo unit conversion, formatting, or custom lookup validation 
   * must be protected to enforce data integrity. If $weight_kg were public, external code could manipulate it directly, 
   * bypassing the rounding, formatting, or data type casting rules defined in the class methods, leading to inconsistent 
   * data states across the application. Text values like brand do not carry these structural risks.
   */

    // Logic handling weight conversions
    
  public function weight_kg() {
    return number_format($this->weight_kg, 2) . ' kg';
  }

  public function set_weight_kg($value) {
    $this->weight_kg = floatval($value);
  }

  public function weight_lbs() {
    $weight_lbs = floatval($this->weight_kg) * 2.2046226218;
    return number_format($weight_lbs, 2) . ' lbs';
  }

  /*
   * How it is used: Takes an input value in pounds, converts it mathematically, and sets the internal storage variable.
   * Why it exists: Enforces a single source of truth for measurements within the object's internal memory state. 
   * If separate properties like $weight_lbs and $weight_kg were both maintained publicly, they could easily drift out 
   * of sync if external scripts updated one without updating the other. intercepting the assignment converts 
   * incoming imperial values into the standardized metric baseline on the fly.
   */
  public function set_weight_lbs($value) {
    $this->weight_kg = floatval($value) / 2.2046226218;
  }

  /*
   * How it is used: Acts as an accessor method to retrieve the human-readable text label for a bicycle's condition status.
   * Why it exists: This method encapsulates the data lookup logic and prevents exposure of raw database keys. 
   * Exposing a raw $condition property directly to templates would force the view layer to know about the underlying 
   * integer IDs and handle lookup mappings manually. If the dictionary labels change or fallback requirements shift, 
   * the change is managed seamlessly here without modifying any presentation files.
   */

  // Logic handling condition dictionary lookups
  
  public function condition() {
    if($this->condition_id > 0) {
      return self::CONDITION_OPTIONS[$this->condition_id];
    } else {
      return "Unknown";
    }
  }

}

?>
