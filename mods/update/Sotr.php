<?php
include("../../tabs/Db.php"); // Подключаем базу данных  
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $idSotr = $_POST['idSotr'];  
    $FamSotr = $_POST['FamSotr'];
    $ImyaSotr = $_POST['ImyaSotr'];
    $OtchSotr = $_POST['OtchSotr'];
    $kontSotr = $_POST['kontSotr'];
    $Login = $_POST['Login'];
    $password = $_POST['password'];

    // Запрос на обновление данных  
    $query = "UPDATE sotrudnik SET FamSotr = '$FamSotr', ImyaSotr = '$ImyaSotr', OtchSotr = '$OtchSotr', kontSotr = '$kontSotr', Login = '$Login', password = '$password' WHERE idSotr = '$idSotr';";  

    if (mysqli_query($connect, $query)) {  
        // Перенаправляем обратно на страницу  
        header('Location: ../../tabs/sotrudnik.php'); // Указать правильный путь 
        echo "<script>alert('Запись обновлена успешно')</script>";
        exit; 
    } else {  
        echo "Ошибка: " . mysqli_error($connect);  
    }  
}
?>