<?php
include("Db.php");
$idStat = $_POST['idStat'];
$NaimenStat = $_POST['NaimenStat'];
$stmt = $connect->prepare("INSERT INTO status (idStat,NaimenStat) VALUES (?,?)");
$stmt->bind_param("is",$idStat, $NaimenStat);
if ($stmt->execute()) {
    header('Location: ../../tabs/Status.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>