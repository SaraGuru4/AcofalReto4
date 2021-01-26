<?php
	require_once '../model/usuarioModel.php';
	
	session_start();
	
	$response = array();
	
	if ( ( isset( $_SESSION[ 'correo' ] ) ) && ( isset( $_SESSION[ 'admin' ] ) ) ) {
		
		$user = new usuarioModel();
		
		
		$user->setCorreo( $_SESSION[ 'correo' ] );
		$user->setAdmin( $_SESSION[ 'admin' ] );
		
		//Nombre de usuario y apellido obtenido del login
		$user->setIdUsuario( $_SESSION[ 'idUsuario' ] );
		$user->setNombreUsuario( $_SESSION[ 'nombreUsuario' ] );
		$user->setApellidos( $_SESSION[ 'apellidos' ] );
		$user->setPassword( $_SESSION[ 'password' ] );
		
		$response[ 'user' ] = $user->objVars();
		$response[ 'error' ] = "no error";
		
	} else {
		$response[ 'error' ] = "no user logged";
	}
	echo json_encode( $response );
	
	unset( $response );
