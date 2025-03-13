<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin1.css" rel="stylesheet">
    <title>Тип работ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #f0f0f0;
            color: #333;
        }

        .button {
            padding: 15px 30px;
            font-size: 18px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        form {
            display: inline-block;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            color: #333;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

        tr:hover {
            background-color: #e9e9e9;
        }

        .form-control {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
        }

        .btn {
            padding-top: 6px;
            padding-bottom: 6px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 3px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            padding: 10px 10px;
        }

        .btn-dark {
            background-color: #343a40;
            color: white;
            padding: 10px 10px;

        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
            width: 100%;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            width: 170px;
            text-align: center;
            padding: 5px 25px 5px 25px;
        }
    </style>
</head>

<body>
    <h3>Добавить тип работы</h3>
    <form action="../mods/insert/TypeRab.php" method="post">
        <input type="text" name="idRab" placeholder="idRab" class="form-control" required>
        <input type="text" name="NaimenRab" placeholder="Наименование работ" class="form-control" required>
        <button type="submit" class="btn btn-success">Добавить новую запись</button>
        <a href="../home.php" class="btn btn-dark">Назад</a>
    </form>

    <?php
    include("Db.php");
    $r = mysqli_query($connect, "SELECT * FROM typerab");
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Тип работ</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Наименование работ</th>";
    echo "<th>Действие</th>";
    echo "<th> Удаление </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    do {
        echo "<tr>";
        echo "<form class='form-table' action='../mods/update/TypeRab.php' method='post'>";
        echo "<td><input size='1' class='form-control' name='idRab' type='text' value='$myrow[idRab]' readonly='readonly'/></td>";
        echo "<td><input size='35' class='form-control' name='NaimenRab' type='text' value='$myrow[NaimenRab]' required/></td>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td>";
        echo "</form>";
        echo "<td><a class='btn btn-danger' href='../mods/delete/TypeRab.php?idRab=$myrow[idRab]'>Удалить</a></td>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</tbody>";
    echo "</table>";
    ?>
</body>

</html>