<?php
include("../../tabs/Db.php");
 $idZ = $_POST['idZ'];  
 $OpisProb = $_POST['OpisProb'];  

 $query = "UPDATE zayavka SET  OpisProb = '$OpisProb' WHERE idZ = '$idZ'";  

 if (mysqli_query($connect, $query)) {  
 header('Location: ../../tabs/zayavka.php');  
 exit;  
 } else {  
 echo "Ошибка: " . mysqli_error($connect);  
 }  
  
?>  