<?php
	require_once 'connect_data.php';
	require_once 'escaparateClass.php';
	
	class escaparateModel extends escaparateClass {
		
		private $link;
		
		public function OpenConnect() {
			$konDat = new connect_data();
			try {
				$this->link = new mysqli( $konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname );
			} catch ( Exception $e ) {
				echo $e->getMessage();
			}
			$this->link->set_charset( "utf8" );
		}
		
		public function CloseConnect() {
			mysqli_close( $this->link );
			
		}
		
		//Saca la lista
		public function tipoTienda() {
			$this->OpenConnect();
			
			$sql = "CALL spTipoTienda()";
			$result = $this->link->query( $sql );
			//var_dump($result);
			
			$list = array();
			while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
				$new = new escaparateModel();
				$new->id = $row[ 'idTipo' ];
				$new->foto = $row[ 'foto' ];
				$new->nombre = $row[ 'nombre' ];
				array_push( $list, get_object_vars( $new ) );
			}
			mysqli_free_result( $result );
			$this->CloseConnect();
			return $list;
		}
		
		public function getById() {
			$this->OpenConnect();
			$idTipo = $this->getIdTipo();
			
			$sql = "CALL spGetByIdTipo($idTipo)";
			$result = $this->link->query( $sql );
			//var_dump($result);
			
			$list = array();
			while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
				$new = new escaparateModel();
				$new->id = $row[ 'idTipo' ];
				$new->foto = $row[ 'foto' ];
				$new->nombre = $row[ 'nombre' ];
				array_push( $list, get_object_vars( $new ) );
			}
			mysqli_free_result( $result );
			$this->CloseConnect();
			return $list;
		}
		
		public function findTipoTiendaByIdTipo() {
			
			$this->OpenConnect();  // konexio zabaldu  - abrir conexión
			
			$idTipo = $this->idTipo;
			
			$sql = "CALL spGetByIdTipo($idTipo)"; // SQL sententzia - sentencia SQL
			
			$result = $this->link->query( $sql );
			
			
			$list = array();
			
			while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) { //each row
				
				$this->idTipo = $row[ 'idTipo' ];
				$this->nombre = $row[ 'nombre' ];
				$this->foto = $row[ 'foto' ];
				
			}
			mysqli_free_result( $result );
			$this->CloseConnect();
			return $list;
			
		}
		
		public function objVars() {
			
			return get_object_vars( $this );
		}
	}
