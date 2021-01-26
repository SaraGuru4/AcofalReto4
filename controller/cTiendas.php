<?php
	
	include_once( "../model/tiendaModel.php" );
	
	$tienda = new tiendaModel();
	
	$response = array();
//Lista de comentarios
	$response[ 'list' ] = $tienda->setListTiendas();
	
	$response[ 'error' ] = "no error";
	
	echo json_encode( $response );
	
	unset ( $tienda );