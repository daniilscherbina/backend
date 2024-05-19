<!DOCTYPE html>
<html>
<head>
    <title>Лабораторная работа 6</title>
    <link rel="stylesheet" href="src/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<body>
    <div class="right-block">
        <div class="top-subblock">
            <div class="top-subblock-header">
                Данные опроса
            </div>
            <div class="stat">
                <?php
                    require_once "utils/database.php";
                    $lan = get_languages();
                    while ($row = $lan->fetch()) {
                        printf('%s: %d человек<br>', $row['name'], get_lan_answer_count($row['id_lan']));
                    }
                ?>
            </div>
        </div>
        <div class="bottom-subblock">
            <table>
                <tr>
                    <th>Ф.И.О</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Пол</th>
                    <th>Дата рождения</th>
                </tr>
                <?php
                    require_once "utils/database.php";
                    $rows = get_all_user_info();
                    foreach ($rows as $row) {
                        print('<tr>');
                            print('<td>' . $row['fio'] . '</td>');
                            print('<td>' . $row['email'] . '</td>');
                            print('<td>' . $row['tel'] . '</td>');
                            print('<td>' . $row['pol'] . '</td>');
                            print('<td>' . $row['date_birth'] . '</td>');
                            print('<td><button class="add-button">Подробнее</button></td>');
                            print('<td><button class="del-button">Удалить</button></td>');
                        print('</tr>');
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
