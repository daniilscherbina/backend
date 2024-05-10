<div class="top-subblock">
    <div class="top-subblock-header">
        <?php print('Запрос под номером: ' . $request_num); ?>
    </div>
</div>
<div class="bottom-subblock">
    <div class="discription">
        <?php print($requests_discription[$request_num]); ?>
    </div>
    <table>
        <?php
            require_once "database.php";

            $result = $requests[$request_num]();

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
        ?>
    </table>
</div>
