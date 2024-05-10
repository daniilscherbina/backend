<div class="top-subblock">
    <div class="top-subblock-header">
        <?php print('Запрос под номером: ' . $request_num); ?>
    </div>
    <div class="top-subblock-content">
        <input class="search-bar" type="text" placeholder="Поиск">
    </div>
</div>
<div class="bottom-subblock">
    <table>
        <?php
            require_once "database.php";
            
        ?>
    </table>
</div>
