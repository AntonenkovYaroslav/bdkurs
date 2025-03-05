<?php
include("Db.php");
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
$idChek = $_POST['idChek'];
$Akt = $_POST['Akt'];
$DateChek= $_POST['DateChek'];
$Zapch_idZap = $_POST['Zapch_idZap'];
$Zayavka_idZ = $_POST['Zayavka_idZ'];

$stmt = $connect->prepare("INSERT INTO chek (idChek, Akt,DateChek, Zapch_idZap, Zayavka_idZ) VALUES (?,?,?,?,?)");
$stmt->bind_param('issii', $idChek,$Akt,$DateChek, $Zapch_idZap, $Zayavka_idZ);
if ($stmt->execute()) {
    header('Location: ../../tabs/Chek.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}
$stmt->close();
$connect->close();
?>