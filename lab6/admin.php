<?php

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.
require_once "utils/database.php";
try {
    if (empty($_SERVER['PHP_AUTH_USER']) ||
        empty($_SERVER['PHP_AUTH_PW']) ||
        !check_admin($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
       ) {
      header('HTTP/1.1 401 Unanthorized');
      header('WWW-Authenticate: Basic realm="My site"');
      print('<h1>401 Требуется авторизация</h1>');
      exit();
    }
}
    catch(PDOException $e){
    print('Error');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  include "page_handlers/admin/get_handler.php";
  exit();
}

include "page_handlers/admin/post_handler.php";
?>
