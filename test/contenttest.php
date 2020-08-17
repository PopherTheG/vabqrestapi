<?php

require_once('../model/Content.php');

try {
  $content = new Content(1, 1, 'sName Here', 'sSentences here');
  header('Content-type: application/json;charset=UTF-8');
  echo json_encode($content->returnContentAsArray());
} catch (ContentException $ex) {
  echo 'Error: ' . $ex->getMessage();
}