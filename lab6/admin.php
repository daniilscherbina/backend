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

session_start();

$session_lifetime = 300; // 5 минут

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_lifetime) {
    session_unset();
    session_destroy();
    unset($_SERVER['PHP_AUTH_USER']);
    unset($_SERVER['PHP_AUTH_PW']);
    print("Сессия устарела. Пожалуйста, войдите снова.");
    exit();
}

// Обновление времени последней активности
$_SESSION['last_activity'] = time();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  include "page_handlers/admin/get_handler.php";
  exit();
}

include "page_handlers/admin/post_handler.php";
?>
