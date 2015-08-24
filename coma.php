<?php
Class Coma {
  public function __construct($csv) {
    $this->csv = $csv;
  }
  public function parse() {
    $i = null;

    list($headers, $this->csv) = explode("\n", $this->csv, 2);
    $headers = str_getcsv($headers, ',', '"');

    foreach ($headers as $header) {
      $this->{$header} = [];
      $this->keymap[(Int)$i++] = $header;
    }


    $i = null;
    $lines = explode("\n", $this->csv);
    foreach ($lines as $line ) {
      $columns = str_getcsv($line, ',', '"');
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