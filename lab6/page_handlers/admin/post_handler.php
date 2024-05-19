<?php
    if (isset($_POST['delete_answer'])) {
        require_once "utils/database.php";
        if (find_user($_POST['delete_answer']) > 0) {
            delete_answer($_POST['delete_answer']);
        }
        header('Location: ./');
    }
?>