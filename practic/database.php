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

function get_result($str) {
    $db = create_db_connection();
    $query = $db->prepare($str);
    $query->execute();
    return $query;
}

function is_valid_fio($fio) {
  return !empty($fio) && preg_match("/^[а-яА-Яa-zA-Z]+$/u", $fio);
}

function get_result_4($str) {
    if (!is_valid_fio($str)) return null;
    $db = create_db_connection();
    $query = $db->prepare("SELECT ia.id AS 'Код агента', CONCAT(ia.first_name, ' ', ia.last_name, CASE WHEN ia.patronymic IS NOT NULL THEN CONCAT(' ', ia.patronymic) ELSE '' END) AS 'Ф.И.О. агента', ia.bet AS 'Процент вознаграждения' FROM insurance_agents ia WHERE ia.last_name = :name;");
    $query->bindParam(':name', $str);
    $query->execute();
    return $query;
}

$requests = array(
  '9' => "SELECT last_name as 'Фамилия', first_name as 'Имя', patronymic as 'Отчество', discount as 'Персональная скидка %' FROM clients WHERE discount = 0.5;",
  '8' => "SELECT date AS 'Дата подписания договора', MIN(amount_of_insurance) AS 'Минимальная сумма страхования', MAX(amount_of_insurance) AS 'Максимальная сумма страхования' FROM contracts GROUP BY date;",
  '6' => "SELECT c.date AS 'Дата подписания договора', CONCAT(cl.first_name, ' ', cl.last_name, CASE WHEN cl.patronymic IS NOT NULL THEN CONCAT(' ', cl.patronymic) ELSE '' END) AS 'Ф.И.О. клиента', c.amount_of_insurance AS 'Сумма страхования', (amount_of_insurance * ((SELECT tariff FROM insurance_type WHERE id = c.id_insurance_type) - (SELECT discount FROM clients WHERE id = c.id_clients)) / 100) AS 'Размер страховой премии' FROM contracts c JOIN clients cl ON c.id_clients = cl.id;",
  '3' => "SELECT ia.id AS 'Код агента', CONCAT(ia.first_name, ' ', ia.last_name, CASE WHEN ia.patronymic IS NOT NULL THEN CONCAT(' ', ia.patronymic) ELSE '' END) AS 'Ф.И.О. агента',  c.id AS 'Код контракта', c.date AS 'Дата подписания контракта', CONCAT(cl.first_name, ' ', cl.last_name, CASE WHEN cl.patronymic IS NOT NULL THEN CONCAT(' ', cl.patronymic) ELSE '' END) AS 'Ф.И.О. клиента', c.amount_of_insurance AS 'Сумма страхования', it.name AS 'Тип страхования' FROM insurance_agents ia JOIN contracts c ON ia.id = c.id_insurance_agent JOIN insurance_type it ON it.id = c.id_insurance_type JOIN clients cl ON cl.id = c.id_clients WHERE c.amount_of_insurance >= 200000;",
  '2' => "SELECT ia.id AS 'Код агента', CONCAT(ia.first_name, ' ', ia.last_name, CASE WHEN ia.patronymic IS NOT NULL THEN CONCAT(' ', ia.patronymic) ELSE '' END) AS 'Ф.И.О. агента', ia.bet AS 'Процент вознаграждения' FROM insurance_agents ia WHERE bet >= 20 AND bet <= 50;",
  '1' => "SELECT cl.id AS 'Код клиента', CONCAT(cl.first_name, ' ', cl.last_name, CASE WHEN cl.patronymic IS NOT NULL THEN CONCAT(' ', cl.patronymic) ELSE '' END) AS 'Ф.И.О. клиента', cl.discount AS 'Персональная скидка %' FROM clients cl WHERE last_name = 'Иванов';",
  '7' => "SELECT c.id_insurance_agent AS 'Код агента', CONCAT(ia.first_name, ' ', ia.last_name, CASE WHEN ia.patronymic IS NOT NULL THEN CONCAT(' ', ia.patronymic) ELSE '' END) AS 'Ф.И.О. агента', AVG(c.amount_of_insurance) AS 'Среднее значение суммы страхования' FROM contracts c JOIN insurance_agents ia ON ia.id = c.id_insurance_agent GROUP BY c.id_insurance_agent;",
);

?>
