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
    <!-- модальное окно добавление -->
 <form action="../mods/insert/Chek.php" method="post">
    <input type="text" name="idChek" placeholder="idChek" class="textbox" required>
    <input type="text" name="Akt" placeholder="Акт" class="textbox" required>
    <input type="date" name="DateChek" required>
    <select class="select" name="Zayavka_idZ" required>
            <?php
            include("Db.php");
            $query = "SELECT * FROM zayavka";
            $res = mysqli_query($connect, $query);
            echo "<option selected value = '0'> выберите Заявку </option>";
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idZ = $row['idZ'];
                    $SelVal = $row['DateZ'];
                    echo "<option value='$idZ'>$SelVal </option>";
                }
            }
            ?>
    </select>
    <select class="select" name="Zapch_idZap" required>
            <?php
            include("Db.php");
            $query = "SELECT * FROM zapch";
            $res = mysqli_query($connect, $query);
            echo "<option selected value = '0'> выберите Запчасть </option>";
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idZap = $row['idZap'];
                    $SelVal = $row['NaimenZap'];
                    echo "<option value='$idZap'>$SelVal </option>";
                }
            }
            ?>
    </select>
    <button type="submit" class="btn btn-success" line-height="3">Добавить запись</button>
     <?php

    $targetFile = '../home.php';
    ?>

    <a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>
 </form>

    <?php  

// Настройки подключения к базе данных  
include("../tabs/Db.php");
$r = mysqli_query($connect, "SELECT idChek,Akt, DateChek, NaimenZap, NaimenUsl, CenaZap + CenaUsl as Cena, OpisProb FROM Chek
    join zapch on zapch.idZap = Zapch_idZap
    join typeusl on idUsl = TypeUsl_idUsl
    join zayavka on idZ = Zayavka_idZ;");
$myrow = mysqli_fetch_array($r);
echo "<h4>Справочник - Чек</h4>";
echo "<center>";
echo "<table class='table table-hover'>";

echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Акт</th>";
echo "<th>Дата чека </th>";
echo "<th>Запчасть</th>";
echo "<th>Услуга </th>";
echo "<th>Стоимость </th>";
echo "<th>Описание проблемы</th>";

echo "</tr>";
echo "</thead>";
do 
{
    echo "<tr>";
    echo "<form name='form'>";
    echo "<th><input size='1' class='form-control input-sm' name='' type='text' value='$myrow[idChek]' readonly='readonly'/></th>";
    echo "<th><input size='1' class='form-control input-sm' name='' type='text' value='$myrow[Akt]' readonly='readonly'/></th>";
    echo "<th><input size='8' class='form-control input-sm' name='' type='text' value='$myrow[DateChek]' readonly='readonly'/></th>";
    echo "<th><input size='20' class='form-control input-sm' name='' type='text' value='$myrow[NaimenZap]' readonly='readonly'/></th>";
    echo "<th><input size='25' class='form-control input-sm' name='' type='text' value='$myrow[NaimenUsl]' readonly='readonly'/></th>";
    echo "<th><input size='4' class='form-control input-sm' name='' type='text' value='$myrow[Cena]' readonly='readonly'/></th>";
    echo "<th><input size='25' class='form-control input-sm' name='' type='text' value='$myrow[OpisProb]' readonly='readonly'/></th>";
    echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td></form>";
    echo "</tr>";
}while ($myrow = mysqli_fetch_array($r));
echo "</table>";
?>

</body>
</html>
