<div class="top-subblock">
    <div class="top-subblock-header">
        <?php print('Запрос под номером: ' . $request_num); ?>
    </div>
</div>
<div class="bottom-subblock">
    <div class="discription">
        <?php print($post_requests_discription[$request_num]); ?>
    </div>
    <table>
        <?php
            require_once "database.php";
        ?>
    </table>
</div>
