<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin1.css" rel="stylesheet">
    <title>Заявка</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #f0f0f0;
            color: #333;
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
            text-align: center;
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
            box-sizing: border-box;
        }

        .btn {
            padding: 6px 12px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
            width: 100%;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            width: 100%;
            text-align: center;
        }

        td form, td a {
            display: block;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
        }

        .modal {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal h3 {
            margin-bottom: 20px;
        }

        .modal form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-dark {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>

<body>
    <div class="modal">
        <h3>Добавить Заявку</h3>
        <form action="../mods/insert/Zayavka.php" method="post">
            <input type="text" name="idZ" placeholder="idZ" class="form-control" required>
            <input type="date" name="DateZ" class="form-control" required>
            <input type="text" name="OpisProb" placeholder="Описание проблемы" class="form-control" required>
            <select class="form-control" name="Ts_idTs" required>
                <option value="">Выберите Госномер ТС</option>
                <?php
                include("Db.php");
                $query = "SELECT * FROM Ts";
                $res = mysqli_query($connect, $query);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idTs = $row['idTs'];
                        $GosNum = $row['GosNum'];
                        echo "<option value ='$idTs'>$GosNum</option> ";
                    }
                }
                mysqli_close($connect);
                ?>
            </select>
            <select class="form-control" name="Client_idClient" required>
                <option value="">Выберите Клиента</option>
                <?php
                include("Db.php");
                $query = "SELECT * FROM Client";
                $res = mysqli_query($connect, $query);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idClient = $row['idClient'];
                        $FamCl = $row['FamCl'];
                        echo "<option value ='$idClient'>$FamCl</option> ";
                    }
                }
                mysqli_close($connect);
                ?>
            </select>
            <select class="form-control" name="Sotrudnik_idSotrudnik" required>
                <option value="">Выберите сотрудника</option>
                <?php
                include("Db.php");
                $query = "SELECT * FROM sotrudnik";
                $res = mysqli_query($connect, $query);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idSotr = $row['idSotr'];
                        $FamSotr = $row['FamSotr'];
                        echo "<option value ='$idSotr'>$FamSotr</option> ";
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
    $r = mysqli_query(
        $connect,
        "SELECT z.idZ, z.DateZ, z.OpisProb, m.NaimenModel,t.GosNum , CONCAT(c.FamCl, ' ', c.ImyaCl) AS FullNameClient, s.FamSotr  FROM bdkurs.zayavka z  
        JOIN bdkurs.ts t ON z.Ts_idTs = t.idTs  
        JOIN bdkurs.model m ON t.Model_idModel = m.idModel  
        JOIN bdkurs.client c ON z.Client_idClient = c.idClient  
        JOIN bdkurs.sotrudnik s ON z.Sotrudnik_idSotrudnik = s.idSotr
        ORDER BY idZ ASC"
    );
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Заявка</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Дата Заявки</th>";
    echo "<th>Описание проблемы</th>";
    echo "<th>Модель</th>";
    echo "<th>Госномер</th>";
    echo "<th>ФИ клиента</th>";
    echo "<th>Фамилия сотрудника</th>";
    echo "<th>Действие</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    do {
        echo "<tr>";
        echo "<form class='form-table' action='../mods/update/Zayavka.php' method='post'>";
        echo "<td><input size='1' class='form-control' name='idZ' type='text' value='$myrow[idZ]' readonly='readonly'/></td>";
        echo "<td><input size='15' class='form-control' name='' type='text' value='$myrow[DateZ]' readonly='readonly'/></td>";
        echo "<td><input size='30' class='form-control' name='OpisProb' type='text' value='$myrow[OpisProb]' required/></td>";
        echo "<td><input size='5' class='form-control' name='' type='text' value='$myrow[NaimenModel]' readonly='readonly'/></td>";
        echo "<td><input size='7' class='form-control' name='' type='text' value='$myrow[GosNum]' readonly='readonly'/></td>";
        echo "<td><input size='35' class='form-control' name='' type='text' value='$myrow[FullNameClient]' readonly='readonly'/></td>";
        echo "<td><input size='30' class='form-control' name='' type='text' value='$myrow[FamSotr]' readonly='readonly'/></td>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td>";
        echo "</form>";
        echo "</tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</tbody>";
    echo "</table>";
    ?>
</body>

</html>
