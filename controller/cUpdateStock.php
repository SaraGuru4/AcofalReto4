<?php

include_once ("../model/stockModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$idStock=$data['idStock'];
$precio=$data['precio'];
$descuento=$data['descuento'];
$cantidad=$data['cantidad'];

$stock=new stockModel();

$stock->setIdStock($idStock);
$stock->setPrecio($precio);
$stock->setDescuento($descuento);
$stock->setCantidad($cantidad);

$response=array();
$response['error']=$stock->updateStock();

echo json_encode($response);

unset ($stock);