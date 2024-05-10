<?php
  function print_error_content() {
    print('Некорректные параметры в url');
  }

  $tables = ['insurance_type', 'clients', 'insurance_agents', 'contracts'];

  $views = array(
    'table' => function build_mains_table_view($table_name) {
      global $tables;
      if(!in_array($table_name, $tables)) {
        print_error_content();
      } else {
        include('table_template_view.php');
      }
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
