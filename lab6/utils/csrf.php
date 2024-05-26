<?php
$session_lifetime = 300; // 5 минут

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_lifetime) {
    session_unset();
    session_destroy();
    unset($_SERVER['PHP_AUTH_USER']);
    unset($_SERVER['PHP_AUTH_PW']);
    print("Сессия устарела. Пожалуйста, войдите снова.");
    exit();
}

// Обновление времени последней активности
$_SESSION['last_activity'] = time();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
