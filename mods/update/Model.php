<?php
include("../../tabs/Db.php"); // Подключаем базу данных  
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $idModel = $_POST['idModel'];  
    $NaimenModel = $_POST['NaimenModel'];

    // Запрос на обновление данных  
    $query = "UPDATE model SET NaimenModel = '$NaimenModel' WHERE idModel = '$idModel'";  

    if (mysqli_query($connect, $query)) {  
          
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/Model.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  
}
?>