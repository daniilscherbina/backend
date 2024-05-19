<?php

  header('Content-Type: text/html; charset=UTF-8');
  header('Cache-Control: no-cache, must-revalidate');

  function error_content() {
    header('Location: ./index.php?page=form');
    exit();
  }

  $views = array(
    'form',
    'admin',
    'login',
  );

  function open_view($parameters) {
    if (!empty($parameters)) {
        if (count($parameters) == 1) {
            global $views;
            if (isset($parameters['page']) && isset($views[$parameters['page']])) {
              if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                include "page_handlers/" . $parameters['page'] . "/get_handler.php";
                exit();
              }
              
              include "page_handlers/" . $parameters['page'] . "/post_handler.php";
            } else {
                error_content();
            }
        }
    } else {
        error_content();
    }
  }

  open_view($_GET);
?>
