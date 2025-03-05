<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Справочник - Клиенты</title> 
    <!-- Bootstrap CSS --> 
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> 
     <link href="../css/admin1.css" rel="stylesheet"> 
</head> 
<style>
    .textbox {
        width: 200px;
        height: 30px;
        margin: 5px 2px 2px 5px;
    }
    </style>
<body> 
    <!-- Модальное окно "Добавление" --> 
    <h3>Добавить клиента</h3> 
    <form action='../mods/insert/Client.php' method='post'> 
        <input type="text" name="idClient" placeholder="idClient" class="textbox" required> 
        <input type="text" name="FamCl" placeholder="Фамилия" class="textbox" required> 
        <input type="text" name="ImyaCl" placeholder="Имя" class="textbox" required> 
        <input type="text" name="OtchCl" placeholder="Отчество" class="textbox" required> 
        <input type="text" name="AdrCl" placeholder="Адрес" class="textbox" required> 
        <input type="text" name="KontCl" placeholder="Конт. номер" class="textbox" required> 
        <button type="submit" class="btn btn-success" line-height="3">Добавить новую запись</button>
        <?php $targetFile = '../home.php'; ?>
        <button type="button" class="btn btn-dark" onclick="window.location.href='<?php echo $targetFile; ?>'">Назад</button>
    </form> 
<?php  

 
?>  
 
    <?php 
    // Настройки подключения к базе данных 
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
    echo "<th>Действия</th>"; // Добавлено для кнопки "Изменить" 
    echo "</tr>"; 
    echo "</thead>"; 
 
    while ($myrow = mysqli_fetch_array($r)) { 
        echo "<tr>"; 
        echo "<form action='../mods/update/Client.php' method='post'>"; // Измените путь на нужный 
        echo "<td><input size='1' class='form-control input-sm' name='idClient' type='text' value='{$myrow['idClient']}' readonly='readonly'/></td>"; 
        echo "<td><input size='8' class='form-control input-sm' name='FamCl' type='text' value='{$myrow['FamCl']}' required/></td>"; 
        echo "<td><input size='7' class='form-control input-sm' name='ImyaCl' type='text' value='{$myrow['ImyaCl']}' required/></td>"; 
        echo "<td><input size='8' class='form-control input-sm' name='OtchCl' type='text' value='{$myrow['OtchCl']}' required/></td>"; 
        echo "<td><input size='24' class='form-control input-sm' name='AdrCl' type='text' value='{$myrow['AdrCl']}' required/></td>"; 
        echo "<td><input size='9' class='form-control input-sm' name='KontCl' type='text' value='{$myrow['KontCl']}' required/></td>"; 
        echo "<td><button type='submit' class='btn btn-warning'>Изменить</button></td>"; // Кнопка "Изменить" 
        echo "</form>"; 
        echo "</tr>"; 
    } 
 
    echo "</table>"; 
    mysqli_close($connect); 
    ?> 
 
    
</body> 
</html>