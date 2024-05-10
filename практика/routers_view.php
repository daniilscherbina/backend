<?php
  $tables = ['insurance_type', 'clients', 'insurance_agents', 'contracts'];

  function print_error_content() {
  }
  function build_mains_table_view($table_name) {
    global $tables;
    if(!in_array($table_name, $tables);) {
      print_error_content()
    } else {
      include('table_template_view.php');
    }
  }
?>
