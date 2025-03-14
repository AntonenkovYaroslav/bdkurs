<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin1.css" rel="stylesheet">
    <title>Чек</title>
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
        }
    </style>
</head>

<body>
    <div class="modal">
        <h3>Добавить чек</h3>
        <form action="../mods/insert/Chek.php" method="post">
            <input type="text" name="idChek" placeholder="idChek" class="form-control" required>
            <input type="text" name="Akt" placeholder="Акт" class="form-control" required>
            <input type="date" name="DateChek" class="form-control" required>
            <select class="form-control" name="Zayavka_idZ" required>
                <option value="">выберите Заявку</option>
                <?php
                include("Db.php");
                $query = "SELECT * FROM zayavka";
                $res = mysqli_query($connect, $query);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idZ = $row['idZ'];
                        $SelVal = $row['DateZ'];
                        echo "<option value='$idZ'>$SelVal</option>";
                    }
                }
                mysqli_close($connect);
                ?>
            </select>
            <select class="form-control" name="Zapch_idZap" required>
                <option value="">выберите Запчасть</option>
                <?php
                include("Db.php");
                $query = "SELECT * FROM zapch";
                $res = mysqli_query($connect, $query);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idZap = $row['idZap'];
                        $SelVal = $row['NaimenZap'];
                        echo "<option value='$idZap'>$SelVal</option>";
                    }
                }
                mysqli_close($connect);
                ?>
            </select>
            <button type="submit" class="btn btn-success">Добавить запись</button>
            <a href="../home.php" class="btn btn-dark">Назад</a>
        </form>
    </div>

    <?php
    include("../tabs/Db.php");
    $r = mysqli_query($connect, "SELECT idChek, Akt, DateChek, NaimenZap, NaimenUsl, CenaZap + CenaUsl as Cena, OpisProb FROM Chek
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
    echo "<th>Дата чека</th>";
    echo "<th>Запчасть</th>";
    echo "<th>Услуга</th>";
    echo "<th>Стоимость</th>";
    echo "<th>Описание проблемы</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    do {
        echo "<tr>";
        echo "<form class='form-table'>";
        echo "<td><input size='1' class='form-control' name='' type='text' value='$myrow[idChek]' readonly='readonly'/></td>";
        echo "<td><input size='1' class='form-control' name='' type='text' value='$myrow[Akt]' readonly='readonly'/></td>";
        echo "<td><input size='8' class='form-control' name='' type='text' value='$myrow[DateChek]' readonly='readonly'/></td>";
        echo "<td><input size='20' class='form-control' name='' type='text' value='$myrow[NaimenZap]' readonly='readonly'/></td>";
        echo "<td><input size='25' class='form-control' name='' type='text' value='$myrow[NaimenUsl]' readonly='readonly'/></td>";
        echo "<td><input size='4' class='form-control' name='' type='text' value='$myrow[Cena]' readonly='readonly'/></td>";
        echo "<td><input size='25' class='form-control' name='' type='text' value='$myrow[OpisProb]' readonly='readonly'/></td>";
        echo "</form>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</tbody>";
    echo "</table>";
    ?>
</body>

</html>
