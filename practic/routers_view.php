<?php
  function print_error_content() {
    print('Некорректные параметры в url');
  }

  $tables = ['insurance_type', 'clients', 'insurance_agents', 'contracts'];

  $requests_discription = array(
    '9' => 'Выбирает информацию о VIP клиентах, для которых процент скидки равен 0.5%'
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
      if(!in_array(strval($request_num), $requests_discription)) {
        print_error_content();
      } else {
        include('request_table_template.php');
      }
    },
    'all_request' => function ($par) {
      print('тут что-то должно быть');
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
