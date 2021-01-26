<?php
class stockClass{
    
    protected $idStock;
    protected $idTienda;
    protected $idProducto;
    protected $precio;
    protected $descuento;
    protected $cantidad;
    /**
     * @return mixed
     */
    public function getIdStock()
    {
        return $this->idStock;
    }

    /**
     * @return mixed
     */
    public function getIdTienda()
    {
        return $this->idTienda;
    }

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
    public function getIdPrecio()
    {
        return $this->idPrecio;
    }

    /**
     * @return mixed
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $idStock
     */
    public function setIdStock($idStock)
    {
        $this->idStock = $idStock;
    }

    /**
     * @param mixed $idTienda
     */
    public function setIdTienda($idTienda)
    {
        $this->idTienda = $idTienda;
    }

    /**
     * @param mixed $idProducto
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    /**
     * @param mixed $idPrecio
     */
    public function setIdPrecio($idPrecio)
    {
        $this->idPrecio = $idPrecio;
    }

    /**
     * @param mixed $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    
    
}