<form action="" method="POST" class="new_row_form">
  <h1>Добавить новую запись в таблицу: <?php print($table); ?></h1>
  <input class="search-bar" type="hidden" id="add_new_row" name="add_new_row" value="' . $table . '">
  <?php
    require_once "database.php";
    $names = get_table_colown_names($table);
    foreach ($names as $row) {
        foreach ($row as $name) {
            print('<label for="' . $name . '">' . $name . ':</label>');
            print('<input type="text" id="' . $name . '" name="' . $name . '" class="search-bar"><br><br>');
        }
    }
  ?>
  
  <input type="submit" class="add-button" value="Отправить">
</form>
