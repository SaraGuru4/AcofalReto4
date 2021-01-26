<?php
	
	
	class tiendaClass {
		protected $idTienda;
		protected $idUsuario;
		protected $nombreTienda;
		protected $direccion;
		protected $telefono;
		protected $logo;
		protected $foto;
		protected $texto;
		protected $idTipo;
		protected $tipoWeb;
		
		/**
         * @return mixed
         */
        public function getTexto()
        {
            return $this->texto;
        }
    
        /**
         * @param mixed $texto
         */
        public function setTexto($texto)
        {
            $this->texto = $texto;
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
		public function getNombreTienda() {
			return $this->nombreTienda;
		}
		
		/**
		 * @param mixed $nombreTienda
		 */
		public function setNombreTienda( $nombreTienda ) {
			$this->nombreTienda = $nombreTienda;
		}
		
		/**
		 * @return mixed
		 */
		public function getDireccion() {
			return $this->direccion;
		}
		
		/**
		 * @param mixed $direccion
		 */
		public function setDireccion( $direccion ) {
			$this->direccion = $direccion;
		}
		
		/**
		 * @return mixed
		 */
		public function getTelefono() {
			return $this->telefono;
		}
		
		/**
		 * @param mixed $telefono
		 */
		public function setTelefono( $telefono ) {
			$this->telefono = $telefono;
		}
		
		/**
		 * @return mixed
		 */
		public function getLogo() {
			return $this->logo;
		}
		
		/**
		 * @param mixed $logo
		 */
		public function setLogo( $logo ) {
			$this->logo = $logo;
		}
		
		/**
		 * @return mixed
		 */
		public function getFoto() {
			return $this->foto;
		}
		
		/**
		 * @param mixed $foto
		 */
		public function setFoto( $foto ) {
			$this->foto = $foto;
		}
		
		/**
		 * @return mixed
		 */
		public function getIdTipo() {
			return $this->idTipo;
		}
		
		/**
		 * @param mixed $idTipo
		 */
		public function setIdTipo( $idTipo ) {
			$this->idTipo = $idTipo;
		}
		
		/**
		 * @return mixed
		 */
		public function getTipoWeb() {
			return $this->tipoWeb;
		}
		
		/**
		 * @param mixed $tipoWeb
		 */
		public function setTipoWeb( $tipoWeb ) {
			$this->tipoWeb = $tipoWeb;
		}
	}