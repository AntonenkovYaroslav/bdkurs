<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../css/admin1.css" rel="stylesheet">
</head>

<body><!-- Модальное окно добавление-->
    <form action='../mods/insert/Zapch.php' method='post'>
        <input type="text" name="idZap" placeholder="idZap" required>
        <input type="text" name="NaimenZap" placeholder="Наименование запчасти" required>
        <input type="text" name="CenaZap" placeholder="Цена" required>
        <select class="select" name="TypeUsl_idUsl" required>
            <?php
            include("Db.php");
            $query = "SELECT * FROM TypeUsl";
            $res = mysqli_query($connect, $query);
            echo "<option value='0'> Выберите услугу</option> ";
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idUsl = $row['idUsl'];
                    $SelVal = $row['NaimenUsl'];
                    echo "<option value='$idUsl'>$SelVal</option>";
                }
            }
            ?>
        </select>
        <button type="submit" class="btn btn-success" line-height="3">Добавить новую запись</button>
        <?php    $targetFile = '../home.php';    ?>
        <a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>
    </form>
    
    <?php

    // Настройки подключения к базе данных  
    include("../tabs/Db.php");
    $r = mysqli_query(
        $connect,
        "SELECT idZap, NaimenZap, CenaZap, NaimenUsl   
     FROM Zapch   
     JOIN typeusl ON zapch.TypeUsl_idUsl = typeusl.idUsl"
    );
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Запчасти</h4>";
    echo "<center>";
    echo "<table class ='table table-hover'>";

     echo "<thead>";
     echo "<tr>";
     echo "#";
     echo "Запчасти";
     echo "Цена";
     echo "Fk_Usl";
     echo "</tr>";
     echo "</thead>";
    do {
        echo "<tr><td>";
        echo "<form class='form-table' action='../mods/update/Zapch.php' method='post' >"; 
        echo "<input size='1' class='form-control input-sm' name='idZap' type='text' value='$myrow[idZap]' readonly='readonly'/>";
        echo "<input size='15'class='form-control input-sm' name='NaimenZap' type='text' value='$myrow[NaimenZap]' required/>";
        echo "<input size='5' class='form-control input-sm' name='CenaZap' type='text' value='$myrow[CenaZap]' required/>";
        echo "<input size='35'class='form-control input-sm' name='' type='text' value='$myrow[NaimenUsl]' readonly='readonly'/>";
        echo "<input type='submit' class='btn btn-warning' value='Изменить'/></form>";
        echo "</td></tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";
    ?>
    
</body>

</html>