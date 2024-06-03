<?php
header('Content-Type: application/json');

function getData(){
    include_once '../config/connection.php';
    $con = Connection();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['country']) && isset($_GET['age'])){
            $country = $_GET['country'];
            $age = $_GET['age'];
            $query = "SELECT * FROM data WHERE country = '$country' AND age >= $age";
        }else{
            $query = "SELECT * FROM data";
        }
        $result = $con->query($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            echo json_encode($data);
        }else{
            echo json_encode(["error" => "Ocurrio un error al mostrar los datos.".$con->error]);
        }
        $con->close();
    }

}
getData();