<?php

include_once ("../model/stockModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$idTienda=$data['idTienda'];
$idProducto=$data['idProducto'];
$precio=$data['precio'];
$descuento=$data['descuento'];
$cantidad=$data['cantidad'];

$stock=new stockModel();

$stock->setIdTienda($idTienda);
$stock->setIdProducto($idProducto);
$stock->setPrecio($precio);
$stock->setDescuento($descuento);
$stock->setCantidad($cantidad);

$response=array();
$response['error']=$stock->insertStock();

echo json_encode($response);

unset ($stock);