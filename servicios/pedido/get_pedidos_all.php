<?php
include('../_conexion.php');
$response= new stdClass();

session_start();
$codusu=$_SESSION['codusu'];
$datos=array(); 
$i=0;
$sql="select ped.*,pro.*,
CASE WHEN ped.estado=2 THEN 
    'POR PAGAR'
ELSE 
    CASE WHEN ped.estado=3 THEN 
    'POR ENTREGAR'
ELSE
    'OTRO'
END 
END estadotxt
from pedido ped
inner join producto pro
on ped.codpro=pro.codpro
where ped.codusu=$codusu";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
    $obj= new stdClass();
    $obj->codpro=$row['codpro'];
    $obj->nompro=$row['nompro'];
    $obj->despro=$row['despro'];
    $obj->fecped=$row['fecped'];
    $obj->dirusuped=$row['dirusuped'];
    $obj->telusuped=$row['telusuped'];
    $obj->prepro=$row['prepro'];
    $obj->rutimapro=$row['rutimapro'];
    $obj->estado=$row['estadotxt'];
    $datos[$i] = $obj;
    $i++;
}

$response->datos=$datos;

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);