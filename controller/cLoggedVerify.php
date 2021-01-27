<?php
	require_once '../model/usuarioModel.php';
	require_once '../model/tiendaModel.php';
	
	session_start();
	
	$response = array();
	
	if ( ( isset( $_SESSION[ 'correo' ] ) ) && ( isset( $_SESSION[ 'admin' ] ) ) ) {
		
		$user = new usuarioModel();
		$tienda= new tiendaModel();
		

		$user->setCorreo( $_SESSION[ 'correo' ] );
		$user->setAdmin( $_SESSION[ 'admin' ] );
		
		//Nombre de usuario y apellido obtenido del login
		$user->setIdUsuario( $_SESSION[ 'idUsuario' ] );
		$user->setNombreUsuario( $_SESSION[ 'nombreUsuario' ] );
		$user->setApellidos( $_SESSION[ 'apellidos' ] );
		$user->setPassword( $_SESSION[ 'password' ] );
		$tienda->setIdTienda($_SESSION[ 'admin' ]);

		$response[ 'user' ] = $user->objVars();
		$response ['tienda']=$tienda->getById();
		$response[ 'error' ] = "no error";
		
	} else {
		$response[ 'error' ] = "no user logged";
	}
	
	$response['version'] = phpversion();
	echo json_encode( $response );
	unset( $response );
