<?php
include("../../tabs/Db.php"); // Подключаем базу данных
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsl = $_POST['idUsl'];
    $NaimenUsl = $_POST['NaimenUsl'];
    $CenaUsl = $_POST['CenaUsl'];

    // Убедитесь, что $idUsl это целое число 
    if (!is_numeric($idUsl)) {
        die('Некорректный idUsl');
    }

    // Запрос на обновление данных 
    $query = "UPDATE typeusl SET NaimenUsl = '$NaimenUsl', CenaUsl = '$CenaUsl' WHERE idUsl = '$idUsl'";
    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Запись обновлена успешно');</script>";
        header('Location: ../../tabs/TypeUsl.php');
        exit;
    } else {
        echo "Ошибка: " . mysqli_error($connect);
    }
}
