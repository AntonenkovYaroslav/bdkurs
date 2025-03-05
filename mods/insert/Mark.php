<?php
include("Db.php");
if (!$connect){
    die('Ошибка подключения: '. mysqli_connect_error());
}
$idMark = $_POST['idMark'];
$NaimenMark = $_POST['NaimenMark'];

$stmt = $connect->prepare("INSERT INTO mark (idMark, NaimenMark) VALUES (?,?)");
$stmt->bind_param("is",$idMark,$NaimenMark);
if ($stmt->execute()) {
    header('Location: ../../tabs/Mark.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>