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
            if (isset(post['request4'])) {
                print(post['request4']);
            }
        ?>
    </table>
</div>
