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
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
    ?>
  </select>
  
  <input type="submit" value="Отправить">
</form>
