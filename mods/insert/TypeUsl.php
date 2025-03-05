<?php
include("Db.php");
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
$idUsl = $_POST['idUsl'];
$NaimenUsl = $_POST['NaimenUsl'];
$CenaUsl = $_POST['CenaUsl'];
$TypeRab_idRab = $_POST['TypeRab_idRab'];
$stmt = $connect->prepare("INSERT INTO TypeUsl(idUsl,NaimenUsl,CenaUsl,TypeRab_idRab) VALUES (?,?,?,?)");
$stmt->bind_param("isii",$idUsl,$NaimenUsl,$CenaUsl,$TypeRab_idRab);
if ($stmt->execute()) {
    header('Location: ../../tabs/TypeUsl.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>