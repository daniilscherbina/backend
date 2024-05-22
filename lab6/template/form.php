<!DOCTYPE html>
<html>
  <head>
    <title>Лабораторная работа 6</title>
    <link rel="stylesheet" href="src/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
  </head>
  <body>
    <form action="" method="POST">
      <?php
        if (!empty($messages) && !empty($messages['yes'])) {
          print('<div id="yes_mess">');
            print($messages['yes']);
          print('</div>');
        }
      ?>
      
      <?php
        if (!empty($messages) && !empty($messages['logpas'])) {
          print('<div id="logpas_mess">');
            print($messages['logpas']);
          print('</div>');
        }
      ?>
      <label for="fio">ФИО:</label>
      <input type="text" id="fio" name="fio" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>"><br><br>
      <?php
        if (!empty($messages) && !empty($messages['fio'])) {
          print('<div id="fio_mess">');
            print($messages['fio']);
          print('</div>');
        }
      ?>
    
      <label for="tel">Телефон:</label>
      <input type="text" id="tel" name="tel" <?php if ($errors['tel']) {print 'class="error"';} ?> value="<?php print $values['tel']; ?>"><br><br>
      <?php
        if (!empty($messages) && !empty($messages['tel'])) {
          print('<div id="tel_mess">');
            print($messages['tel']);
          print('</div>');
        }
      ?>
    
      <label for="date_birth">Дата рождения:</label>
      <input type="text" id="date_birth" name="date_birth" <?php if ($errors['date_birth']) {print 'class="error"';} ?> value="<?php print $values['date_birth']; ?>"><br><br>
      <?php
        if (!empty($messages) && !empty($messages['date_birth'])) {
          print('<div id="date_birth_mess">');
            print($messages['date_birth']);
          print('</div>');
        }
      ?>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"><br><br>
      <?php
        if (!empty($messages) && !empty($messages['email'])) {
          print('<div id="email_mess">');
            print($messages['email']);
          print('</div>');
        }
      ?>
      
      <label for="pol">Пол:</label>
      <select " id="pol" name="pol" <?php if ($errors['pol']) {print 'class="error"';} ?> >
        <option value="м" <?php if ($values['pol'] == 'м') print('selected="selected"'); ?>>мужской</option>
        <option value="ж" <?php if ($values['pol'] == 'ж') print('selected="selected"'); ?>>женский</option>
      </select>
      <br><br>
      <?php
        if (!empty($messages) && !empty($messages['pol'])) {
          print('<div id="pol_mess">');
            print($messages['pol']);
          print('</div>');
        }
      ?>
    
      <label for="biography">Биография:</label><br>
      <textarea id="biography" name="biography" rows="4" cols="50" <?php if ($errors['biography']) {print 'class="error"';} ?>><?php print $values['biography']; ?></textarea><br><br>
      <?php
        if (!empty($messages) && !empty($messages['biography'])) {
          print('<div id="biography_mess">');
            print($messages['biography']);
          print('</div>');
        }
      ?>
      
      <label for="lan">Любимые языки::</label>
      <select multiple size="10" name="lan[]" id="lan" <?php if ($errors['lan']) {print 'class="error"';} ?> >
        <?php
        require_once "utils/database.php";
        try {
          $lan = get_languages();
          while ($row = $lan->fetch()) {
            printf('<option value="%d">%s</option>', $row['id_lan'], $row['name']);
          }
        }
        catch(PDOException $e){
          print('Error');
          exit();
        }
        ?>
      </select>
      <?php
        if (!empty($messages) && !empty($messages['lan'])) {
          print('<div id="lan_mess">');
            print($messages['lan']);
          print('</div>');
        }
      ?>
      <div>
        <input type="checkbox" id="checkbox" name="checkbox" value="yes">
        <label for="checkbox" class="ch">Я согласен с обработкой данных</label>
      </div>
      <?php
        if (!empty($messages) && !empty($messages['no'])) {
          print('<div id="no_mess">');
            print($messages['no']);
          print('</div>');
        }
      ?>
      <input type="submit" value="Отправить">

    </form>
  </body>
</html>
