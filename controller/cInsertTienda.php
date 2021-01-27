<?php

include_once ("../model/productoModel.php");

$data=json_decode(file_get_contents("php://input"),true);

$nombre=$data['nombre'];
$direccion=$data['direccion'];
$descripcion=$data['descripcion'];
$imagen=$data['imagen'];

$filename=$data['filename'];
$savedFileBase64=$data['savedFileBase64'];

$nuevoProducto=new productoModel();


$nuevoProducto->setNombreProducto($nombre);
$nuevoProducto->setDireccion($direccion);
$nuevoProducto->setDescripcion($descripcion);

$nuevoProducto->setFoto($imagen);

$response=array();

$response['error']=$nuevaTienda->insertProducto(); 

if($savedFileBase64 != ""){


$fileBase64 = explode(',', $savedFileBase64)[1]; //parte dcha de la coma


$file = base64_decode($fileBase64);

/*Se especifica el directorio donde se almacenarán los ficheros(se crea si no existe)*/
$writable_dir = '../view/img/escaparate';
if(!is_dir($writable_dir)){mkdir($writable_dir);}

//Se escribe el archivo
file_put_contents($writable_dir.$filename, $file,  LOCK_EX);

}

echo json_encode($response);

unset ($nuevaTienda);
