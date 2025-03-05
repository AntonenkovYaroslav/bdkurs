<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Справочник - модели</title>
    <!-- Bootstrap CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
     <link href="../css/admin1.css" rel="stylesheet">
    <!-- <link href="//bdkurs/css/cb.css" rel = "stylesheet"> -->
</head>

<body>

    <!--Модальное окно добавления -->
    <h1> Добавить модель</h1>
    <form action='../mods/insert/Model.php' method='post'>
        <input type="text" name="idModel" placeholder="idModel" required>
        <input type="text" name="NaimenModel" placeholder="Модель" required>

        <select class="select" name="Mark_idMark" required>

            <?php
            include("Db.php");
            $query = "SELECT * FROM mark";
            $result = mysqli_query($connect, $query);
            echo "<option selected value  = '0'> выберите модель </option>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $idMark = $row['idMark'];
                    $nameO = $row['NaimenMark'];

                    echo "<option value='$idMark'>$nameO</option>";
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
        "SELECT idModel, NaimenModel, NaimenMark 
     FROM model   
     JOIN mark ON Mark_idMark = mark.idMark order by (idModel)"
    );
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Модели</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";

    echo "<thead>";
    echo "<tr>";
    echo "#";
    echo "Модель";
    echo "Марка (ВК)";
    echo "</tr>";
    echo "</thead>";
    do {
        echo "<tr><td>";
        echo "<form class='form-table' action='../mods/update/Model.php' method='post'>"; // Измените путь на нужный 
        echo "<input size='1' class='form-control input-sm' name='idModel' type='text' value='$myrow[idModel]' readonly='readonly'/>";
        echo "<input size='15' class='form-control input-sm' name='NaimenModel' type='text' value='$myrow[NaimenModel]' required/>";
        echo "<input size='5' class='form-control input-sm' name='Mark_idMark' type='text' value='$myrow[NaimenMark]' readonly='readonly'/>";
        echo "<input type='submit' class='btn btn-warning' href='../mods/insert/Model.php?idModel=$myrow[idModel]'value='Изменить'/></td></";
        echo "</form>";
        echo "<td></tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";
    ?>
</body>

</html>