<?php
session_start();
include("tabs/Db.php");

// Подключение к базе данных
$connect = new mysqli("localhost", "root", "", "bdkurs");

// Проверка соединения
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Запрос для проверки логина и пароля
    $stmt = $connect->prepare("SELECT * FROM sotrudnik WHERE Login = ? AND password = ?");
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Храним ID пользователя в сессии
        $_SESSION['user_id'] = $user['idSotr'];

        // Перенаправление на главную страницу
        header('Location: home.php');
        exit();
    } else {
        $error = "Неверный логин или пароль.";
    }

    // Закрываем подготовленный запрос
    $stmt->close();
}

// Закрываем соединение с базой данных
if (isset($connect)) {
    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Roboto', sans-serif;
            color: #768088FF;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
            transition: all 0.3s ease;
            opacity: 0;
            transform: scale(0.5);
        }
        .container.show {
            opacity: 1;
            transform: scale(1);
        }
        h2 {
            color: #5900FFFF;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .error {
            color: #cc0000;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #090BA2FF;
            box-shadow: 0 0 5px rgba(153, 0, 0, 0.5);
        }
        button[type="submit"] {
            background-color: #10446EFF;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #145081FF;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container" id="auth-container">
        <h2>Авторизация</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
    </div>
    <script>
        window.onload = function() {
            document.getElementById('auth-container').classList.add('show');
        };
    </script>
</body>
</html>