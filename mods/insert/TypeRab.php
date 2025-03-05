<?php
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
include("Db.php");
if (!$connect) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
$idRab = $_POST["idRab"];
$NaimenRab = $_POST["NaimenRab"];

$stmt = $connect->prepare("INSERT INTO typerab (idRab, NaimenRab) VALUES (?,?)");
$stmt->bind_param("is", $idRab,$NaimenRab);

if ($stmt->execute()) {
    header('Location: ../../tabs/TypeRab.php'); // Указать правильный путь 
    echo "<script>alert('Запись обновлена успешно')</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
mysqli_close($connect);
?>