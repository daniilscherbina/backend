<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Trebuchet MS', Helvetica, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #101729;
            margin: 0;
            padding: 0;
        }
        .left-block {
            padding-top: 75px;
            display: flex;
            flex-direction: column;
            width: 250px;
            background-color: #161d2f;
            color: white;
            a {
                color: white;
                padding: 15px;
                padding-left: 25px;
                font-size: 20px;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            a:hover {
                background-color: #1d283c;
                border-right: 5px solid #2869ff;
            }
        }
        .right-block {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .top-subblock {
            min-height: 80px;
            display: flex;
            padding: 25px;
            justify-content: space-between;
            background-color: #101729;
            flex-direction: column;
            .top-subblock-content {
                display: flex;
                justify-content: space-between;
            }
            .top-subblock-header {
                color: white;
                font-size: 26px;
                margin-bottom: 25px;
            }
        }
        .bottom-subblock {
            flex-grow: 1;
            overflow: auto;
            padding: 25px;
            background-color: #101729;
        }
        .add-button {
            background-color: #2968ff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
        }
        .del-button {
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
        }
        .search-bar {
            background-color: #1d283c;
            color: white;
            padding: 10px 25px;
            border: none;
            width: 250px;
            border-radius: 10px;
        }
        .stat {
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1d283c;
            color: white;
            padding: 10px 20px;
            text-align: left;
            margin-left: 5px;
        }

        th:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        th:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        td {
            background-color: transparent;
            color: white;
            padding: 10px 25px;
        }
    </style>
</head>
<body>
    <div class="right-block">
        <div class="top-subblock">
            <div class="top-subblock-header">
                Данные опроса
            </div>
            <div class="stat">
                <?php
                    require_once "database.php";
                    $lan = get_languages();
                    while ($row = $lan->fetch()) {
                        printf('%s: %d человек<br>', $row['name'], 1);
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
                    require_once "database.php";
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
