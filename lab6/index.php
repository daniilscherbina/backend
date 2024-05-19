<?php

  header('Content-Type: text/html; charset=UTF-8');
  header('Cache-Control: no-cache, must-revalidate');

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "page_handlers/index/get_handler.php";
    exit();
  }

  include "page_handlers/index/post_handler.php";
?>
