<?php
include("Db.php");
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

$idTs = $_POST['idTs'];
$GosNum = $_POST['GosNum'];
$Model_idModel = $_POST['Model_idModel'];

$stmt = $connect->prepare("INSERT INTO Ts (idTs, GosNum, Model_idModel) VALUES (?,?,?)");
$stmt->bind_param("iss", $idTs, $GosNum, $Model_idModel);
if ($stmt->execute()) {
    header('Location: ../../tabs/Ts.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>