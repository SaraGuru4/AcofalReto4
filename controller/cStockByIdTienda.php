<?php

include_once ("../model/stockModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$idTienda=$data['idTienda'];

$stock=new stockModel();

$stock->setIdTienda($idTienda);

$response=array();
$response['list']=$stock->getStockByIdTienda();

echo json_encode($response);

unset ($stock);