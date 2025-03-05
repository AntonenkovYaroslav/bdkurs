<?php
include("../../tabs/Db.php"); // Подключаем базу данных  
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $idStat = $_POST['idStat'];  
    $NaimenStat = $_POST['NaimenStat'];

    // Запрос на обновление данных  
    $query = "UPDATE status SET NaimenStat = '$NaimenStat' WHERE idStat= '$idStat'";  

    if (mysqli_query($connect, $query)) {  
          
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/Status.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  
}
?>