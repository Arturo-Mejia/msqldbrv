<?php
    function conectar($hostname,$username,$pass,$database)
    {
        $mysqli = new mysqli($hostname,$username,$pass,$database);
        if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
        return $mysqli; 
    } 
     
?>