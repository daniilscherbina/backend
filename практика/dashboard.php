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
            height: 80px;
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
        .search-bar {
            background-color: #1d283c;
            color: white;
            padding: 10px 25px;
            border: none;
            width: 250px;
            border-radius: 10px;
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
    <div class="left-block">
        <a href="#">Статистика</a><br>
        <a href="#">Клиенты</a><br>
        <a href="#">Страховые агенты</a><br>
        <a href="#">Договоры</a><br>
        <a href="#">Типы страхования</a><br>
        <a href="#">Запросы</a><br>
    </div>
    <div class="right-block">
        <div class="top-subblock">
            <div class="top-subblock-header">
                Таблица номер 1
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
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
                <tr>
                    <td>Данные 1</td>
                    <td>Данные 2</td>
                    <td>Данные 3</td>
                    <td>Данные 4</td>
                    <td>Данные 5</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
