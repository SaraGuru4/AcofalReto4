<?php
	require_once 'connect_data.php';
	require_once 'stockClass.php';
	require_once 'productoModel.php';
	
	class stockModel extends stockClass {
		
		private $link;
		private $objProducto;
		
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
		
		public function objVars() {
			
			return get_object_vars( $this );
		}
		
		public function getStockByIdTienda() {
			$this->OpenConnect();
			$idTienda = $this->getIdTienda();
			
			$sql = "CALL spGetStockByIdTienda($idTienda)";
			$result = $this->link->query( $sql );
			
			$list = array();
			while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
				$new = new stockModel();
				$new->idStock = $row[ 'idStock' ];
				$new->idTienda = $row[ 'idTienda' ];
				$new->idProducto = $row[ 'idProducto' ];
				$new->precio = $row[ 'precio' ];
				$new->descuento = $row[ 'descuento' ];
				$new->cantidad = $row[ 'cantidad' ];
				
				//Buscar el objProducto y añadirlo
				$newProducto = new productoModel();
				$newProducto->setIdProducto( $row[ 'idProducto' ] );
				$newProducto->getProductoById();
				$new->objProducto = $newProducto->ObjVars();
				
				array_push( $list, get_object_vars( $new ) );
			}
			mysqli_free_result( $result );
			$this->CloseConnect();
			return $list;
		}
		
		public function reducirStock() {
			$this->OpenConnect();
			
			$idStock = $this->getIdStock();
			$cantidad = $this->getCantidad();
			
			$sql = "CALL spReducirStock( '$idStock', '$cantidad' )";
			
			if ( $this->link->query( $sql ) ) return true;
			else return  false;
		}
	}
