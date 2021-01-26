<?php
class productoClass{
    protected $idProducto;
    protected $nombreProducto;
    protected $descripcion;
    protected $foto;
    protected $tipo;
    /**
     * @return mixed
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * @return mixed
     */
    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $idProducto
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    /**
     * @param mixed $nombreProducto
     */
    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    
}