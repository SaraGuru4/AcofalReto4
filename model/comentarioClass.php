<?php
class comentarioClass
{

    protected $idComentario;
    protected $titulo;
    protected $texto;


    public function getIdComentario()
    {
        return $this->idComentario;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }


    public function getTexto()
    {
        return $this->texto;
    }

    public function setIdComentario($idComentario)
    {
        $this->idComentario = $idComentario;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }
}
