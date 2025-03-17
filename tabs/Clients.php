<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/admin1.css" rel="stylesheet">
    <title>Справочник - Клиенты</title>
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
            flex-direction: row; 
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
            max-width: 80%; 
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
    <div class="modal">
        <h3>Добавить клиента</h3>
        <form action='../mods/insert/Client.php' method='post' style='display: flex; flex-direction: column; gap: 10px;'>
            <input type="text" name="idClient" placeholder="idClient" class="form-control" required>
            <input type="text" name="FamCl" placeholder="Фамилия" class="form-control" required>
            <input type="text" name="ImyaCl" placeholder="Имя" class="form-control" required>
            <input type="text" name="OtchCl" placeholder="Отчество" class="form-control" required>
            <input type="text" name="AdrCl" placeholder="Адрес" class="form-control" required>
            <input type="text" name="KontCl" placeholder="Конт. номер" class="form-control" required>
            <button type="submit" class="btn btn-success">Добавить новую запись</button>
            <a href="../home.php" class="btn btn-dark">Назад</a>
        </form>
    </div>

    <?php
    include("../tabs/Db.php");

    $r = mysqli_query($connect, "SELECT * FROM client");
    if (!$r) {
        die("Ошибка запроса: " . mysqli_error($connect));
    }

    echo "<h4>Справочник - Клиенты</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Фамилия</th>";
    echo "<th>Имя</th>";
    echo "<th>Отчество</th>";
    echo "<th>Адрес</th>";
    echo "<th>Конт. номер</th>";
    echo "<th>Действие</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($myrow = mysqli_fetch_array($r)) {
        echo "<tr>";
        echo "<form  action='../mods/update/Client.php' method='post' style='display: flex; flex-direction: column; gap: 10px;'>";
        echo "<td><input size='1' class='form-control' name='idClient' type='text' value='{$myrow['idClient']}' readonly='readonly'/></td>";
        echo "<td><input size='8' class='form-control' name='FamCl' type='text' value='{$myrow['FamCl']}' required/></td>";
        echo "<td><input size='7' class='form-control' name='ImyaCl' type='text' value='{$myrow['ImyaCl']}' required/></td>";
        echo "<td><input size='8' class='form-control' name='OtchCl' type='text' value='{$myrow['OtchCl']}' required/></td>";
        echo "<td><input size='24' class='form-control' name='AdrCl' type='text' value='{$myrow['AdrCl']}' required/></td>";
        echo "<td><input size='9' class='form-control' name='KontCl' type='text' value='{$myrow['KontCl']}' required/></td>";
        echo "<td><button type='submit' class='btn btn-warning'>Изменить</button></td>";
        echo "</form>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    mysqli_close($connect);
    ?>
</body>

</html>