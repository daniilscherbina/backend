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
        <tr>
            <th>Колонка 1</th>
            <th>Колонка 2</th>
            <th>Колонка 3</th>
            <th>Колонка 4</th>
            <th>Колонка 5</th>
        </tr>
        <?php
            require_once "database.php";
            $rows = get_all_rows_table($table_name);
        ?>
    </table>
</div>
