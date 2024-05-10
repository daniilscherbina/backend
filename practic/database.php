<?php
require_once "../secret.php";
print($user);
function create_db_connection() {
    global $user;
    print($user);
    global $pass;
    return new PDO('mysql:host=localhost;dbname=' . $user, $user, $pass,
                    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

function get_table_colown_names($table_name) {
  $db = create_db_connection();
  $result = $db->query("SELECT * FROM " . $table_name);
  $columns = $result->fetch_fields();
  $column_names = array();
  foreach ($columns as $column) {
    $column_names[] = $column->name;
  }
  return $column_names;
}

function get_all_rows_table($table_name) {
  $db = create_db_connection();
    $query = $db->prepare("SELECT * FROM" . $table_name);
    $query->execute();
    $rows = array();
    while ($row = $query->fetch()) {
        $rows[] = $row;
    }
    return $rows;
}

?>
