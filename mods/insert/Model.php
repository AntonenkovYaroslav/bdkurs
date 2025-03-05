<?php
include("Db.php");
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

$idModel = $_POST['idModel'];
$NaimenModel = $_POST['NaimenModel'];
$Mark_idMark = $_POST['Mark_idMark'];

$stmt = $connect->prepare("INSERT INTO model (idModel, NaimenModel,Mark_idMark) VALUES (?,?,?)");
$stmt->bind_param("iss", $idModel, $NaimenModel, $Mark_idMark);
if ($stmt->execute()) {
    header('Location: ../../tabs/Model.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
