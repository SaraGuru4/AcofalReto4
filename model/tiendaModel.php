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
	
	require_once 'tiendaClass.php';
	require_once 'escaparateModel.php';
	
	class tiendaModel extends tiendaClass {
		
		private $link;
		private $objEscaparate;
		
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
		
		
		public function getByIdTipo(){
		    $this->OpenConnect();
		    $idTipo= $this->getIdTipo();
		    
		    $sql = "CALL spGetTiendasByIdTipo($idTipo)";
		    $result= $this->link->query($sql);
		    
		    $list=array();
		    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		    {
		        $new= new tiendaModel();
		        $new->idTienda=$row['idTienda'];
		        $new->idUsuario=$row['idUsuario'];
		        $new->nombreTienda=$row['nombreTienda'];
		        $new->direccion=$row['direccion'];
		        $new->telefono=$row['telefono'];
		        $new->logo=$row['logo'];
		        $new->foto=$row['foto'];
		        $new->texto=$row['texto'];
		        $new->idTipo=$row['idTipo'];
		        $new->tipoWeb=$row['tipoWeb'];
		        array_push($list, get_object_vars($new));
		    }
		    mysqli_free_result($result);
		    $this->CloseConnect();
		    return $list;
		}
		
		public function getById(){
		    $this->OpenConnect();
		    $idTienda= $this->getIdTienda();
		    
		    $sql = "CALL spGetTiendaById($idTienda)";
		    $result= $this->link->query($sql);
		    
		    $list=array();
		    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		    {
		        $new= new tiendaModel();
		        $new->idTienda=$row['idTienda'];
		        $new->idUsuario=$row['idUsuario'];
		        $new->nombreTienda=$row['nombreTienda'];
		        $new->direccion=$row['direccion'];
		        $new->telefono=$row['telefono'];
		        $new->logo=$row['logo'];
		        $new->foto=$row['foto'];
		        $new->texto=$row['texto'];
		        $new->idTipo=$row['idTipo'];
				$new->tipoWeb=$row['tipoWeb'];
				
				$tipoTienda=new escaparateModel();
            
				$tipoTienda->setIdTipo($row['idTipo']);
				$tipoTienda->findTipoTiendaByIdTipo();
				
				$new->objEscaparate=$tipoTienda->objVars();
		        array_push($list, get_object_vars($new));
		    }
		    mysqli_free_result($result);
		    $this->CloseConnect();
		    return $list;
		}


		public function setListTiendas()
	{
		$this->OpenConnect();

		$sql = "call spAllTiendas()";

		$list = array();

		$result = $this->link->query($sql);

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			$new = new tiendaModel();
			$new->idTienda = $row['idTienda'];
			$new->idUsuario = $row['idUsuario'];
			$new->nombreTienda = $row['nombreTienda'];
			$new->direccion = $row['direccion'];
			$new->telefono = $row['telefono'];
			$new->logo = $row['logo'];
			$new->foto = $row['foto'];
			$new->texto = $row['texto'];
			$new->idTipo = $row['idTipo'];
			$new->tipoWeb = $row['tipoWeb'];
			
			array_push($list, get_object_vars($new));
		}
		mysqli_free_result($result);
		$this->CloseConnect();
		return ($list);
	}

	public function insertTienda()
	{
		$this->OpenConnect();

		$idUsuario = $this->getIdUsuario();
		$nombre = $this->getNombreTienda();
		$direccion =  $this->getDireccion();
		$telefono = $this->getTelefono();
		$texto = $this->getTexto();
		$tipo = $this->getIdTipo();
		$imagen = $this->getFoto();
		$tipoWeb = $this->getTipoWeb();

		$sql = "CALL spInsertTienda( '$idUsuario', '$nombre','$direccion','$telefono', '$imagen', '$texto', '$tipo', '$tipoWeb')";

		if ($this->link->query($sql)) {
			$returnString = "Tienda insertada correctamente";
			$this->CloseConnect();
			return $returnString;
		} else {
			$this->CloseConnect();
			return $sql . "Error al insertar";
		}
	}


	public function deleteTienda()
    {

        $this->OpenConnect();  // konexio zabaldu  - abrir conexión

        $idTienda = $this->getIdTienda();
	
        $sql = "CALL spDeleteShop($idTienda)";

        if ($this->link->query($sql))  // true if success 
        //$this->link->affected_rows;  number of deleted rows
        {
            return "borrado.Num de deletes: " . $this->link->affected_rows;
        } else {
            return "Error al borrar";
        }
        $this->CloseConnect();
    }
		public function objVars(){
		    
		    return get_object_vars($this);
		}
		
	}