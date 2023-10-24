<?php 
    include "conn.php";

    $content = file_get_contents("php://input");

    $data = json_decode($content);

    $sql = "INSERT INTO `cadastre_details`(`province`, `municipality`, `via`, `number_val`) VALUES ('{$data->province}','{$data->municipality}','{$data->via}','{$data->number}')";

    $runQuery = mysqli_query($conn,$sql) or die(json_encode(["massage"=> "run query failed","status"=>"failed"]));

    if ($runQuery) {
        echo json_encode(["massage"=> "Data saved","status"=>"true"]);
    } else {
        echo json_encode(["massage"=> "Data could not saved","status"=>"false"]);
    }
    


?>