<?php  
include("../../tabs/Db.php"); // Подключаем базу данных  
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $idMark = $_POST['idMark'];  
    $NaimenMark = $_POST['NaimenMark'];  

    // Запрос на обновление данных  
    $query = "UPDATE mark SET NaimenMark = '$NaimenMark' WHERE idMark = '$idMark'";  
    
    if (mysqli_query($connect, $query)) {  
        echo "Запись обновлена успешно";  
    // Перенаправляем обратно на страницу  
    header('Location: ../../tabs/Mark.php'); // Указать правильный путь  
    exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  

      
}  
?>  