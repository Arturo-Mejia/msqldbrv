<?php
include 'conexion.php';

$host=$_GET["host"];
$user=$_GET["user"];
$pass=$_GET["pass"];
$database=$_GET["db"];
$table=$_GET["table"];

$conn=conectar($host,$user,$pass,$database);
$cont=0;  
$indices=array(); 
?>

<table class="table table-bordered ">
  <thead class="thead-dark">
    <tr>
<?php
$getcolumn = "show columns from ".$table.";"; 
$result = $conn->query($getcolumn);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $indices[$cont]=$row["Field"];
        $cont++; 
        ?>
        <th scope="col"><?php print $row["Field"] ?></th>
        <?php
    }    
} 

?>
    </tr>
  </thead>
  <tbody>
 
<?php

$sql2 = "select * from ".$table.";";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
         ?>
            <tr>
           <?php for($i=0;$i<count($indices);$i++)
            {  ?>
                <td> <?php print $row2[$indices[$i]]; ?> </td>
           <?php } ?>
            </tr>
      <?php  }    
    } 

$conn->close();

?>

</tbody>
</table>
