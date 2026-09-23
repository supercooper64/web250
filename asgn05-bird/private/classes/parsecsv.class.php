<?php

/*
 * ParseCSV -- PROVIDED. Do not change this file.
 *
 * This is the class from chapter 7, video 06. It is finished. Read it, use
 * it, and write the required "why" comments about it in your submission, but
 * do not edit the code.
 *
 * In particular: do NOT change the delimiter below to a pipe. If you find
 * yourself wanting to, re-read the note on $delimiter and look at how
 * birds.php is supposed to set it. Hard-coding this file's delimiter inside
 * the class is the one mistake that costs the most points on this
 * assignment, because it destroys the only interesting property this class
 * has -- that the same parser reads the bike file and the bird file.
 *
 * Two small differences from the video version, both noted inline: the file
 * checks return a value instead of echoing, and parse() skips a row whose
 * field count does not match the header.
 */

class ParseCSV {

  /*
   * why comment required (for your submission): this is a static PROPERTY,
   * while Bicycle::CATEGORIES is a CONSTANT. Why is each the right choice
   * for its job? And why is this static rather than an ordinary property?
   *
   * Note the value: a comma. That is correct and you should leave it.
   * wnc-birds.csv does not use commas, which is a problem birds.php solves,
   * not this file.
   */
  public static $delimiter = ',';

  /*
   * why comment required: these four are private. What are they for, and why
   * should nothing outside this object be able to reach them?
   */
  private $filename;
  private $header;
  private $data = [];
  private $row_count = 0;

  public function __construct($filename = '') {
    if ($filename != '') {
      $this->file($filename);
    }
  }

  /*
   * Returns true if the file can be read, false if it cannot.
   *
   * The video version echoes "File does not exist." here. This one returns
   * false silently instead, because a class has no business deciding where
   * and how an error message appears on a page -- that is the page's job.
   * See the error handling in birds.php.
   */
  public function file($filename) {
    if (!file_exists($filename)) {
      $this->filename = NULL;
      return false;
    } elseif (!is_readable($filename)) {
      $this->filename = NULL;
      return false;
    }
    $this->filename = $filename;
    return true;
  }

  public function parse() {
    if (!isset($this->filename)) {
      return false;
    }

    // clear any previous results
    $this->reset();

    $file = fopen($this->filename, 'r');
    while (!feof($file)) {
      $row = fgetcsv($file, 0, self::$delimiter);

      // A trailing newline in the file reads as [NULL]; a read error reads as
      // FALSE. Neither is a record, so skip both. Without this you get an
      // empty row at the bottom of your table.
      if ($row == [NULL] || $row === FALSE) { continue; }

      if (!$this->header) {
        $this->header = $row;
      } else {
        // array_combine() requires both arrays to be the same size, so a
        // malformed line would be a fatal error. Skipping it keeps one bad
        // row from taking down the whole page.
        if (count($this->header) !== count($row)) { continue; }
        $this->data[] = array_combine($this->header, $row);
        $this->row_count++;
      }
    }
    fclose($file);
    return $this->data;
  }

  /*
   * why comment required: parse() already returns the data. When would you
   * need this method instead?
   */
  public function last_results() {
    return $this->data;
  }

  /*
   * why comment required: why keep a counter during parsing instead of
   * calling count() on the data afterwards?
   */
  public function row_count() {
    return $this->row_count;
  }

  /*
   * why comment required: why is this private, and what could go wrong if a
   * page were able to call it?
   */
  private function reset() {
    $this->header = NULL;
    $this->data = [];
    $this->row_count = 0;
  }

  /*
   * OPTIONAL -- "go further" option 5 only.
   *
   * If you choose that option, add a column_values($column) method here that
   * returns the unique, sorted values found in one column. That is the single
   * exception to "do not change this file." Explain in your comment why the
   * method belongs in this class rather than in Bird.
   */

}

?>
