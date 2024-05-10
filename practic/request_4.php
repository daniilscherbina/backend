<div class="top-subblock">
    <div class="top-subblock-header">
        <?php print('Запрос под номером: 4'); ?>
    </div>
    <div class="top-subblock-content">
        <form action="" method="POST">
            <input class="search-bar" type="text" placeholder="Фамилия страхового агента">
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                print('post');
            }
        ?>
    </table>
</div>
