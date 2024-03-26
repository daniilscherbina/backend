<?php
function is_valid_fio($fio) {
  return !empty($fio) && preg_match("/^[а-яА-Яa-zA-Z\s]+$/u", $fio);
}
function is_valid_tel($tel) {
  return !empty($tel) && preg_match("/^(\+7|\+38)?\s?\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{2}[\s-]?\d{2}$/", $tel);
}
function is_valid_email($email) {
  return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}
function is_valid_data_birth($birth) {
  return !empty($birth) && preg_match("/^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d$/", $birth);
}
function is_valid_pol($pol) {
  return !empty($pol) && preg_match("/^(мужской|женский)$/", $pol);
}
function is_valid_bio($bio) {
  return !empty($bio) && preg_match("/^[a-zA-Zа-яА-Я0-9\s.,!?]+$/", $bio);
}
?>
