<!DOCTYPE html>
<html>
  <head>
    <title>Добавить новую запись в таблицу: <?php print($table); ?></title>
    <link rel="stylesheet" href="../lab6/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
  </head>
  <body>
    <form action="" method="POST">
      <h1>Добавить новую запись в таблицу: <?php print($table); ?></h1>
      <label for="fio">ФИО:</label>
      <input type="text" id="fio" name="fio"><br><br>
      
      <input type="submit" value="Отправить">
    </form>
  </body>
</html>
