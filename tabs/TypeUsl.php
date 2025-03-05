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

<body>
<!-- Модальное окно добавление-->
    <form action="../mods/insert/TypeUsl.php" method="post">
        <input type="text" name="idUsl" placeholder="idUsl" required>
        <input type="text" name="NaimenUsl" placeholder="Наименование услуги">
        <input type="text" name="CenaUsl" placeholder="Цена услуги">
        <select class="select" name="TypeRab_idRab" required>
            <?php
            include("Db.php");
            $query = "SELECT * FROM TypeRab";
            $res = mysqli_query($connect, $query);
            echo "<option selected value = '0'> выберите тип </option>";
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idRab = $row['idRab'];
                    $SelVal = $row['NaimenRab'];
                    echo "<option value='$idRab'>$SelVal </option>";
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
        "SELECT idUsl, NaimenUsl, CenaUsl, NaimenRab   
     FROM typeusl   
     JOIN typerab ON typeusl.TypeRab_idRab = typerab.idRab"
    );
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Тип работ</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";

    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Наименование услуги </th>";
    echo "<th>Цена </th>";
    echo "<th>FK TypeRab</th>";
    echo "</tr>";
    echo "</thead>";
    do {
        echo "<tr>";
        echo "<form action='../mods/update/TypeUsl.php' method='post'>"; // Измените путь на нужный 
        echo "<th><input size='1' class='form-control input-sm' name='idUsl' type='text' value='$myrow[idUsl]' readonly='readonly'/></th>";
        echo "<th><input size='25' class='form-control input-sm' name='NaimenUsl' type='text' value='$myrow[NaimenUsl]'required'/></th>";
        echo "<th><input size='6' class='form-control input-sm' name='CenaUsl' type='text' value='$myrow[CenaUsl]' required/></th>";
        echo "<th><input size='25' class='form-control input-sm' name='TypeRab_idRab' type='text' value='$myrow[NaimenRab]' readonly='readonly'/></th>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td></form>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";
    ?>
    
</body>

</html>