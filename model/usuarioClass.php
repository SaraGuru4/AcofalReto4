<?php
	
	class usuarioClass {
		
		protected $idUsuario;
		protected $nombreUsuario;
		protected $apellidos;
		protected $correo;
		protected $password;
		protected $admin;
		
		/**
		 * @return mixed
		 */
		public function getIdUsuario() {
			return $this->idUsuario;
		}
		
		/**
		 * @return mixed
		 */
		public function getNombreUsuario() {
			return $this->nombreUsuario;
		}
		
		/**
		 * @return mixed
		 */
		public function getApellidos() {
			return $this->apellidos;
		}
		
		/**
		 * @return mixed
		 */
		public function getCorreo() {
			return $this->correo;
		}
		
		/**
		 * @return mixed
		 */
		public function getPassword() {
			return $this->password;
		}
		
		/**
		 * @return mixed
		 */
		public function getAdmin() {
			return $this->admin;
		}
		
		
		/**
		 * @param mixed $id
		 */
		public function setIdUsuario( $idUsuario ) {
			$this->idUsuario = $idUsuario;
		}
		
		public function setNombreUsuario( $nombreUsuario ) {
			$this->nombreUsuario = $nombreUsuario;
		}
		
		/**
		 * @param mixed $apellidos
		 */
		public function setApellidos( $apellidos ) {
			$this->apellidos = $apellidos;
		}
		
		/**
		 * @param mixed $usuario
		 */
		public function setCorreo( $correo ) {
			$this->correo = $correo;
		}
		
		/**
		 * @param mixed $password
		 */
		public function setPassword( $password ) {
			$this->password = $password;
		}
		
		
		/**
		 * @param mixed $admin
		 */
		public function setAdmin( $admin ) {
			$this->admin = $admin;
		}
	}
