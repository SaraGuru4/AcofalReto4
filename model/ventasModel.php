<?php
	
	require_once 'connect_data.php';
	require_once 'ventasClass.php';
	
	class ventasModel extends ventasClass {
		private $link;
		
		private function OpenConnect() {
			$konDat = new connect_data();
			try {
				$this->link = new mysqli( $konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname );
			} catch ( Exception $e ) {
				echo $e->getMessage();
			}
			$this->link->set_charset( "utf8" );
		}
		
		private function CloseConnect() {
			mysqli_close( $this->link );
		}
		
		public function ObjVars() {
			unset($this->link);
			return get_object_vars( $this );
		}
		
		// MÉTODOS
		
		public function addVenta() {
			$this->OpenConnect();
			
			$idUsuario = $this->getIdUsuario();
			$idProducto = $this->getIdProducto();
			$idTienda = $this->getIdTienda();
			$subtotal = $this->getPrecio();
			$cantidad = $this->getCantidad();
			
			$sql = "CALL spVenta( '$idUsuario', '$idProducto', '$idTienda', '$subtotal', '$cantidad' )";
			
			
			if ( $this->link->query( $sql ) ) return true;
			else return false;
		}
	}