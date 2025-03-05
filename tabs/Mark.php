<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Справочник - Марки</title>
    <!-- Bootstrap CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
     <link href="../css/admin1.css" rel="stylesheet">
</head>

<body>
    <!--Модальное окно добавление -->
    <h3> Добавить марку </h3>
    <form action='../mods/insert/Mark.php' method='post'>
        <input type="text" name="idMark" placeholder="id" required>
        <input type="text" name="NaimenMark" placeholder="Марка" required>
        <button type="submit" class="btn btn-success" line-height="3">Добавить новую запись</button>
        <?php    $targetFile = '../home.php';    ?>
        <a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>
    </form>
    
    <?php
    // Настройки подключения к базе данных  
    include("../tabs/Db.php");
    $r = mysqli_query($connect, "Select * From mark");
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Марки</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";

    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Марка </th>";
    echo "</tr>";
    echo "</thead>";
    do {
        echo "<tr>";
        echo "<form action='../mods/update/Mark.php' method='post'>"; // Добавили action для обновления  
        echo "<th><input size='1' class='form-control input-sm' name='idMark' type='text' value='$myrow[idMark]' readonly='readonly'/></th>"; // idMark  
        echo "<th><input size='15' class='form-control input-sm' name='NaimenMark' type='text' value='$myrow[NaimenMark]' required/></th>"; // переименуйте форму  
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td></form>";
        echo "<td><a class='btn btn-danger' href='../mods/delete/Mark.php?idMark=$myrow[idMark]'>Удалить</a></td>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";
    ?>

</body>

</html>