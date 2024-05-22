<?php
require_once "../secret.php";
function create_db_connection() {
    global $user;
    global $pass;
    return new PDO('mysql:host=localhost;dbname=' . $user, $user, $pass,
                    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

function check_admin($log, $p) {
    $db = create_db_connection();
    $query = $db->prepare("SELECT COUNT(*) FROM admins WHERE username = ? AND password = ?");
    $query->execute([$log, $p]);
    $count = $query->fetchColumn();
    return $count > 0;
}

function get_languages() {
  $db = create_db_connection();
  return $db->query("SELECT * FROM language");
}

function get_lan_answer_count($id) {
  $db = create_db_connection();
  return $db->query("SELECT COUNT(*) as total FROM answer_language WHERE language_id=" . $id)->fetch()['total'];
}

function get_all_user_info() {
    $db = create_db_connection();
    $query = $db->prepare("SELECT * FROM answer");
    $query->execute();
    $rows = array();
    while ($row = $query->fetch()) {
        $rows[] = $row;
    }
    return $rows;
}

function find_user($user_id) {
  $db = create_db_connection();
    $query = $db->prepare("SELECT * FROM answer WHERE id_answer=:id_answer");
    $query->bindParam(':id_answer', $user_id);
    $query->execute();
    $rows = array();
    while ($row = $query->fetch()) {
        $rows[] = $row;
    }
    return count($rows);
}

function delete_answer($user_id) {
  $db = create_db_connection();
  $db->beginTransaction();

  $stmt3 = $db->prepare("DELETE FROM answer_language WHERE answer_id = :answer_id");
  $stmt3->bindParam(':answer_id', $user_id);
  $stmt3->execute();

  $query = $db->prepare("DELETE FROM answer WHERE id_answer = :id_answer");
  $query->bindParam(':id_answer', $user_id);
  $query->execute();

  $query1 = $db->prepare("DELETE FROM users_table WHERE id = :id_answer");
  $query1->bindParam(':id_answer', $user_id);
  $query1->execute();

  $db->commit();
}

function language_exists($ids) {
    $db = create_db_connection();
    $placeholders = rtrim(str_repeat('?, ', count($ids)), ', '); // Генерация плейсхолдеров для запроса
    $query = $db->prepare("SELECT COUNT(*) FROM language WHERE id_lan IN ($placeholders)");
    $query->execute($ids);
    $count = $query->fetchColumn();
    return $count > 0;
}

function check_credentials($login, $password) {
    $db = create_db_connection();
    $query = $db->prepare("SELECT COUNT(*) FROM users_table WHERE id = ? AND pass = ?");
    $query->execute([$login, $password]);
    $count = $query->fetchColumn();
    return $count > 0;
}

function update_answer($fio, $tel, $date_birth, $email, $pol, $biography, $ids, $login) {
  $db = create_db_connection();
  $db->beginTransaction();
  $stmt = $db->prepare("UPDATE answer SET fio = :fio, tel = :tel, date_birth = :date_birth, email = :email, pol = :pol, biography = :biography WHERE id_answer = :login");
    
  // Привязка параметров
  $stmt->bindParam(':fio', $fio);
  $stmt->bindParam(':tel', $tel);
  $stmt->bindParam(':date_birth', $date_birth);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':pol', $pol);
  $stmt->bindParam(':biography', $biography);
  $stmt->bindParam(':login', $login);
  // Выполнение запроса
  $stmt->execute();

  $stmt3 = $db->prepare("DELETE FROM answer_language WHERE answer_id = :answer_id");
  $stmt3->bindParam(':answer_id', $login);
  $stmt3->execute();

  $stmt2 = $db->prepare("INSERT INTO answer_language (answer_id, language_id) VALUES (:answer_id, :language_id)");
  // Привязка параметров и добавление записей в цикле
  foreach ($ids as $language_id) {
    $stmt2->bindParam(':answer_id', $login);
    $stmt2->bindParam(':language_id', $language_id);
    $stmt2->execute();
  }
  
  $db->commit();
}


function new_answer($fio, $tel, $date_birth, $email, $pol, $biography, $ids, $password) {
  $db = create_db_connection();
  $db->beginTransaction();
  $stmt = $db->prepare("INSERT INTO answer (fio, tel, date_birth, email, pol, biography) VALUES (:fio, :tel, :date_birth, :email, :pol, :biography)");

  // Привязка параметров
  $stmt->bindParam(':fio', $fio);
  $stmt->bindParam(':tel', $tel);
  $stmt->bindParam(':date_birth', $date_birth);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':pol', $pol);
  $stmt->bindParam(':biography', $biography);
  // Выполнение запроса
  $stmt->execute();
  // Получение идентификатора добавленной записи
  $lastId = $db->lastInsertId();
  $stmt_u = $db->prepare("INSERT INTO users_table (id, pass) VALUES (:lastId, :pass)");
  $stmt_u->bindParam(':lastId', $lastId);
  $stmt_u->bindParam(':pass', $password);
  $stmt_u->execute();
    
  $stmt2 = $db->prepare("INSERT INTO answer_language (answer_id, language_id) VALUES (:answer_id, :language_id)");
  // Привязка параметров и добавление записей в цикле
  foreach ($ids as $language_id) {
    $stmt2->bindParam(':answer_id', $lastId);
    $stmt2->bindParam(':language_id', $language_id);
    $stmt2->execute();
  }
  $db->commit();
return $lastId;
}
?>
