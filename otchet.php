<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Отчет</title>
    <!-- Bootstrap CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="//kzhd.ru/css/admin.css" rel="stylesheet">
    <link href="../css/admin1.css" rel="stylesheet">
    <style>
        @media print {
            body {
                visibility: hidden;
            }

            .print {
                visibility: visible;
            }
        }
        .export-buttons {
            margin: 20px 0;
        }
    </style>
</head>

<body>
<?php
$targetFile = '../home.php';
?>

<a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>

<div class="export-buttons">
    <button type='button' class='btn btn-success' onclick='javascript:window.print()'>Экспорт в PDF (Печать)</button>
    <a href="export_csv.php" class="btn btn-primary">Экспорт в Excel</a>
</div>

<?php
    echo "<h4>Отчет за весь период</h4>";
    echo "<center>";
    echo "<table class='table print table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Акт</th>";
    echo "<th>Дата акта</th>";
    echo "<th>Модель</th>";
    echo "<th>Марка</th>";
    echo "<th>Запчасти</th>";
    echo "<th>Стоимость запчастей</th>";
    echo "<th>Услуги</th>";
    echo "<th>Стоимость услуг</th>";
    echo "<th>Стоимость ремонта</th>";
    echo "</tr>";
    echo "</thead>";

    include("tabs/Db.php");
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //Запрос в БД для вывода отчета
    $r = mysqli_query($connect, "SELECT chek.Akt as Akt, zayavka.DateZ AS DateZ, model.NaimenModel AS ModelName, mark.NaimenMark AS MarkName, 
    GROUP_CONCAT(DISTINCT zapch.NaimenZap) AS UsedParts, SUM(zapch.CenaZap) AS TotalPartsCost, 
    GROUP_CONCAT(DISTINCT typeusl.NaimenUsl) AS UsedServices, SUM(typeusl.CenaUsl) AS TotalServicesCost, SUM(zapch.CenaZap) + SUM(typeusl.CenaUsl) AS TotalRemSum 
    FROM bdkurs.chek AS chek 
    JOIN bdkurs.zayavka AS zayavka ON chek.Zayavka_idZ = zayavka.idZ 
    JOIN bdkurs.zapch AS zapch ON chek.Zapch_idZap = zapch.idZap 
    JOIN bdkurs.typeusl AS typeusl ON zapch.TypeUsl_idUsl = typeusl.idUsl 
    JOIN bdkurs.ts AS ts ON zayavka.Ts_idTs = ts.idTs 
    JOIN bdkurs.model AS model ON ts.Model_idModel = model.idModel 
    JOIN bdkurs.mark AS mark ON model.Mark_idMark = mark.idMark 
    GROUP BY Akt,zayavka.idZ, zayavka.DateZ, model.NaimenModel, mark.NaimenMark 
    ORDER BY  Akt, zayavka.DateZ;");
    //Запрос в БД для вывода общей суммы
    $c = mysqli_query($connect, "SELECT SUM(TotalRemSum) AS Itog FROM 
    ( SELECT chek.Akt as Akt, zayavka.DateZ AS DateZ, model.NaimenModel AS ModelName, 
    mark.NaimenMark AS MarkName, 
    GROUP_CONCAT(DISTINCT zapch.NaimenZap) AS UsedParts, 
    SUM(zapch.CenaZap) AS TotalPartsCost, 
    GROUP_CONCAT(DISTINCT typeusl.NaimenUsl) AS UsedServices, 
    SUM(typeusl.CenaUsl) AS TotalServicesCost, 
    SUM(zapch.CenaZap) + SUM(typeusl.CenaUsl) AS TotalRemSum 
    FROM bdkurs.chek AS chek 
    JOIN bdkurs.zayavka AS zayavka ON chek.Zayavka_idZ = zayavka.idZ 
    JOIN bdkurs.zapch AS zapch ON chek.Zapch_idZap = zapch.idZap 
    JOIN bdkurs.typeusl AS typeusl ON zapch.TypeUsl_idUsl = typeusl.idUsl 
    JOIN bdkurs.ts AS ts ON zayavka.Ts_idTs = ts.idTs 
    JOIN bdkurs.model AS model ON ts.Model_idModel = model.idModel 
    JOIN bdkurs.mark AS mark ON model.Mark_idMark = mark.idMark 
    GROUP BY Akt,zayavka.idZ, zayavka.DateZ, model.NaimenModel, mark.NaimenMark ) 
    AS Subquery;");

    $myrow = mysqli_fetch_array($r);
    $mycow = mysqli_fetch_array($c);

    do {
        echo "<tr>";
        echo "<th>$myrow[Akt]</th>";
        echo "<th>$myrow[DateZ]</th>";
        echo "<th>$myrow[ModelName]</th>";
        echo "<th>$myrow[MarkName]</th>";
        echo "<th>$myrow[UsedParts]</th>";
        echo "<th>$myrow[TotalPartsCost]</th>";
        echo "<th>$myrow[UsedServices]</th>";
        echo "<th>$myrow[TotalServicesCost]</th>";
        echo "<th>$myrow[TotalRemSum]</th>";

        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "<tr>";
    echo "<th colspan='8'></th>";
    echo "<th>Общая сумма: $mycow[Itog]</th>";
    echo "</tr>";
    echo "</table>";
    
    
    
    ?>

   
</body>

</html>