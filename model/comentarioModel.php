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
	include_once 'comentarioClass.php';
	include_once 'comentarioModel.php';
	
	
	class comentarioModel extends comentarioClass {
		
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
		
		public function setListComments() {
			$this->OpenConnect();
			
			$sql = "call spAllComentarios()";
			
			$list = array();
			
			$result = $this->link->query( $sql );
			
			while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
				
				$newComment = new comentarioModel();
				$newComment->idComentario = $row[ 'idComentario' ];
				$newComment->titulo = $row[ 'titulo' ];
				$newComment->texto = $row[ 'texto' ];
				
				array_push( $list, get_object_vars( $newComment ) );
			}
			mysqli_free_result( $result );
			$this->CloseConnect();
			return ( $list );
		}
		
		public function insertComentario() {
			$this->OpenConnect();
			
			$titulo = $this->getTitulo();
			$texto = $this->getTexto();
			
			$sql = "CALL cInsertComment('$titulo','$texto')";
			
			if ( $this->link->query( $sql ) ) {
				$this->CloseConnect();
				return true;
				
			} else {
				$this->CloseConnect();
				return false;
			}
		}
		
		public function deleteComentario() {
			
			$this->OpenConnect();  // konexio zabaldu  - abrir conexión
			
			$idComentario = $this->getIdComentario();
			
			$sql = "CALL spDeleteComentario($idComentario)";
			
			if ( $this->link->query( $sql ) )  // true if success
			
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
