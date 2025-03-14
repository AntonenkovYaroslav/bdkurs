<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin1.css" rel="stylesheet">
    <title>Запчасти</title>
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
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-dark {
            background-color: #343a40;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="modal">
        <h3>Добавить запчасть</h3>
        <form action='../mods/insert/Zapch.php' method='post'>
            <input type="text" name="idZap" placeholder="idZap" class="form-control" required>
            <input type="text" name="NaimenZap" placeholder="Наименование запчасти" class="form-control" required>
            <input type="text" name="CenaZap" placeholder="Цена" class="form-control" required>
            <select class="form-control" name="TypeUsl_idUsl" required>
                <option value="">Выберите услугу</option>
                <?php
                include("Db.php");
                $query = "SELECT * FROM TypeUsl";
                $res = mysqli_query($connect, $query);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idUsl = $row['idUsl'];
                        $SelVal = $row['NaimenUsl'];
                        echo "<option value='$idUsl'>$SelVal</option>";
                    }
                }
                mysqli_close($connect);
                ?>
            </select>
            <button type="submit" class="btn btn-success">Добавить новую запись</button>
            <a href="../home.php" class="btn btn-dark">Назад</a>
        </form>
    </div>

    <?php
    include("../tabs/Db.php");
    $r = mysqli_query(
        $connect,
        "SELECT idZap, NaimenZap, CenaZap, NaimenUsl FROM Zapch JOIN typeusl ON zapch.TypeUsl_idUsl = typeusl.idUsl"
    );
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Запчасти</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Запчасти</th>";
    echo "<th>Цена</th>";
    echo "<th>Услуга</th>";
    echo "<th>Действие</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    do {
        echo "<tr>";
        echo "<form class='form-table' action='../mods/update/Zapch.php' method='post'>";
        echo "<td><input size='1' class='form-control' name='idZap' type='text' value='$myrow[idZap]' readonly='readonly'/></td>";
        echo "<td><input size='15' class='form-control' name='NaimenZap' type='text' value='$myrow[NaimenZap]' required/></td>";
        echo "<td><input size='5' class='form-control' name='CenaZap' type='text' value='$myrow[CenaZap]' required/></td>";
        echo "<td><input size='35' class='form-control' name='' type='text' value='$myrow[NaimenUsl]' readonly='readonly'/></td>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td>";
        echo "</form>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</tbody>";
    echo "</table>";
    ?>
</body>

</html>