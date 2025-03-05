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

<body><!-- Модальное окно добавление -->
    <h3>Добавить ТС</h3>
    <form action="..\mods\insert\Ts.php" method='post'>
        <input type="text" name="idTs" placeholder="idTS" required>
        <input type="text" name="GosNum" placeholder="ГосНомер" required>
        <select class="select" name="Model_idModel" required>

            <?php
            include("Db.php");
            $query = "SELECT * FROM model";
            $result = mysqli_query($connect, $query);
            echo "<option selected value  = '0'> выберите модель </option>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $idModel = $row['idModel'];
                    $nameO = $row['NaimenModel'];
                    echo "<option value='$idModel'>$nameO</option>";
                }
            }
            ?>


        </select>
        <button type="submit" class="btn btn-success" line-height="3">Добавить новую запись</button>
        <?php $targetFile = '../home.php';  ?>
        <a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>
    </form>
    

    <?php
    // Настройки подключения к базе данных  
    include("Db.php");
    $r = mysqli_query(
        $connect,
        "SELECT idTs, GosNum, NaimenModel
     FROM Ts   
     JOIN model ON Model_idModel = model.idModel"
    );
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - ТС</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>ГосНомер</th>";
    echo "<th>Модель (ВК)</th>";
    echo "</tr>";
    echo "</thead>";
    do {
        echo "<tr>";
        echo "<form action='../mods/update/Ts.php' method='post'>"; // Измените путь на нужный 
        echo "<th><input size='1' class='form-control input-sm' name='idTs' type='text' value='$myrow[idTs]' readonly='readonly'/></th>";
        echo "<th><input size='15' class='form-control input-sm' name='GosNum' type='text' value='$myrow[GosNum]' required/></th>";
        echo "<th><input size='5' class='form-control input-sm' name='Model_idModel' type='text' value='$myrow[NaimenModel]' readonly='readonly'/></th>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td></form>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";
    ?>

</body>

</html>