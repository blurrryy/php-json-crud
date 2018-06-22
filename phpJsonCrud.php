<?php

class jsonCrud {
  function __construct($file, $what) {
    $this->file = $file;
    $rawFile = file_get_contents($file);
    $this->data = json_decode($rawFile, true);
    $this->what = $what;
  }
  
  function create($item) {
    $this->data[$this->what] = array_values($this->data[$this->what]);
    array_push($this->data[$this->what], $item);
    $this->save();
  }

  function read() {
    return $this->data[$this->what];
  }

  function delete($id) {
    unset($this->data[$this->what][$id]);
    $this->save();
  }

  function save() {
    file_put_contents($this->file, json_encode($this->data));
    $this->reinit();
  }

  function reinit() {
    $rawFile = file_get_contents($this->file);
    $this->data = json_decode($rawFile, true);
  }
}
?>
