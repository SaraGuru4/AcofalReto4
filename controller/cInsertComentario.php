<?php

include_once( "../model/comentarioModel.php" );

$data = json_decode( file_get_contents( "php://input" ), true );

$modeloComentario = new comentarioModel();

$response = array();


$modeloComentario->setTitulo( $data[ 'titulo' ] );
$modeloComentario->setTexto( $data[ 'texto' ] );

$response[ 'answer' ] = $modeloComentario->insertComentario();

echo json_encode( $response );

unset( $modeloComentario );