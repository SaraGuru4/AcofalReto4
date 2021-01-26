<?php

include_once("../model/usuarioModel.php");

$user = new usuarioModel();
$response = array();
$data = json_decode(file_get_contents("php://input"), true);


$idUpdate = $data['idUpdate'];
$nombreUpdate = $data['nombreUpdate'];
$apellidoUpdate = $data['apellidoUpdate'];
$correoUpdate = $data['correoUpdate'];
$passwordUpdate = $data['passwordUpdate'];
$adminUpdate = $data['adminUpdate'];



$user->setIdUsuario($idUpdate);
$user->setNombreUsuario($nombreUpdate);
$user->setApellidos($apellidoUpdate);
$user->setCorreo($correoUpdate);
$user->setPassword($passwordUpdate);
$user->setAdmin($adminUpdate);

$response['error'] = $user->updateUsuario();

echo json_encode($response);
unset($user);

