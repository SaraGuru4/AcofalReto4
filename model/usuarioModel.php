<?php
	
	if ( !defined( 'isLocal' ) ) {
		
		/**
		 * isLocal nos indica si estamos en un servidor local (True) o no (False)
		 */
		define( 'isLocal', !( $_SERVER[ 'HTTP_HOST' ] == "grupo1.zerbitzaria.net" ) );
		
	}
	
	if ( isLocal ) {
		
		include_once( "connect_data.php" );
	} else include_once( "connect_data_remote.php" );
	
	include_once 'connect_data.php';
	include_once 'usuarioClass.php';
	include_once 'usuarioModel.php';
	
	
	class usuarioModel extends usuarioClass {
		
		
		private $link;
		
		public function getList() {
			return $this->list;
		}
		
		public function setList( $list ) {
			$this->list = $list;
		}
		
		public function OpenConnect() {
			$konDat = new connect_data();
			try {
				$this->link = new mysqli( $konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname );
			} catch ( Exception $e ) {
				echo $e->getMessage();
			}
			$this->link->set_charset( "utf8" ); // honek behartu egiten du aplikazio eta
			//                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
		}
		
		public function CloseConnect() {
			mysqli_close( $this->link );
		}
		
		public function findUserByEmail() {
			$this->OpenConnect();
			
			$correo = $this->correo;
			$password = $this->password;
			
			$sql = "call spFindUserByEmail('$correo','$password')";
			$result = $this->link->query( $sql );
			
			$success = false;
			
			if ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
				var_dump($row);
				if ( $this->password === $row[ 'password' ] ) {
					$this->admin = $row[ 'admin' ];
					$this->nombreUsuario = $row[ 'nombreUsuario' ];
					$this->apellidos = $row[ 'apellidos' ];
					$this->idUsuario = $row[ 'idUsuario' ];
					$this->password = $row[ 'password' ];
					
					$success = true;
				}
				mysqli_free_result( $result );
				$this->CloseConnect();
			}
			return $success;
		}
		
		public function insertUsuarioRegistro() {
			
			$this->OpenConnect();
			$nombreInsert = $this->getNombreUsuario();
			$correoInsert = $this->getCorreo();
			$passwordInsert = $this->getPassword();
			$adminInsert = $this->getAdmin();
			
			
			$sql = "CALL spInsertUsuarioRegistro('$nombreInsert','$correoInsert','$passwordInsert', $adminInsert)";
			
			if ( $this->link->query( $sql ) ) {
				$returnString = "Te has registrado correctamente, ya puedes iniciar sesión";
				$this->CloseConnect();
				return $returnString;
			} else {
				$this->CloseConnect();
				return $sql . "Error al insertar";
			}
		}
		
		
		public function updateUsuario() {
			
			$this->OpenConnect();
			
			$idUpdate = $this->getIdUsuario();
			$nombreInsert = $this->getNombreUsuario();
			$correoInsert = $this->getCorreo();
			$apellidoInsert = $this->getApellidos();
			$passwordInsert = $this->getPassword();
			$adminInsert = $this->getAdmin();
			
			
			$sql = "CALL spUpdateUser($idUpdate,'$nombreInsert','$apellidoInsert','$correoInsert','$passwordInsert',$adminInsert)";
			
			if ( $this->link->query( $sql ) ) {
				$returnString = "Modificado correctamente " . $this->link->affected_rows;
				$this->CloseConnect();
				return $returnString;
			} else {
				$this->CloseConnect();
				return $sql . "Error al insertar";
			}
			
		}
		
		
		public function setListUsers() {
			$this->OpenConnect();
			
			$sql = "call spAllUsers()";
			
			$list = array();
			
			$result = $this->link->query( $sql );
			
			while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
				
				$newUser = new usuarioModel();
				$newUser->idUsuario = $row[ 'idUsuario' ];
				$newUser->nombreUsuario = $row[ 'nombreUsuario' ];
				$newUser->apellidos = $row[ 'apellidos' ];
				$newUser->correo = $row[ 'correo' ];
				$newUser->password = $row[ 'password' ];
				$newUser->admin = $row[ 'admin' ];
				
				array_push( $list, get_object_vars( $newUser ) );
			}
			mysqli_free_result( $result );
			$this->CloseConnect();
			return ( $list );
		}
		
		
		public function deleteUser() {
			
			$this->OpenConnect();  // konexio zabaldu  - abrir conexión
			
			$idUsuario = $this->getIdUsuario();
			
			$sql = "CALL spDeleteUser($idUsuario)";
			
			if ( $this->link->query( $sql ) )  // true if success
				//$this->link->affected_rows;  number of deleted rows
			{
				return "borrado.Num de deletes: " . $this->link->affected_rows;
			} else {
				return "Error al borrar";
			}
			$this->CloseConnect();
		}
		
		public function objVars() {
			
			return get_object_vars( $this );
		}
		
	}
