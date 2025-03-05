<?php
include("../../tabs/Db.php");

$idMark = $_GET['idMark'];
$query = "DELETE FROM mark WHERE (idMark = '$idMark')";
if (mysqli_query($connect, $query)) {  
          
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/Mark.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  

?>
