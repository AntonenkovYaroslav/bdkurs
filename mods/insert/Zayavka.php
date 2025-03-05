<?php
include("Db.php");
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

$idZ = $_POST['idZ'];
$DateZ = $_POST['DateZ'];
$OpisProb = $_POST['OpisProb'];
$Ts_idTs = $_POST['Ts_idTs'];
$Client_idClient = $_POST['Client_idClient'];
$Sotrudnik_idSotrudnik = $_POST['Sotrudnik_idSotrudnik'];
$idCl = $_POST['idCl'];

$stmt = $connect->prepare("INSERT INTO zayavka (idZ, DateZ, OpisProb, Ts_idTs, Client_idClient, Sotrudnik_idSotrudnik) VALUES (?, ?, ?, ?, ?, ?)  ");
$stmt->bind_param('issiii', $idZ, $DateZ, $OpisProb, $Ts_idTs, $Client_idClient, $Sotrudnik_idSotrudnik);
if ($stmt->execute()) {
    
    header('Location: ../../tabs/Zayavka.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}
$stmt->close();
$connect->close();
?>