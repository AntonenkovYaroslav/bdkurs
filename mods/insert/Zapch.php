<?php
include("Db.php");
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
$idZap = $_POST['idZap'];
$NaimenZap = $_POST['NaimenZap'];
$CenaZap = $_POST['CenaZap'];
$TypeUsl_idUsl = $_POST['TypeUsl_idUsl'];
$stmt = $connect->prepare("INSERT INTO Zapch (idZap, NaimenZap, CenaZap, TypeUsl_idUsl) VALUES (?,?,?,?)");
$stmt->bind_param("isii", $idZap, $NaimenZap, $CenaZap, $TypeUsl_idUsl);
if ($stmt->execute()) {
    header('Location: ../../tabs/Zapch.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>
