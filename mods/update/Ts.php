<?php
include("../../tabs/Db.php"); // Подключаем базу данных  
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $idTs = $_POST['idTs'];  
    $GosNum = $_POST['GosNum'];

    // Запрос на обновление данных  
    $query = "UPDATE Ts SET GosNum = '$GosNum' WHERE idTs = '$idTs'";  

    if (mysqli_query($connect, $query)) {  
          
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/Ts.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  
}
?>