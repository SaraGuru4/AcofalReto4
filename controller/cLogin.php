<?php
	require_once '../model/usuarioModel.php';
	$response = array();
	$data = json_decode( file_get_contents( "php://input" ), true );
	
	$correo = $data[ 'correo' ];
	$password = $data[ 'password' ];
	
	if ( ( $correo != "" ) && ( $password != "" ) ) {
		
		$user = new usuarioModel();
		$user->setCorreo($correo);
		$user->setPassword($password);

		$isValid = $user->findUserByEmail();
		
		if ( $isValid ) // si es correcto el userName y el password
		{
			session_start();

			$_SESSION[ 'correo' ] = $user->getCorreo();
			$_SESSION[ 'admin' ] = $user->getAdmin();
			$_SESSION[ 'nombreUsuario' ] = $user->getNombreUsuario();
			$_SESSION[ 'apellidos' ] = $user->getApellidos();
			$_SESSION[ 'idUsuario' ] = $user->getIdUsuario();
			$_SESSION[ 'password' ] = $user->getPassword();
			
			
			$response[ 'user' ] = $user->objVars();
			$response[ 'error' ] = "no error";
		} else {
			$response[ 'error' ] = "Correo/Contraseña incorrecta";
		}
	} else {
		
		$response[ 'error' ] = "Campos de usuario y contraseña vacíos";      // not filled user or password
	}
	
	$response['user'] = $user->objVars();
	
	echo json_encode( $response );
	
	unset( $response );
