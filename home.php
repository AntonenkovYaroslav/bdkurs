
<!DOCTYPE html>  
<html lang="ru">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <link href="../css/admin1.css" rel="stylesheet"> 
    <title>Главная страница</title>  
    <style>  
        body {  
            font-family: Arial, sans-serif;  
            text-align: center;  
            margin-top: 50px;  
        }  
        .button {  
            padding: 0px 15px;  
            font-size: 16px;  
            color: white;  
            background-color: #007BFF;  
            border: none;  
            border-radius: 5px;  
            cursor: pointer;  
            text-decoration: none;
            line-height: 3;
        }  
        .button:hover {  
            background-color: #0056b3;  
        }  
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .sidebar {
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #f8f9fa;
            padding-top: 3px;
        }
        .sidebar .button {
            display: block;
            width: 100%;
            text-align: left;
            margin: 5px 0;
            word-spacing: 2px;
        }
        .content {
            margin-left: 220px;
            padding: 15px;
        }
    </style>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidebar .button').on('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('.content').load(url);
            });
        });
    </script>
</head>  
<body>  


<div class="sidebar">
    <a href="tabs/Clients.php" class="button">Клиенты</a> 
    <a href="tabs/Sotrudnik.php" class="button">Сотрудник</a>  
    <a href="tabs/TypeRab.php" class="button">Наименование работ</a>  
    <a href="tabs/TypeUsl.php" class="button">Наименование услуг</a>
    <a href="tabs/Zapch.php" class="button">Запчасти</a>
    <a href="tabs/Mark.php" class="button">Марки</a>
    <a href="tabs/Model.php" class="button">Модели</a>
    <a href="tabs/Ts.php" class="button">ТС</a>
    <a href="tabs/Status.php" class="button">Статус</a>
    <a href="tabs/Zayavka.php" class="button">Заявка</a>
    <a href="tabs/Chek.php" class="button">Чек</a>
    <a href="otchet.php" class="button">Отчет</a>
</div>
<div class="content">
    <!-- Content will be loaded here -->
    <h2>Здесь будут отображаться таблицы при нажатии кнопок</h2>
</div>

</body>  
</html>