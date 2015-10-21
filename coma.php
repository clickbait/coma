<?php
Class Coma {
  private $delimiter = ',';
  private $eol = "\n";
  public function __construct($csv, array $csvSettings = []) {
    $this->csv = $csv;

    if (array_key_exists('delimiter', $csvSettings)) {
      $this->delimiter = $csvSettings['delimiter'];
    }

    if (array_key_exists('eol', $csvSettings)) {
      $this->eol = $csvSettings['eol'];
    }
  }
  public function parse() {
    $i = null;

    list($headers, $this->csv) = explode($this->eol, $this->csv, 2);
    $headers = str_getcsv($headers, $this->delimiter, '"');

    foreach ($headers as $header) {
      $this->{$header} = [];
      $this->keymap[(Int)$i++] = $header;
    }


    $i = null;
    $lines = explode($this->eol, $this->csv);
    foreach ($lines as $line ) {
      $columns = str_getcsv($line, $this->delimiter, '"');
      if (count($columns) > count($this->keymap)) {
        continue;
      }
      foreach ($columns as $column) {
        $num = (Int)$i++;
        $header = $this->keymap[$num];
        $data[$header] = $column;
      }
      $this->data[] = $data;
      $data = null;
      $i = null;
    }
    return $this->data;
  }
}
