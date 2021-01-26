<?php
include_once ("../model/escaparateModel.php");
include_once ("../model/tiendaModel.php");

$tipoTienda= new escaparateModel();
$data=json_decode(file_get_contents("php://input"),true);

$idTipo=$data['idTipo'];
$response=array();
$tipoTienda->setIdTipo($idTipo);

$tienda = new tiendaModel();
$tienda->setIdTipo($idTipo);

$tipoTienda->setIdTipo($idTipo);
$response['tipo']=$tipoTienda->getById();
$response['tienda']=$tienda->getByIdTipo();
echo json_encode($response);

unset ($tipoTienda);