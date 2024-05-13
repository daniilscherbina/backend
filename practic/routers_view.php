<?php
  function print_error_content() {
    print('Некорректные параметры в url');
  }

  $tables = ['insurance_type', 'clients', 'insurance_agents', 'contracts'];

  $requests_discription = array(
    9 => 'Выбирает информацию о VIP клиентах, для которых процент скидки равен 0.5%',
    8 => 'Выполняет группировку по полю дата заключения договора в таблице договоры. Для каждой группы вычисляет минимальное и максимальное значение суммы страхования',
    6 => 'Вычисляет для каждого договора размер страховой премии. Включает поля дата заключения договора, фио клиента, сумма страхования, страховая премия',
    3 => 'Выбор информации (АГЕНТЫ, ДОГОВОРЫ) о страховых агентах и договорах, для которых сумма страхования не меньше 200 000 руб',
    2 => 'Выбор информации о страховых агентах, процент вознаграждения для которых находится в диапазоне от 20% до 50%.',
    1 => 'Выбирает из таблицы информацию о клиентах с фамилией «Иванов».',
    7 => 'Выполняет группировку по полю код агента в таблице договоры. Для каждой группы вычисляет среднее значение суммы страхования',
  );

  $views = array(
    'table' => function ($table_name) {
      global $tables;
      if(!in_array($table_name, $tables)) {
        print_error_content();
      } else {
        include('table_template_view.php');
      }
    },
    'request' => function ($request_num) {
      global $requests_discription;
      if(!isset($requests_discription[$request_num])) {
        print_error_content();
      } else {
        include('request_table_template.php');
      }
    },
    'all_request' => function ($par) {
      include('all_request.php');
    },
    'request4' => function ($par) {
      include('request_4.php');
    },
    'request5' => function ($par) {
      include('request_5.php');
    },
    'new_row' => function ($table) {
      global $tables;
      if(!in_array($table, $tables)) {
        print_error_content();
      } else {
        include('add_row_template.php');
      }
    },
    'error' => function ($text) {
      print($text);
    }
  );

  function open_view($parameters) {
    if (!empty($parameters)) {
        if (count($parameters) == 1) {
            global $views;
            if (isset($views[array_key_first($parameters)])) {
                $views[array_key_first($parameters)]($parameters[array_key_first($parameters)]);
            } else {
                print_error_content();
            }
        }
    } else {
        print_error_content();
    }
  }
?>
