<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
     <link href="../css/admin1.css" rel="stylesheet">
</head>

<body><!-- Модальное окно добавление  -->
    <form action="../mods/insert/TypeRab.php" method='post'>
        <input type="text" name="idRab" placeholder="idRab" required>
        <input type="text" name="NaimenRab" placeholder="Наименование работ" required>
        <button type="submit" class="btn btn-success" line-height="3">Добавить новую запись</button>
        <?php $targetFile = '../home.php';?>
        <a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>
    </form>
    
    <?php     // Настройки подключения к базе данных  
    include("Db.php");
    $r = mysqli_query($connect, "Select * From typerab");
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Тип работ</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";

    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Наименование работ </th>";
    echo "</tr>";
    echo "</thead>";
    do {
        echo "<tr>";
        echo "<form action='../mods/update/TypeRab.php' method='post'>"; // Измените путь на нужный 
        echo "<th><input size='1' class='form-control input-sm' name='idRab' type='text' value='$myrow[idRab]' readonly='readonly'/></th>";
        echo "<th><input size='35' class='form-control input-sm' name='NaimenRab' type='text' value='$myrow[NaimenRab]' required/></th>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td></form>";
        echo "<td><a class='btn btn-danger' href='../mods/delete/TypeRab.php?idRab=$myrow[idRab]'>Удалить</a></td>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";
    ?>

</body>

</html>