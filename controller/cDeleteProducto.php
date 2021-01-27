
<?php

include_once ("../model/productoModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$response=array();
$idProducto=$data['idProducto'];

$producto= new productoModel();
$producto->setIdProducto($idProducto);

$response['error']=$producto->deleteProducto();

echo json_encode($response);

unset ($producto);

