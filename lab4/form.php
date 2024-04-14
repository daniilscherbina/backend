<!DOCTYPE html>
<html>
  <head>
    <title>Лабораторная работа 4</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
  </head>
  <body>
    <form action="" method="POST">
      <label for="fio">ФИО:</label>
      <input type="text" id="fio" name="fio"><br><br>
    
      <label for="tel">Телефон:</label>
      <input type="text" id="tel" name="tel"><br><br>
    
      <label for="date_birth">Дата рождения:</label>
      <input type="text" id="date_birth" name="date_birth"><br><br>
    
      <label for="email">Email:</label>
      <input type="email" id="email" name="email"><br><br>
    
      <label for="pol">Пол:</label>
      <select " id="pol" name="pol">
        <option value="м">мужской</option>
        <option value="ж">женский</option>
      </select>
      <br><br>
    
      <label for="biography">Биография:</label><br>
      <textarea id="biography" name="biography" rows="4" cols="50"></textarea><br><br>
    
      <label for="lan">Любимые языки::</label>
      <select multiple size="10" name="lan[]" id="lan">
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
  </body>
</html>
