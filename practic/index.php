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
    $post = array();
    if (isset($_COOKIE['request4'])) {
        $post['request4'] = $_COOKIE['request4'];
    }
    if (isset($_COOKIE['request5_start'])) {
        $post['request4'] = $_COOKIE['request5_start'];
    }
    if (isset($_COOKIE['request5_end'])) {
        $post['request4'] = $_COOKIE['request5_end'];
    }
    setcookie('request4', '', 100000);
    setcookie('request5_start', '', 100000);
    setcookie('request5_end', '', 100000);
    include('dashboard.php');
} else {
    if (isset($_POST['request'])) {
        if ($_POST['request'] == 4) {
            setcookie('request4', $_POST['last_name']);
            header('Location: index.php?request4');
        }
    }
}
