<?php
include("../../tabs/Db.php"); // Подключаем базу данных  
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $idClient = $_POST['idClient'];  
    $FamCl = $_POST['FamCl'];
    $ImyaCl = $_POST['ImyaCl'];
    $OtchCl = $_POST['OtchCl'];
    $AdrCl = $_POST['AdrCl'];
    $KontCl = $_POST['KontCl'];  

    // Запрос на обновление данных  
    $query = "UPDATE client SET FamCl = '$FamCl', ImyaCl = '$ImyaCl', OtchCl = '$OtchCl', AdrCl = '$AdrCl', KontCl = '$KontCl' WHERE idClient = '$idClient'";  

    if (mysqli_query($connect, $query)) {  
          
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/Clients.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  
}
?>