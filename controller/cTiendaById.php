<?php
	
	include_once '../model/tiendaModel.php';
	
	
	$data = json_decode( file_get_contents( "php://input" ), true );
	
	$idTienda = $data[ 'idTienda' ];
	
	$tienda = new tiendaModel();
	
	
	$tienda->setIdTienda( $idTienda );
	$response = array();
	
	
	$response[ 'list' ] = $tienda->getById();
	
	$response[ 'error' ] = "no error";
	
	echo json_encode( $response ); // pasar de php a json
	
	unset ( $tienda );