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
				
				//Buscar el objProducto y a�adirlo
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
			else return false;
		}
		
		public function insertStock() {
			$this->OpenConnect();
			
			$idTienda = $this->getIdTienda();
			$idProducto = $this->getIdProducto();
			$precio = $this->getPrecio();
			$descuento = $this->getDescuento();
			$cantidad = $this->getCantidad();
			
			$sql = "CALL spInsertStock($idTienda,$idProducto,$precio,$descuento,$cantidad)";
			
			if ( $this->link->query( $sql ) ) {
				$returnString = "Producto adquirido correctamente en su tienda";
				$this->CloseConnect();
				return $returnString;
			} else {
				$this->CloseConnect();
				return $sql . "Error al insertar";
			}
		}
		public function updateStock() {
		    $this->OpenConnect();
		    
		    $idStock = $this->getIdStock();
		    $precio = $this->getPrecio();
		    $descuento = $this->getDescuento();
		    $cantidad = $this->getCantidad();
		    
		    $sql = "CALL spUpdateStock($idStock,$precio,$descuento,$cantidad)";
		    
		    if ( $this->link->query( $sql ) ) {
		        $returnString = "Producto actualizado correctamente";
		        $this->CloseConnect();
		        return $returnString;
		    } else {
		        $this->CloseConnect();
		        return $sql . "Error al actualizar";
		    }
		}
		public function deleteStock(){
			$this->OpenConnect();
			
			$idStock = $this->getIdStock();
			
			$sql = "CALL spDeleteStock($idStock)";
			
			$returnString =  "Error al eliminar";
			
			if ( $this->link->query( $sql ) ) $returnString = "Producto eliminado correctamente";
			
			$this->CloseConnect();
			return $returnString;
		}
		//Update ver datos
		public function getStockByIdStock() {
		    $this->OpenConnect();
		    $idStock = $this->getIdStock();
		    
		    $sql = "CALL spGetStockByIdStock($idStock)";
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
		        
		        //Buscar el objProducto y a�adirlo
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
		
	}
