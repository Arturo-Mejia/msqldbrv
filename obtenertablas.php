<?php
include 'conexion.php';

$host=$_GET["host"];
$user=$_GET["user"];
$pass=$_GET["pass"];
$database=$_GET["db"];

$conn=conectar($host,$user,$pass,$database);
$indice="Tables_in_".$database;
$sql = "show tables;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="tarjeta">';
        echo  '<img src="assets/img/table.png" class="card-img-top"/>';
        echo  '<p>'.$row[$indice].'</p>';
        ?>
        <button type="button" class="btn btn-primary" onclick="vertabla('<?php print $row[$indice];?>');">ver tabla</button> </div>

     <?php
    }
} else {
 echo "0";  
}
$conn->close();

?>