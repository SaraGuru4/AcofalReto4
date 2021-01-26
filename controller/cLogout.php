<?php

//Destruye la sesion
session_start();
session_destroy();

$response=array();


echo json_encode($response);