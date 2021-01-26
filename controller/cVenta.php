<?php
	
	include_once( '../model/stockModel.php' );
	include_once( '../model/ventasModel.php' );
	
	session_start();
	
	$data = json_decode( file_get_contents( 'php://input' ), true );
	
	$modeloStock = new stockModel();
	$modeloVenta = new ventasModel();
	
	$response = array();
	$response['stock']=array();
	$response['venta']=array();
	
	foreach ( $data as $tienda ) {
		
		$modeloVenta->setIdTienda( $tienda[ 'idTienda' ] );
		
		foreach ( $tienda[ 'productos' ] as $producto ) {
			
			$modeloStock->setIdStock( $producto[ 'idStock' ] );
			$modeloStock->setCantidad( $producto[ 'seleccionado' ] );
			
			if ( !$modeloStock->reducirStock() ) array_push( $response[ 'stock' ], "idStock: " . $producto[ 'idStock' ] . ", seleccionado: " . $producto[ 'seleccionado' ] );
			else {
				$modeloVenta->setIdUsuario( $_SESSION[ 'idUsuario' ] );
				$modeloVenta->setIdProducto( $producto[ 'idProducto' ] );
				
				$modeloVenta->setPrecio( $producto[ 'precio' ] );
				$modeloVenta->setCantidad( $producto[ 'seleccionado' ] );
				$modeloVenta->setSubTotal( number_format( $producto[ 'seleccionado' ] * $producto[ 'precio' ], 2 ) );
				
				if ( !$modeloVenta->addVenta() ) array_push( $response[ 'venta' ], "idUsuario: " . $_SESSION[ 'idUsuario' ] . ", idTienda: " . $tienda[ 'idTienda' ] . ", Producto: " . $producto[ 'idProducto' ] . ". Unidades: " . $producto[ 'seleccionado' ] );
			}
		}
		
	}
	
	echo json_encode( $response );