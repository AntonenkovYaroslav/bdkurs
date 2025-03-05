<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../css/admin1.css" rel="stylesheet">
</head>

<body>
    <!-- Модальное окно добавление  -->
    <form action="../mods/insert/Zayavka.php" method="post">
        <input type="text" name="idZ" placeholder="idZ" class="textbox" required>
        <input type="date" name="DateZ" required>
        <input type="text" name="OpisProb" placeholder="Описание проблемы" class="textbox" required>
        <select class="select" name="Ts_idTs" required>
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
        <select class="select" name="Client_idClient" required>
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

        <select class="select" name="Sotrudnik_idSotrudnik" required>
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
        <button type="submit" class="btn btn-success" line-height="3">Добавить запись</button>
        <?php

        $targetFile = '../home.php';
        ?>

        <a href="<?php echo $targetFile; ?>" class="btn btn-dark">Назад</a>
    </form>

    <?php

    // Настройки подключения к базе данных  
    include("../tabs/Db.php");
    $r = mysqli_query(
        $connect,
        "SELECT z.idZ, z.DateZ, z.OpisProb, m.NaimenModel,t.GosNum , CONCAT(c.FamCl, ' ', c.ImyaCl) AS FullNameClient, s.FamSotr  FROM bdkurs.zayavka z  
    JOIN bdkurs.ts t ON z.Ts_idTs = t.idTs  
    JOIN bdkurs.model m ON t.Model_idModel = m.idModel  
    JOIN bdkurs.client c ON z.Client_idClient = c.idClient  
    JOIN bdkurs.sotrudnik s ON z.Sotrudnik_idSotrudnik = s.idSotr
    order by idZ asc"
    );
    $myrow = mysqli_fetch_array($r);
    echo "<h4>Справочник - Заявка</h4>";
    echo "<center>";
    echo "<table class='table table-hover'>";

    echo "<thead>";
    echo "<tr>";
    echo "#";
    echo "Дата Заявки";
    echo "Описание проблемы";
    echo "Модель";
    echo "Госномер";
    echo "ФИ клиента";
    echo "Фамилия сотрудника";
    echo "</tr>";
    echo "</thead>";
    do {
        echo "<tr><td>";
        echo "<form class='form-table' action='../mods/update/Zayavka.php' method='post'>";
        echo "<input size='1' class='form-control input-sm' name='idZ' type='text' value='$myrow[idZ]' readonly='readonly'/>";
        echo "<input size='15' class='form-control input-sm' name='' type='text' value='$myrow[DateZ]' readonly='readonly'/>";
        echo "<input size='30' class='form-control input-sm' name='OpisProb' type='text' value='$myrow[OpisProb]' required/>";
        echo "<input size='5' class='form-control input-sm' name='' type='text' value='$myrow[NaimenModel]' readonly='readonly'/>";
        echo "<input size='7' class='form-control input-sm' name='' type='text' value='$myrow[GosNum]' readonly='readonly'/>";
        echo "<input size='35' class='form-control input-sm' name='' type='text' value='$myrow[FullNameClient]' readonly='readonly'/>";
        echo "<input size='30' class='form-control input-sm' name='' type='text' value='$myrow[FamSotr]' readonly='readonly'/>";
        echo "<input type='submit' class='btn btn-warning' value='Изменить'/></td></form>";
        echo "</td></tr>";
    } while ($myrow = mysqli_fetch_array($r));
    echo "</table>";

    ?>

</body>

</html>