<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Справочник - Сотрудники</title>
    <link href="../css/admin1.css" rel="stylesheet">
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
            display: flex;
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
            display: flex;
            
            padding: 5px;
            gap: 5px;
        }

        .btn {
            padding-top: 6px;
            padding-bottom: 6px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
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
            width: 100%;
            text-align: center;
        }

        td form, td a {
            display: block;
            width: 100%;
        }
        div{
            display: flex;
            justify-content: center;
            flex-direction: column;
        } 

        .modal {
            display: flex;
            max-width: 1100px; 
            margin: 0 auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 10px; 
            background-color: #fff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
        }
        
    </style>
</head>

<body>
    <div class="modal" >
        <h3>Добавить сотрудника</h3>
        <form action='../mods/insert/Sotr.php' method='post' style="display: flex; flex-direction: column; gap: 10px;">
            <input type="text" name="idSotr" placeholder="idSotr" class="form-control" required>
            <input type="text" name="FamSotr" placeholder="Фамилия" class="form-control" required>
            <input type="text" name="ImyaSotr" placeholder="Имя" class="form-control" required>
            <input type="text" name="OtchSotr" placeholder="Отчество" class="form-control" required>
            <input type="text" name="KontSotr" placeholder="Контакт" class="form-control" required>
            <select class="form-control" name="idStat" required>
                <?php
                include("Db.php");
                $query = "SELECT * FROM status";
                $result = mysqli_query($connect, $query);
                echo "<option selected value='0'>выберите должность</option>";
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $idStat = $row['idStat'];
                        $nameS = $row['NaimenStat'];
                        echo "<option value='$idStat'>$nameS</option>";
                    }
                }
                ?>
            </select>
            <input type="text" name="Login" placeholder="Логин" class="form-control" required>
            <input type="text" name="password" placeholder="Пароль" class="form-control" required>
            <button type="submit" class="btn btn-success">Добавить новую запись</button>
            <a href="../home.php" class="btn btn-dark">Назад</a>
        </form>
    </div>

    <?php
    include("../tabs/Db.php");
    $r = mysqli_query($connect, "SELECT idSotr, FamSotr, ImyaSotr, OtchSotr, kontSotr, NaimenStat, Login, password FROM sotrudnik
join status on sotrudnik.idStat = status.idStat order by sotrudnik.idSotr;");
    if (!$r) {
        die("Query failed: " . mysqli_error($connect));
    }
    echo "<h4>Справочник - Сотрудники</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Фамилия</th>";
    echo "<th>Имя</th>";
    echo "<th>Отчество</th>";
    echo "<th>Конт. номер</th>";
    echo "<th># Статус</th>";
    echo "<th>Логин</th>";
    echo "<th>Пароль</th>";
    echo "<th>Действия</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($myrow = mysqli_fetch_array($r)) {
        echo "<tr>";
        echo "<form action='../mods/update/Sotr.php' method='post'>";
        echo "<td><input size='1' class='form-control' name='idSotr' type='text' value='$myrow[idSotr]' readonly='readonly'/></td>";
        echo "<td><input size='15' class='form-control' name='FamSotr' type='text' value='$myrow[FamSotr]' required/></td>";
        echo "<td><input size='15' class='form-control' name='ImyaSotr' type='text' value='$myrow[ImyaSotr]' required/></td>";
        echo "<td><input size='15' class='form-control' name='OtchSotr' type='text' value='$myrow[OtchSotr]' required/></td>";
        echo "<td><input size='15' class='form-control' name='kontSotr' type='text' value='$myrow[kontSotr]' required/></td>";
        echo "<td><input size='15' class='form-control' name='NaimenStat' type='text' value='$myrow[NaimenStat]' readonly='readonly'/></td>";
        echo "<td><input size='15' class='form-control' name='Login' type='text' value='$myrow[Login]' required/></td>";
        echo "<td><input size='15' class='form-control' name='password' type='text' value='$myrow[password]' required/></td>";
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