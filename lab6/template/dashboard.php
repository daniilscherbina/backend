<!DOCTYPE html>
<html>
<head>
    <title>Админка</title>
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
                    try {
                        while ($row = $lan->fetch()) {
                            printf('%s: %d человек<br>', htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'), htmlspecialchars(get_lan_answer_count($row['id_lan']), ENT_QUOTES, 'UTF-8'));
                        }
                    } catch(PDOException $e){
                        print('Error');
                        exit();
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
                    try {
                    $rows = get_all_user_info();
                        foreach ($rows as $row) {
                            print('<tr>');
                                print('<td>' . htmlspecialchars($row['fio'], ENT_QUOTES, 'UTF-8') . '</td>');
                                print('<td>' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '</td>');
                                print('<td>' . htmlspecialchars($row['tel'], ENT_QUOTES, 'UTF-8') . '</td>');
                                print('<td>' . htmlspecialchars($row['pol'], ENT_QUOTES, 'UTF-8') . '</td>');
                                print('<td>' . htmlspecialchars($row['date_birth'], ENT_QUOTES, 'UTF-8') . '</td>');
                                print('<td>');
                                    print('<form action="" method="POST">');
                                    print('<input type="hidden" id="open_answer" name="open_answer" value="' . htmlspecialchars($row['id_answer']) . '">');
                                    print('<input type="submit" class="add-button" value="Подробнее">');
                                    print('</form>');
                                print('</td>');
                                print('<td>');
                                print('<form action="" method="POST">');
                                    print('<input type="hidden" id="delete_answer" name="delete_answer" value="' . htmlspecialchars($row['id_answer']) . '">');
                                    print('<input type="submit" class="del-button" value="Удалить">');
                                    print('</form>');
                                print('</td>');
                            print('</tr>');
                        }
                    } catch(PDOException $e){
                        print('Error');
                        exit();
                      }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
