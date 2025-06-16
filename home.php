<!DOCTYPE html>  
<html lang="ru">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="../css/admin1.css" rel="stylesheet"> 
    <title>Главная страница</title>  
    <style>  
        body {  
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;  
            text-align: center;  
            margin-top: 50px;  
            background-color: #f0f0f0;  
            color: #333;
        }  
        .button {  
            padding: 15px 30px;  
            font-size: 18px;  
            color: white;  
            background-color: #007BFF;  
            border: none;  
            border-radius: 5px;  
            cursor: pointer;  
            text-decoration: none;
            margin: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }  
        .button:hover {  
            background-color: #0056b3;  
            transform: translateY(-2px);
        }  
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        form {
            display: inline-block;
        }
        h3 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
    </style>  
</head>  
<body>  
<?php
session_start();
include("tabs/Db.php");

// Подключение к базе данных
$connect = new mysqli("localhost", "root", "", "bdkurs");

// Проверка соединения
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Получаем данные пользователя из базы данных
$user_id = $_SESSION['user_id'];
$stmt = $connect->prepare("SELECT FamSotr, ImyaSotr FROM sotrudnik WHERE idSotr = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Закрываем подготовленный запрос и соединение с базой данных
$stmt->close();
$connect->close();
?>

<h3>Добро пожаловать, <?= htmlspecialchars($user['FamSotr']) . ' ' . htmlspecialchars($user['ImyaSotr']); ?>!</h3> 
<div class="button-container">
    <form action="tabs/Clients.php"><button type="submit" class="button"><i class="fas fa-users"></i> Клиенты</button></form>
    <form action="tabs/Sotrudnik.php"><button type="submit" class="button"><i class="fas fa-user-tie"></i> Сотрудник</button></form>
    <form action="tabs/TypeRab.php"><button type="submit" class="button"><i class="fas fa-tasks"></i> Наименование работ</button></form>
    <form action="tabs/TypeUsl.php"><button type="submit" class="button"><i class="fas fa-concierge-bell"></i> Наименование услуг</button></form>
    <form action="tabs/Zapch.php"><button type="submit" class="button"><i class="fas fa-cogs"></i> Запчасти</button></form>
    <form action="tabs/Mark.php"><button type="submit" class="button"><i class="fas fa-car"></i> Марки</button></form>
    <form action="tabs/Model.php"><button type="submit" class="button"><i class="fas fa-car-side"></i> Модели</button></form>
    <form action="tabs/Ts.php"><button type="submit" class="button"><i class="fas fa-truck"></i> ТС</button></form>
    <form action="tabs/Status.php"><button type="submit" class="button"><i class="fas fa-info-circle"></i> Статус</button></form>
    <form action="tabs/Zayavka.php"><button type="submit" class="button"><i class="fas fa-file-alt"></i> Заявка</button></form>
    <form action="tabs/Chek.php"><button type="submit" class="button"><i class="fas fa-receipt"></i> Чек</button></form>
    <form action="otchet.php"><button type="submit" class="button"><i class="fas fa-chart-line"></i> Отчет</button></form>
    <form action="help.php"><button type="submit" class="button"><i class="fas fa-question-circle"></i> Справка</button></form>
    <form action="logout.php" method="post"><button type="submit" class="button"><i class="fas fa-sign-out-alt"></i> Выйти</button></form>
</div>

</body>
</html>
