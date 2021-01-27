<?php

include_once ("../model/stockModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$idStock=$data['idStock'];

$stock=new stockModel();

$stock->setIdStock($idStock);

$response=array();
$response['list']=$stock->getStockByIdStock();

echo json_encode($response);

unset ($stock);