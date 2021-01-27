<?php

include_once ("../model/stockModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$idStock=$data['idStock'];

$stock=new stockModel();

$stock->setIdTienda($idTienda);

$response=array();
$response['error']=$stock->deleteStock();

echo json_encode($response);

unset ($stock);