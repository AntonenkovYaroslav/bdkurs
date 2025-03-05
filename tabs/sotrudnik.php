<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Справочник - Сотрудники</title>
    <!-- Bootstrap CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
     <link href="../css/admin1.css" rel="stylesheet">
</head>

<body>
    <!-- Модальное окно "Добавление" -->
    <h3>Добавить сотрудника</h3>
    <form action='../mods/insert/Sotr.php' method='post'>
        <input type="text" name="idSotr" placeholder="idSotr" required>
        <input type="text" name="FamSotr" placeholder="Фамилия" required>
        <input type="text" name="ImyaSotr" placeholder="Имя" required>
        <input type="text" name="OtchSotr" placeholder="Отчество" required>
        <input type="text" name="KontSotr" placeholder="Контакт" required>
        <select class="select" name="idStat" required>
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
        <input type="text" name="Login" placeholder="Логин" required>
        <input type="text" name="password" placeholder="Пароль" required>
        <button type="submit" class="btn btn-success" line-height="3">Добавить новую запись</button>
        <?php $targetFile = '../home.php'; ?>
        <a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>
    </form>

    <?php
    include("../tabs/Db.php");
    $r = mysqli_query($connect, "SELECT idSotr, FamSotr, ImyaSotr, OtchSotr, kontSotr, NaimenStat, Login, password FROM sotrudnik
join status on sotrudnik.idStat = status.idStat order by sotrudnik.idSotr;");
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Сотрудники</h4>";
    echo "<center>";
    echo "<table class='form-table'>";

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
    do {
        echo "<tr>";
        echo "<form action='../mods/update/Sotr.php' method='post'>";
        echo "<td><input size='1' class='form-control input-sm' name='idSotr' type='text' value='$myrow[idSotr]' readonly='readonly'/></td>";
        echo "<td><input size='1' class='form-control input-sm' name='FamSotr' type='text' value='$myrow[FamSotr]' required/></td>";
        echo "<td><input size='1' class='form-control input-sm' name='ImyaSotr' type='text' value='$myrow[ImyaSotr]' required/></td>";
        echo "<td><input size='1' class='form-control input-sm' name='OtchSotr' type='text' value='$myrow[OtchSotr]' required/></td>";
        echo "<td><input size='1' class='form-control input-sm' name='kontSotr' type='text' value='$myrow[kontSotr]' required/></td>";
        echo "<td><input size='1' class='form-control input-sm' name='NaimenStat' type='text' value='$myrow[NaimenStat]' readonly='readonly'/></td>";
        echo "<td><input size='1' class='form-control input-sm' name='Login' type='text' value='$myrow[Login]' required/></td>";
        echo "<td><input size='1' class='form-control input-sm' name='password' type='text' value='$myrow[password]' required/></td>";
        echo "<td><input type='submit' class='btn btn-warning' value='Изменить'/></td>";
        echo "</tr></form>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";
    ?>
</body>

</html>