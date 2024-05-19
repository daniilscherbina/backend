<?php

header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
$session_started = false;
if (!empty($_COOKIE) && isset($_COOKIE[session_name()]) && $_COOKIE[session_name()] && session_start()) {
  $session_started = true;
  if (!empty($_SESSION['login'])) {
    // Если есть логин в сессии, то пользователь уже авторизован.
    // TODO: Сделать выход (окончание сессии вызовом session_destroy()
    //при нажатии на кнопку Выход).
    // Делаем перенаправление на форму.
    header('Location: ./');
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Логин</title>
    <link rel="stylesheet" href="src/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
  </head>
  <body>
    <form action="" method="post">
      <input name="login" placeholder="Логин"/>
      <input name="pass" placeholder="Пароль"/>
      <input type="submit" value="Войти" />
    </form>
  </body>
</html>

<?php
} else {
  require_once "utils/database.php";
  $hash = md5($_POST['pass']);
  if (!check_credentials($_POST['login'], $hash)) {
    exit();
  }

  if (!$session_started) {
    session_start();
  }
  // Если все ок, то авторизуем пользователя.
  $_SESSION['login'] = $_POST['login'];
  // Записываем ID пользователя.
  $_SESSION['uid'] = $_POST['login'];

  // Делаем перенаправление.
  header('Location: ./');
}
