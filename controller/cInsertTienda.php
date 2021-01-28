<?php
	
	include_once( "../model/tiendaModel.php" );
	
	$data = json_decode( file_get_contents( "php://input" ), true );
	
	$idUsuario = $data['idUsuario'];
	$nombre = $data[ 'nombre' ];
	$direccion = $data[ 'direccion' ];
	$descripcion = $data[ 'texto' ];
	$imagen = $data[ 'imagen' ];
	$tipo = $data[ 'tipo' ];
	$tipoWeb = 1;
	$savedFileBase64 = $data[ 'savedFileBase64' ];
	
	$nuevaTienda = new tiendaModel();
	
	$nuevaTienda->setIdUsuario( $idUsuario );
	$nuevaTienda->setNombreTienda( $nombre );
	$nuevaTienda->setDireccion( $direccion );
	$nuevaTienda->setTexto( $descripcion );
	$nuevaTienda->setIdTipo( $tipo );
	$nuevaTienda->setLogo( $imagen );
	$nuevaTienda->setFoto( $imagen );
	$nuevaTienda->setIdTipo( $tipo );
	$nuevaTienda->setTipoWeb( $tipoWeb );
	
	$response = array();
	
	$response[ 'error' ] = $nuevaTienda->insertTienda();
	
	if ( $savedFileBase64 != "" ) {
		
		
		$fileBase64 = explode( ',', $savedFileBase64 )[ 1 ]; //parte dcha de la coma
		
		
		$file = base64_decode( $fileBase64 );
		
		/*Se especifica el directorio donde se almacenarán los ficheros(se crea si no existe)*/
		$writable_dir = '../view/img/escaparate';
		if ( !is_dir( $writable_dir ) ) {
			mkdir( $writable_dir );
		}

//Se escribe el archivo
		file_put_contents( $writable_dir . $imagen, $file, LOCK_EX );
		
	}
	
	echo json_encode( $response );
	
	unset ( $nuevaTienda );
