
<?php

include_once ("../model/comentarioModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$response=array();
$idComentario=$data['idComentario'];


$comentario= new comentarioModel();
$comentario->setIdComentario($idComentario);

$response['error']=$comentario->deleteComentario();

echo json_encode($response);

unset ($comentario);

