<?php
	
	
	class ventasClass {
		protected $idVenta;
		protected $idUsuario;
		protected $idProducto;
		protected $idTienda;
		protected $precio;
		protected $fecha;
		protected $cantidad;
		protected $subTotal;
		
		/**
		 * @return mixed
		 */
		public function getIdVenta() {
			return $this->idVenta;
		}
		
		/**
		 * @param mixed $idVenta
		 */
		public function setIdVenta( $idVenta ) {
			$this->idVenta = $idVenta;
		}
		
		/**
		 * @return mixed
		 */
		public function getIdUsuario() {
			return $this->idUsuario;
		}
		
		/**
		 * @param mixed $idUsuario
		 */
		public function setIdUsuario( $idUsuario ) {
			$this->idUsuario = $idUsuario;
		}
		
		/**
		 * @return mixed
		 */
		public function getIdProducto() {
			return $this->idProducto;
		}
		
		/**
		 * @param mixed $idProducto
		 */
		public function setIdProducto( $idProducto ) {
			$this->idProducto = $idProducto;
		}
		
		/**
		 * @return mixed
		 */
		public function getIdTienda() {
			return $this->idTienda;
		}
		
		/**
		 * @param mixed $idTienda
		 */
		public function setIdTienda( $idTienda ) {
			$this->idTienda = $idTienda;
		}
		
		/**
		 * @return mixed
		 */
		public function getPrecio() {
			return $this->precio;
		}
		
		/**
		 * @param mixed $precio
		 */
		public function setPrecio( $precio ) {
			$this->precio = $precio;
		}
		
		/**
		 * @return mixed
		 */
		public function getFecha() {
			return $this->fecha;
		}
		
		/**
		 * @param mixed $fecha
		 */
		public function setFecha( $fecha ) {
			$this->fecha = $fecha;
		}
		
		/**
		 * @return mixed
		 */
		public function getCantidad() {
			return $this->cantidad;
		}
		
		/**
		 * @param mixed $cantidad
		 */
		public function setCantidad( $cantidad ) {
			$this->cantidad = $cantidad;
		}
		
		/**
		 * @return mixed
		 */
		public function getSubTotal() {
			return $this->subTotal;
		}
		
		/**
		 * @param mixed $subTotal
		 */
		public function setSubTotal( $subTotal ) {
			$this->subTotal = $subTotal;
		}
		
	}