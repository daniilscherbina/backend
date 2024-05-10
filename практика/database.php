<?php
require_once "../secret.php";
function create_db_connection() {
    global $user;
    global $pass;
    return new PDO('mysql:host=localhost;dbname=' . $user, $user, $pass,
                    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
?>
