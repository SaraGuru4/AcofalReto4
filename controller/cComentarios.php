<?php

include_once ("../model/comentarioModel.php");

$comentario= new comentarioModel();

$response=array();
//Lista de comentarios
$response['list']=$comentario->setListComments();

$response['error']="no error";

echo json_encode($response); 

unset ($comentario);