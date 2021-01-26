<?php
	
	include_once ('../model/escaparateModel.php');
	
	$modeloEscaparate = new escaparateModel();
	
	$response['answer'] = $modeloEscaparate->tipoTienda();
	
	echo json_encode($response);
	
	unset($response);