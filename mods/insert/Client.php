<?php 
include("Db.php"); 

if (!$connect) {
    die("Ошибка подключения: " . mysqli_connect_error());
}//Повторная проверка 

$idClient = $_POST['idClient'];   
$FamCl = $_POST['FamCl'];   
$ImyaCl = $_POST['ImyaCl'];   
$OtchCl = $_POST['OtchCl'];   
$AdrCl = $_POST['AdrCl'];   
$KontCl = $_POST['KontCl']; 

$stmt = $connect->prepare("INSERT INTO client (idClient, FamCl, ImyaCl, OtchCl, AdrCl, KontCl) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $idClient, $FamCl, $ImyaCl, $OtchCl, $AdrCl, $KontCl);

if ($stmt->execute()) {
    header('Location: ../../tabs/Clients.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>
