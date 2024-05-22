<?php 
$errors = FALSE;

require_once "utils/validator.php";

if(!(isset($_POST['checkbox']) && $_POST['checkbox'] == 'yes')) {
  setcookie('no_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}

if (!is_valid_fio($_POST['fio'])) {
  setcookie('fio_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
setcookie('fio_value', $_POST['fio'], time() + 24 * 60 * 60);

if (!is_valid_data_birth($_POST['date_birth'])) {
  setcookie('date_birth_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
setcookie('date_birth_value', $_POST['date_birth'], time() + 24 * 60 * 60);

if (!is_valid_tel($_POST['tel'])) {
  setcookie('tel_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
setcookie('tel_value', $_POST['tel'], time() + 24 * 60 * 60);

if (!is_valid_email($_POST['email'])) {
  setcookie('email_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
setcookie('email_value', $_POST['email'], time() + 24 * 60 * 60);

if (!is_valid_pol($_POST['pol'])) {
  setcookie('pol_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
setcookie('pol_value', $_POST['pol'], time() + 24 * 60 * 60);

if (!is_valid_bio($_POST['biography'])) {
  setcookie('biography_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
setcookie('biography_value', $_POST['biography'], time() + 24 * 60 * 60);

require_once "utils/database.php";
try {
  if (!isset($_POST['lan']) || !language_exists($_POST['lan'])) {
    setcookie('lan_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
}
catch(PDOException $e){
  print('Error');
  exit();
}

if ($errors) {
  // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
  header('Location: index.php');
  exit();
}
else {
  // Удаляем Cookies с признаками ошибок.
  setcookie('fio_error', '', 100000);
  setcookie('tel_error', '', 100000);
  setcookie('date_birth_error', '', 100000);
  setcookie('email_error', '', 100000);
  setcookie('pol_error', '', 100000);
  setcookie('biography_error', '', 100000);
  setcookie('lan_error', '', 100000);
  setcookie('no_error', '', 100000);
  // TODO: тут необходимо удалить остальные Cookies.
}


if (!empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
    // TODO: перезаписать данные в БД новыми данными,
    // кроме логина и пароля.
    try {
      update_answer($_POST['fio'], $_POST['tel'], $_POST['date_birth'], $_POST['email'], $_POST['pol'], $_POST['biography'], $_POST['lan'], $_SESSION['uid']);
    } catch(PDOException $e){
      print('Error');
      exit();
    }
  }
  else {
    // Генерируем уникальный логин и пароль.
    // TODO: сделать механизм генерации, например функциями rand(), uniquid(), md5(), substr().
    $password = rand(1, 1000000);
    $hashed_password = md5($password);
    // TODO: Сохранение данных формы, логина и хеш md5() пароля в базу данных.
    try {
      $login = new_answer($_POST['fio'], $_POST['tel'], $_POST['date_birth'], $_POST['email'], $_POST['pol'], $_POST['biography'], $_POST['lan'], $hashed_password);

      setcookie('login', $login);
      setcookie('pass', $password);
    }
    catch(PDOException $e){
      print('Error');
      exit();
    }
  }

setcookie('save', '1');
header('Location: index.php');
?>
