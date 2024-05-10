<div class="top-subblock">
    <div class="top-subblock-header">
        <?php print('Просмотр содержимого таблицы: ' . $table_name); ?>
    </div>
    <div class="top-subblock-content">
        <button class="add-button">Добавить новую запись</button>
        <input class="search-bar" type="text" placeholder="Поиск">
    </div>
</div>
<div class="bottom-subblock">
    <table>
        <?php
            require_once "database.php";
            $names = get_table_colown_names($table_name);

            print('<tr>');
            foreach ($names as $row) {
                foreach ($row as $name) {
                    print('<th>');
                        print($name);
                    print('</th>');
                }
            }
            print('</tr>');

            $rows = get_all_rows_table($table_name);
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
