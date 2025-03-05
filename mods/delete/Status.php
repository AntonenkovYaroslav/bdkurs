<?php
include("../../tabs/Db.php");

$idStat = $_GET['idStat'];
$query = "DELETE FROM status WHERE (idStat = '$idStat')";
if (mysqli_query($connect, $query)) {  
          
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/Status.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  

?>