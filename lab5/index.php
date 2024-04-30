<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, must-revalidate');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages['yes'] = 'Спасибо, результаты сохранены.';
    if (!empty($_COOKIE['pass'])) {
      $messages['logpas'] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass']));
    }
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['tel'] = !empty($_COOKIE['tel_error']);
  $errors['date_birth'] = !empty($_COOKIE['date_birth_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['pol'] = !empty($_COOKIE['pol_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['lan'] = !empty($_COOKIE['lan_error']);
  $errors['no'] = !empty($_COOKIE['no_error']);
  
  require_once "form_cookies.php";
  error_cookie_cl('fio', 'Укажите имя', $errors, $messages);
  error_cookie_cl('tel', 'Укажите номер телефона', $errors, $messages);
  error_cookie_cl('date_birth', 'Укажите дату рождения', $errors, $messages);
  error_cookie_cl('email', 'Укажите email', $errors, $messages);
  error_cookie_cl('pol', 'Укажите корректный пол', $errors, $messages);
  error_cookie_cl('biography', 'В данном поле допустимо использование следующих символов: буквы кириллицы и латиницы, цифры, точка, запятая, восклицательный и вопросительный знак', $errors, $messages);
  error_cookie_cl('lan', 'Выберете языки из списка выше', $errors, $messages);
  error_cookie_cl('no', 'Для обработки запроса вы должны быть согласны с обработкой данных', $errors, $messages);

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  values_set('fio', $values);
  values_set('tel', $values);
  values_set('date_birth', $values);
  values_set('email', $values);
  values_set('pol', $values);
  values_set('biography', $values);
  values_set('lan', $values);

  if (empty($errors) && !empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
    // TODO: загрузить данные пользователя из БД
    // и заполнить переменную $values,
    // предварительно санитизовав.
    printf('Вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
  }
  //
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их

// Проверяем ошибки.
$errors = FALSE;
require_once "validator.php";
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

if (!is_valid_bio($_POST['biography'])) {
  setcookie('biography_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
setcookie('biography_value', $_POST['biography'], time() + 24 * 60 * 60);

require_once "database.php";
try {
  if (!isset($_POST['lan']) || !language_exists($_POST['lan'])) {
    setcookie('lan_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
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
  }
  else {
    // Генерируем уникальный логин и пароль.
    // TODO: сделать механизм генерации, например функциями rand(), uniquid(), md5(), substr().
    $login = '123';
    $pass = '123';
    // Сохраняем в Cookies.
    setcookie('login', $login);
    setcookie('pass', $pass);

    // TODO: Сохранение данных формы, логина и хеш md5() пароля в базу данных.
    // ...
    // Сохранение в базу данных.
    try {
      new_answer($_POST['fio'], $_POST['tel'], $_POST['date_birth'], $_POST['email'], $_POST['pol'], $_POST['biography'], $_POST['lan']);
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
  }

setcookie('save', '1');
header('Location: index.php');
?>
