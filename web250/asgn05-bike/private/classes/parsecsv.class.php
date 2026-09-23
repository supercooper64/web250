<?php

class ParseCSV {

  /*
   * How it is used: Accessed directly via ParseCSV::$delimiter to check or change the character splitting fields.
   * Why it exists: It needs to be a static property because the column splitting character belongs globally to the parsing 
   * engine tool itself, rather than an individual row of data. Making it a public property instead of a hidden class 
   * constant (const) is necessary because constants are immutable; a property lets external consumer pages dynamically 
   * overwrite the delimiter from outside (e.g., swapping it to a pipe character '|' for the bird file) at runtime.
   */
  public static $delimiter = ',';

  private $filename;
  private $header;
  private $data = [];
  private $row_count = 0;

  public function __construct($filename='') {
    if($filename != '') {
      $this->file($filename);
    }
  }

  public function file($filename) {
    if(!file_exists($filename)) {
      return false;
    } elseif(!is_readable($filename)) {
      return false;
    }
    $this->filename = $filename;
    return true;
  }

  public function parse() {
    if(!isset($this->filename)) {
      return false;
    }

    // Clear out any stale data records remaining in memory from prior actions
    $this->reset();

    $file = fopen($this->filename, 'r');
    while(!feof($file)) {
      $row = fgetcsv($file, 0, self::$delimiter);
      if($row == [NULL] || $row === false) { continue; }
      if(!$this->header) {
        $this->header = $row;
      } else {
        $this->data[] = array_combine($this->header, $row);
        
        /*
         * How it is used: Increments a private running track total ($this->row_count++) inside the line-by-line reading loop.
         * Why it exists: Maintaining a sequential integer tracking counter is highly performant (O(1) execution). 
         * If we did not count sequentially during the active loop process, the script would be forced to run the array counting 
         * utility count($this->data) separately later. Running count updates across a massive arrays requires PHP to systematically 
         * traverse entire memory frames (O(N) layout overhead), wasting server cycles.
         */
        $this->row_count++;
      }
    }
    fclose($file);
    return $this->data;
  }

  /*
   * How it is used: Called by client views to pull the array memory cache generated during the last file read operation.
   * Why it exists: This provides a local state lookup. If your view presentation layer needs to loop over your file dataset 
   * multiple separate times down the page (e.g., rendering a count, rendering an inventory chart, or generating summary stats), 
   * running the parse() method repeatedly would force the filesystem to execute multiple expensive storage disk lookups. 
   * This provides seamless access to the memory cache array without disk re-reads.
   */
  public function last_results() {
    return $this->data;
  }

  public function row_count() {
    return $this->row_count;
  }

  /*
   * How it is used: Empties state properties ($data, $header, $row_count) right before a file processing loop begins.
   * Why it exists: Enforces script boundary safety and encapsulates data execution. If this cleanup routine were public, 
   * external script controllers could inadvertently trigger a data dump mid-operation, instantly splitting data states 
   * and causing array index mismatch bugs. Restricting visibility to private guarantees that data flushing remains strictly 
   * under the deterministic control of the engine's internal parse process.
   */
  private function reset() {
    $this->header = null;
    $this->data = [];
    $this->row_count = 0;
  }

}

?>
