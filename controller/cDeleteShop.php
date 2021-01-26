<?php

include_once ("../model/tiendaModel.php");

$response=array();
$data=json_decode(file_get_contents("php://input"),true);

$idTienda=$data['idTienda'];

$tienda= new tiendaModel();
$tienda->setIdTienda($idTienda);

$response['error']=$tienda->deleteTienda();


echo json_encode($response);

unset ($tienda);
