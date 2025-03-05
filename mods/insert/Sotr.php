<?php
include("Db.php");
if (!$connect){
    die('Ошибка подключения: '. mysqli_connect_error());
}

$idSotr = $_POST['idSotr'];
$FamSotr = $_POST['FamSotr'];
$ImyaSotr = $_POST['ImyaSotr'];
$OtchSotr = $_POST['OtchSotr'];
$KontSotr = $_POST['KontSotr'];
$idStat = $_POST['idStat'];
$Login = $_POST['Login'];
$password = $_POST['password'];

$stmt = $connect->prepare("INSERT INTO sotrudnik (idSotr, FamSotr, ImyaSotr, OtchSotr, KontSotr, idStat, Login, password) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssssss",$idSotr,$FamSotr,$ImyaSotr,$OtchSotr,$KontSotr,$idStat, $Login, $password);
if ($stmt->execute()) {
    header('Location: ../../tabs/sotrudnik.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>