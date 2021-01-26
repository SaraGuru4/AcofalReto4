<?php
include_once ("../model/stockModel.php");
include_once ("../model/tiendaModel.php");

$data=json_decode(file_get_contents("php://input"),true);
$idTienda=$data['idTienda'];
$response=array();

//Traemos los datos de la tienda
$tienda= new tiendaModel();
$tienda->setIdTienda($idTienda);

//Traemos los datos de la tabla stock Tienda-Producto
$stock = new stockModel();
$stock->setIdTienda($idTienda);

$response['stock']=$stock->getStockByIdTienda();
$response['tienda']=$tienda->getById();

echo json_encode($response);

unset ($stock);
unset($tienda);