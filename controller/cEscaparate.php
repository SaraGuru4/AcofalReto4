<?php
include_once ("../model/escaparateModel.php");

$tipoTienda= new escaparateModel();
//$data=json_decode(file_get_contents("php://input"),true);
//$idTipo=$data['idTipo'];
$response=array();
//$tipoTienda->setIdTipo($idTipo);
$response['lista']=$tipoTienda->tipoTienda(); 
echo json_encode($response);

unset ($tipoTienda);