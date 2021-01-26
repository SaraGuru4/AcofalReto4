<?php
class escaparateClass{
    protected $idTipo;
    protected $nombre;
    protected $foto;
    /**
     * @return mixed
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $idTipo
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    
}