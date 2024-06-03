<?php
header('Content-Type: application/json');
function InsertData(){
    include_once '../config/connection.php';
    $con =  Connection();
    $inputData = file_get_contents("php://input");
    $data = json_decode($inputData, true);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($data['name']) && isset($data['country']) && isset($data['age'])) {
            $name = $data['name'];
            $country = $data['country'];
            $age = $data['age'];
            $query =  "INSERT INTO data (name,country,age) VALUES (?,?,?)";
            $st = $con->prepare($query);
            $st->bind_param("ssi",$name,$country,$age);

            if($st->execute()){
                echo json_encode(["success" => "Los datos se agregaron correctamente"]);
            }else{
                echo json_encode(["error" => "Los datos no se agregaron correctamente"]);
            }
            $st->close();
        }
        $con->close();
    }
}

InsertData();