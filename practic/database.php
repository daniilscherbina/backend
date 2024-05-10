<?php
require_once "../secret.php";
function create_db_connection() {
    $user = get_db_user();
    $pass = get_db_pass();
    return new PDO('mysql:host=localhost;dbname=' . $user, $user, $pass,
                    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

function get_table_colown_names($table_name) {
  $db = create_db_connection();
  $result = $db->prepare("SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name = :table;");
  $result->bindParam(':table', $table_name);
  $result->execute();
  $rows = $result->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function get_all_rows_table($table_name) {
  $db = create_db_connection();
    $query = $db->prepare("SELECT * FROM " . $table_name);
    $query->execute();
    $rows = $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

$requests = array(
    '9' => function($request_num) {
        $query = $db->prepare("SELECT * FROM clients WHERE discount = 0.5;");
        $query->execute();
        return $query;
    }
);

?>
