<?php
include("../../tabs/Db.php"); // Подключаем базу данных
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idZap = $_POST['idZap'];
    $NaimenZap = $_POST['NaimenZap'];
    $CenaZap = $_POST['CenaZap'];

    // Убедитесь, что $idZap это целое число 
    if (!is_numeric($idZap)) {
        die('Некорректный idZap');
    }

    // Запрос на обновление данных 
    $query = "UPDATE zapch SET NaimenZap = '$NaimenZap', CenaZap = '$CenaZap' WHERE idZap = '$idZap'";
    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Запись обновлена успешно');</script>";
        header('Location: ../../tabs/Zapch.php');
        exit;
    } else {
        echo "Ошибка: " . mysqli_error($connect);
    }
}
