<?php 
  function error_cookie_cl($name, $text, &$errors) {
    if ($errors[$name]) {
      // Удаляем куки, указывая время устаревания в прошлом.
      setcookie($name . '_error', '', 100000);
      setcookie($name . '_value', '', 100000);
      // Выводим сообщение.
      $messages[] = '<div class="error">' . $text . '</div>';
    }
  }

  function values_set($name, &$values) {
    $values[$name] = empty($_COOKIE[$name . '_value']) ? '' : $_COOKIE[$name . '_value'];
  }
?>
