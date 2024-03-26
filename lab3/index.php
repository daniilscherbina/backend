<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их

// Проверяем ошибки.
$errors = FALSE;
require_once "validator.php";
if (!is_valid_fio($_POST['fio'])) {
  print('Заполните корректно имя.<br/>');
  $errors = TRUE;
}

if (!is_valid_data_birth($_POST['date_birth'])) {
  print('Заполните корректно дату рождения.<br/>');
  $errors = TRUE;
}

if (!is_valid_tel($_POST['tel'])) {
  print('Заполните корректно номер телефона.<br/>');
  $errors = TRUE;
}

if (!is_valid_email($_POST['email'])) {
  print('Заполните корректно email.<br/>');
  $errors = TRUE;
}

if (!is_valid_pol($_POST['pol'])) {
  print('Заполните корректно пол.<br/>');
  $errors = TRUE;
}

if (!is_valid_bio($_POST['biography'])) {
  print('Заполните корректно биографию.<br/>');
  $errors = TRUE;
}

require_once "database.php";
try {
  print($_POST['lan']);
  if (!language_exists($_POST['lan'])) {
    print('Заполните корректно любимые языки программирования.<br/>');
    $errors = TRUE;
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

/*$user = 'db'; // Заменить на ваш логин uXXXXX
$pass = '123'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=test', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO application SET name = ?");
  $stmt->execute([$_POST['fio']]);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}*/

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
