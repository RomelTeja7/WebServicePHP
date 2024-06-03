<?php
function Connection(){
    $server = "localhost";
    $name = "root";
    $pass = "";
    $db = "myservice";

    $mysqli = new mysqli($server,$name,$pass,$db);

    if($mysqli->connect_error){
        die("Ocurrio un error en la conexion a base de datos".$mysqli->connect_error);
    }
    return $mysqli;
}