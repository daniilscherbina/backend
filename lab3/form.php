<form action="" method="POST">
  <label for="fio">ФИО:</label>
  <input type="text" id="fio" name="fio" required><br><br>

  <label for="tel">Телефон:</label>
  <input type="text" id="tel" name="tel" required><br><br>

  <label for="date_birth">Дата рождения:</label>
  <input type="text" id="date_birth" name="date_birth" required><br><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br><br>

  <label for="pol">Пол:</label>
  <input type="text" id="pol" name="pol" required><br><br>

  <label for="biography">Биография:</label><br>
  <textarea id="biography" name="biography" rows="4" cols="50" required></textarea><br><br>

  <select name="lan">
    <?php
    require_once "database.php";
    try {
      $lan = get_languages();
      while ($row = $lan->fetch()) {
        printf('<option value="%d">%s</option>', $row['id_lan'], $row['name']);
      }
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
    ?>
  </select>
  
  <input type="submit" value="Отправить">
</form>
