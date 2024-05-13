<?php 
  $table_entity = array(
    'clients' => array(
      'id' => '/^[0-9]+$/u',
      'last_name' => '/^[а-яА-Яa-zA-Z]+$/u',
      'first_name' => '/^[а-яА-Яa-zA-Z]+$/u',
      'patronymic' => '/^[а-яА-Яa-zA-Z]+$/u',
      'discount' => '/^0.[0-5]$/u',
    ),
    'insurance_type' => array(
      'id' => '/^[0-9]+$/u',
      'tariff' => '/^[1-5]$/u',
      'name' => '/^[a-zA-Zа-яА-Я0-9\s]+$/'
    ),
    'insurance_agents' => array(
      'id' => '/^[0-9]+$/u',
      'last_name' => '/^[а-яА-Яa-zA-Z]+$/u',
      'first_name' => '/^[а-яА-Яa-zA-Z]+$/u',
      'patronymic' => '/^[а-яА-Яa-zA-Z]+$/u',
      'bet' => '/^[0-9]+.[0-9]$/u',
    ),
    'contracts' => array(
      'id' => '/^[0-9]+$/u',
      'id_clients' => '/^[0-9]+$/u',
      'id_insurance_type' => '/^[0-9]+$/u',
      'id_insurance_agent' => '/^[0-9]+$/u',
      'date' => '/^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d$/',
      'amount_of_insurance' => '/^[0-9]+$/u',
    ),
  );

  function get_count_rows($table_name) {
    global $table_entity;
    if (!isset($table_entity[$table_name])) return -1;
    return count($table_entity[$table_name]);
  }  

  function table_validator($table_name, $row_names, $value) {
    global $table_entity;
    if (!isset($table_entity[$table_name])) return false;
    if (!isset($table_entity[$table_name][$row_name])) return false;
    return !empty($value) && preg_match($table_entity[$table_name][$row_name], $value);
  }
?>
