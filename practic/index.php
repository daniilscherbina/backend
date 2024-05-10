<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (empty($_SERVER['PHP_AUTH_USER']) ||
        empty($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] != 'admin' ||
        md5($_SERVER['PHP_AUTH_PW']) != md5('50199')) {
      header('HTTP/1.1 401 Unanthorized');
      header('WWW-Authenticate: Basic realm="My site"');
      print('<h1>401 Требуется авторизация</h1>');
      exit();
    }
    include('dashboard.php');
    setcookie('request4', '', 100000);
    setcookie('request5_start', '', 100000);
    setcookie('request5_end', '', 100000);
} else {
    if (isset($_POST['request'])) {
        if ($_POST['request'] == 4) {
            setcookie('request4', $_POST['last_name']);
            header('Location: index.php?request4');
        }
    }
}
