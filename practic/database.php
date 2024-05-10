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
  '9' => function() {
    $db = create_db_connection();
    $query = $db->prepare("SELECT last_name as 'Фамилия', first_name as 'Имя', patronymic as 'Отчество', discount as 'Персональная скидка %' FROM clients WHERE discount = 0.5;");
    $query->execute();
    return $query;
  },
  '8' => function() {
    $db = create_db_connection();
    $query = $db->prepare("SELECT date AS 'Дата подписания договора', MIN(amount_of_insurance) AS 'Минимальная сумма страхования', MAX(amount_of_insurance) AS 'Максимальная сумма страхования' FROM contracts GROUP BY date;");
    $query->execute();
    return $query;
  },
  '6' => function() {
    $db = create_db_connection();
    $query = $db->prepare("SELECT c.date AS 'Дата подписания договора', CONCAT(cl.first_name, ' ', cl.last_name, ' ', cl.patronymic) AS 'Ф.И.О. клиента', c.amount_of_insurance AS 'Сумма страхования', (amount_of_insurance * ((SELECT tariff FROM insurance_type WHERE id = c.id_insurance_type) - (SELECT discount FROM clients WHERE id = c.id_clients)) / 100) AS 'Размер страховой премии' FROM contracts c JOIN clients cl ON c.id_clients = cl.id;");
    $query->execute();
    return $query;
  },
);

?>
