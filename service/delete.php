<?php
header('Content-Type: application/json');
function DeleteData(){
    include_once '../config/connection.php';
    $con = Connection();
    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "DELETE FROM data WHERE id = ?";
            $st = $con->prepare($query);
            $st->bind_param("i", $id);
            if($st->execute()){
                echo json_encode(["success" => "El id:".$id." se elimino correctamente."]);
            }else{
                echo json_encode(["error" => "Ocurrio un error, no se pudo eliminar el id: ".$id]);
            }
            $st->close();
        }
        $con->close();
    }
}
DeleteData();