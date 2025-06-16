<?php
include("tabs/Db.php");

// Устанавливаем заголовки для скачивания CSV файла
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="report.csv"');

// Создаем файловый указатель для вывода
$output = fopen('php://output', 'w');

// Добавляем BOM для корректного отображения кириллицы в Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Заголовки столбцов
$headers = array('Акт', 'Дата акта', 'Модель', 'Марка', 'Запчасти', 'Стоимость запчастей', 'Услуги', 'Стоимость услуг', 'Стоимость ремонта');
fputcsv($output, $headers, ';');

// Запрос к базе данных
$query = "SELECT chek.Akt as Akt, zayavka.DateZ AS DateZ, model.NaimenModel AS ModelName, mark.NaimenMark AS MarkName, 
    GROUP_CONCAT(DISTINCT zapch.NaimenZap) AS UsedParts, SUM(zapch.CenaZap) AS TotalPartsCost, 
    GROUP_CONCAT(DISTINCT typeusl.NaimenUsl) AS UsedServices, SUM(typeusl.CenaUsl) AS TotalServicesCost, 
    SUM(zapch.CenaZap) + SUM(typeusl.CenaUsl) AS TotalRemSum 
    FROM bdkurs.chek AS chek 
    JOIN bdkurs.zayavka AS zayavka ON chek.Zayavka_idZ = zayavka.idZ 
    JOIN bdkurs.zapch AS zapch ON chek.Zapch_idZap = zapch.idZap 
    JOIN bdkurs.typeusl AS typeusl ON zapch.TypeUsl_idUsl = typeusl.idUsl 
    JOIN bdkurs.ts AS ts ON zayavka.Ts_idTs = ts.idTs 
    JOIN bdkurs.model AS model ON ts.Model_idModel = model.idModel 
    JOIN bdkurs.mark AS mark ON model.Mark_idMark = mark.idMark 
    GROUP BY Akt,zayavka.idZ, zayavka.DateZ, model.NaimenModel, mark.NaimenMark 
    ORDER BY Akt, zayavka.DateZ";

$result = mysqli_query($connect, $query);

// Записываем данные
while ($row = mysqli_fetch_array($result)) {
    $data = array(
        $row['Akt'],
        $row['DateZ'],
        $row['ModelName'],
        $row['MarkName'],
        $row['UsedParts'],
        $row['TotalPartsCost'],
        $row['UsedServices'],
        $row['TotalServicesCost'],
        $row['TotalRemSum']
    );
    fputcsv($output, $data, ';');
}

// Закрываем файловый указатель
fclose($output);
?> 