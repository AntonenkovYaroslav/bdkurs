<?php
include("../../tabs/Db.php"); // Подключаем базу данных  
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $idRab = $_POST['idRab'];  
    $NaimenRab = $_POST['NaimenRab'];

    // Запрос на обновление данных  
    $query = "UPDATE typerab SET NaimenRab = '$NaimenRab' WHERE idRab = '$idRab'";  

    if (mysqli_query($connect, $query)) {  
       // echo "Ошибка: " . mysqli_error($connect);
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/TypeRab.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
          echo "Ошибка: " . mysqli_error($connect);
    }  
}
?>