<?php
include("../../tabs/Db.php");

$idRab = $_GET['idRab'];
$query = "DELETE FROM typerab WHERE (idRab = '$idRab')";
if (mysqli_query($connect, $query)) {  
          
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/TypeRab.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  

?>