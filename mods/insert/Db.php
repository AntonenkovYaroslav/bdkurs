<?php
$host = 'localhost'; // или ваш хост
$user = 'root'; // ваше имя пользователя
$password = ''; // ваш пароль
$dbname = 'bdkurs'; // имя вашей базы данных

$connect = mysqli_connect($host, $user, $password, $dbname);

if (!$connect) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>
