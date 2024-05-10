<div class="top-subblock">
    <div class="top-subblock-header">
        <?php print('Запрос под номером: ' . $request_num); ?>
    </div>
</div>
<div class="bottom-subblock">
    <div>
        <?php print($requests_discription[$request_num]); ?>
    </div>
    <table>
        <?php
            require_once "database.php";
            
        ?>
    </table>
</div>
