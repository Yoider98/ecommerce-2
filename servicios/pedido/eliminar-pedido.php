<?php

    include_once('../_conexion.php');
    $response = new stdClass();
    $codped=$_POST['codped'];
    $sql="delete from pedido where codped=$codped";
    $result=mysqli_query($con,$sql);
    if($result){
        $response->state=true;
    }else{
        $response->state=false;
        $response->detail="el pedido no pudo ser elimiinado";
    }
    
    mysqli_close($con);
    header('Content-Type: application/json');
    echo json_encode($response);

