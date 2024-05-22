<?php
    if (isset($_POST['delete_answer'])) {
        require_once "utils/database.php";
        if (find_user($_POST['delete_answer']) > 0) {
            try {
                delete_answer($_POST['delete_answer']);
            } catch(PDOException $e){
                print('Error');
                exit();
            }
        }
        header('Location: ./admin.php');
    }
?>
