<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (empty($_SERVER['PHP_AUTH_USER']) ||
        empty($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] != 'admin' ||
        md5($_SERVER['PHP_AUTH_PW']) != md5('50199')) {
      header('HTTP/1.1 401 Unanthorized');
      header('WWW-Authenticate: Basic realm="My site"');
      print('<h1>401 Требуется авторизация</h1>');
      exit();
    }
    $post = array();
    if (isset($_COOKIE['request4'])) {
        $post['request4'] = $_COOKIE['request4'];
    }
    if (isset($_COOKIE['request5_start'])) {
        $post['request5_start'] = $_COOKIE['request5_start'];
    }
    if (isset($_COOKIE['request5_end'])) {
        $post['request5_end'] = $_COOKIE['request5_end'];
    }
    setcookie('request4', '', 100000);
    setcookie('request5_start', '', 100000);
    setcookie('request5_end', '', 100000);
    include('dashboard.php');
} else {
    if (isset($_POST['request'])) {
        if ($_POST['request'] == 4) {
            setcookie('request4', $_POST['last_name'], time() + 24 * 60 * 60);
            header('Location: index.php?request4');
        }
        if ($_POST['request'] == 5) {
            setcookie('request5_start', $_POST['request5_start'], time() + 24 * 60 * 60);
            setcookie('request5_end', $_POST['request5_end'], time() + 24 * 60 * 60);
            header('Location: index.php?request5');
        }
    } else {
        if (isset($_POST['add_new_row'])) {
            require_once 'database.php';
            require_once "table_row_validator.php";
            if (get_count_rows($_POST['add_new_row']) == -1) {
                header('Location: index.php?error="таблица не была найдена"');
                exit();
            }
            $table_col_names = get_table_colown_names($_POST['add_new_row']);
            $correct = true;
            $counter = 0;
            foreach ($table_col_names as $row) {
                foreach ($row as $name) {
                    if (isset($_POST[$name])) {
                        if (!table_validator($_POST['add_new_row'], $name, $_POST[$name])) {
                            $correct = false;
                        } else {
                            $counter += 1;
                        }
                    }
                }
            }
            if ($correct == false || $counter != get_count_rows($_POST['add_new_row'])) {
                header('Location: index.php?error="Отправленные данные некорректы ' . $counter . ' ' . ($correct) ? 'true' : 'false' . '"');
                exit();
            }

            header('Location: index.php?error="Отправленно"');
            exit();
        }
    }
}
