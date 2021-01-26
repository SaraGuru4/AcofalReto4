<?php

include_once ("../model/usuarioModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$nombreInsert=$data['nombreInsert'];
$emailInsert=$data['emailInsert'];
$passwordInsert=$data['emailInsert'];
$adminInsert=$data['adminInsert'];

$nuevoUsuario=new usuarioModel();

$nuevoUsuario->setNombreUsuario($nombreInsert);
$nuevoUsuario->setCorreo($emailInsert);
$nuevoUsuario->setPassword($passwordInsert);
$nuevoUsuario->setAdmin($adminInsert);

$response=array();

$response['error']=$nuevoUsuario->insertUsuarioRegistro(); 

echo json_encode($response);

unset ($nuevoUsuario);
