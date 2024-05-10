<div class="top-subblock">
    <div class="top-subblock-header">
        Запрос под номером: 5
    </div>
    <div class="top-subblock-content">
        <form action="" method="POST">
            <input class="search-bar" type="hidden" id="request" name="request" value="5">
            <input class="search-bar" type="text" id="request5_start" name="request5_start" placeholder="Начало промежутка">
            <input class="search-bar" type="text" id="request5_end" name="request5_end" placeholder="Конец промежутка">
            <input type="submit" class="add-button"  value="Выполнить запрос">
        </form>
    </div>
</div>
<div class="bottom-subblock">
    <div class="discription">
       Выбирает из таблицы КЛИЕНТЫ, ДОГОВОРЫ и АГЕНТЫ информацию обо всех договорах (ФИО клиента, Вид страхования, Сумма страхования, дата заключения договора, ФИО агента), заключенные в некоторый заданный промежуток времени.
    </div>
    <table>
        <?php
            require_once "database.php";
            global $post;
            if (isset($post['request5_start']) && isset($post['request5_end'])) {
                $result = get_result_5($post['request5_start'], $post['request5_end']);
                if(!is_null($result)) {
                  $rows = $result->fetchAll(PDO::FETCH_ASSOC);
      
                  $columnCount = $result->columnCount();
                  $columnNames = array();
                  for ($i = 0; $i < $columnCount; $i++) {
                      $columnMeta = $result->getColumnMeta($i);
                      $columnNames[] = $columnMeta['name'];
                  }
      
                  print('<tr>');
                  foreach ($columnNames as $name) {
                    print('<th>');
                      print($name);
                    print('</th>');
                  }
                  print('</tr>');
      
                  foreach ($rows as $row) {
                    print('<tr>');
                      foreach ($row as $col) {
                          print('<td>');
                              print($col);
                          print('</td>');
                      }
                    print('</tr>');
                  }
                }
            }
        ?>
    </table>
</div>
