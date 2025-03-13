<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin1.css" rel="stylesheet">
    <title>ТС</title>
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

        .btn-danger {
            background-color: #dc3545;
            color: white;
            width: 100%;
          
        }

        

        td form, td a {
            display: block;
            width: 100%;
        }
    </style>
</head>

<body>
    <h3>Добавить ТС</h3>
    <form action="../mods/insert/Ts.php" method='post'>
        <input type="text" name="idTs" placeholder="idTS" class="form-control" required>
        <input type="text" name="GosNum" placeholder="ГосНомер" class="form-control" required>
        <select class="form-control" name="Model_idModel" required>
            <option value="">выберите модель</option>
            <?php
            include("Db.php");
            $query = "SELECT * FROM model";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $idModel = $row['idModel'];
                    $nameO = $row['NaimenModel'];
                    echo "<option value='$idModel'>$nameO</option>";
                }
            }
            mysqli_close($connect);
            ?>
        </select>
        <button type="submit" class="btn btn-success">Добавить новую запись</button>
        <a href="../home.php" class="btn btn-dark">Назад</a>
    </form>

    <?php
    include("Db.php");
    $r = mysqli_query($connect, "SELECT idTs, GosNum, NaimenModel FROM Ts JOIN model ON Model_idModel = model.idModel");
    if (!$r) {
        die("Query failed: " . mysqli_error($connect));
    }
    echo "<h4>Справочник - ТС</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>ГосНомер</th>";
    echo "<th>Модель (ВК)</th>";
    echo "<th>Действие</th>";

    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($myrow = mysqli_fetch_array($r)) {
        echo "<tr>";
        echo "<form action='../mods/update/Ts.php' method='post'>";
        echo "<td><input size='1' class='form-control' name='idTs' type='text' value='$myrow[idTs]' readonly='readonly'/></td>";
        echo "<td><input size='15' class='form-control' name='GosNum' type='text' value='$myrow[GosNum]' required/></td>";
        echo "<td><input size='5' class='form-control' name='Model_idModel' type='text' value='$myrow[NaimenModel]' readonly='readonly'/></td>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td>";
      
        echo "</form>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    mysqli_close($connect);
    ?>
</body>

</html>