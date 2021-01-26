<?php

include_once ("../model/usuarioModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$response=array();
$idUsuario=$data['idUsuario'];


$user= new usuarioModel();
$user->setIdUsuario($idUsuario);

$response['error']=$user->deleteUser();

echo json_encode($response);

unset ($user);
