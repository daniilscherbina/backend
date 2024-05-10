<div class="top-subblock">
    <div class="top-subblock-header">
        Запрос под номером: 4
    </div>
    <div class="top-subblock-content">
        <form action="" method="POST">
            <input class="search-bar" type="hidden" id="request" name="request" value="4">
            <input class="search-bar" type="text" id="last_name" name="last_name" placeholder="Фамилия страхового агента">
            <input type="submit" class="add-button"  value="Выполнить запрос">
        </form>
    </div>
</div>
<div class="bottom-subblock">
    <div class="discription">
       
    </div>
    <table>
        <?php
            require_once "database.php";
            global $post;
            if (isset($post['request4'])) {
                $result = get_result_request_4($post['request4']);

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
        ?>
    </table>
</div>
