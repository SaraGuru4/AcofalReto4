<?php
	
	include_once( "../model/productoModel.php" );
	
    $producto= new productoModel();
	
	$response = array();
//Lista de productos
	$response['list'] = $producto->getAllProductos();   
	
	echo json_encode( $response );
	
	unset ($producto);