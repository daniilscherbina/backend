<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, must-revalidate');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  include "page_handlers/index/get_handler.php";
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их

// Проверяем ошибки.
include "page_handlers/index/post_handler.php";
?>
