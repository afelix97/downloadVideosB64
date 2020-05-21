<?php
include_once ('CGenerales.php');
include_once ("JSON.php");
include_once("CLog.php");	
error_reporting(E_ERROR);
$objGn   = new CGenerales();
$json    = new Services_JSON();
$datos = array();

	if(isset($_POST['opcion']))
	{
		$opcion = $_POST['opcion'];
	}
	else if(isset($_GET['opcion']))
	{
		$opcion = $_GET['opcion'];
	}
	else
	{
		$opcion = 0;
	}
	if(isset($_POST['video']))
	{
		$sNombreVideo = $_POST['video'];
	}
	else if(isset($_GET['video']))
	{
		$sNombreVideo = $_GET['video'];
	}
	else
	{
		$sNombreVideo = '';
	}
	

	ini_set('memory_limit', '-1');
	set_time_limit(0);	
	//ESTAS DOS LINEAS ES PARA RESOLVER EL PROBLEMA DE LAS Ñ
	setlocale(LC_ALL,'es_ES'); 
	define("CHARSET", "iso-8859-1");
	
switch($opcion) 
{
	case 1:
		//Datos cargados manualmente
		 $datos = CGenerales::retornaDat();
		
		foreach ($datos as $arr)
		{

		$sNombreVideo = $arr['id'] . '_'. $arr['folio'];
		
	  	$datos = $objGn->GuardarVideo($arr['video'], $sNombreVideo);
		echo $arr['video'];
		}
		break;
	case 0:
		echo "Opcion Invalida: " . $opcion;
		break;
}
?>