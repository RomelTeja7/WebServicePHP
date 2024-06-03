<?php
header('Content-Type: application/json');
function UpdateData(){
    include_once '../config/connection.php';
    $con = Connection();
    $inputData = file_get_contents("php://input");
    $data = json_decode($inputData, true);
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        if (isset($_GET['id']) && isset($data['name']) && isset($data['country']) && isset($data['age'])) {
            $id = $_GET['id'];
            $name = $data['name'];
            $country = $data['country'];
            $age = $data['age'];

            $query = "UPDATE data SET name = ?, country =?, age =? WHERE id = ?";
            $st = $con->prepare($query);
            $st->bind_param("ssii",$name, $country,$age,$id);
            if($st->execute()){
                echo json_encode(["success" => "Se actualizaron los datos correctamente"]);
            }else{
                echo json_encode(["error" => "ocurrio un error en actualizar los datos".$con->error]);
            }
            $st->close();
        }
        $con->close();
    }
}
UpdateData();
