<?php
include("../../../webconfig.php");
	include_once("CLog.php");	
	error_reporting(E_ERROR);
	define('RUTA_LOGX',	'/sysx/progs/log/pruebaVideo');	
class CGenerales
{	
	function retornaDat($cnxBd)
	{
		$datos[] = "";
		$cSql="SELECT keyx, folio, video FROM vidcatalogovideos LIMIT 5";
				
		foreach ($cnxBd->query($cSql) as $Resultado) 
		{
			$foliovideo = ["keyx" =>$Resultado['keyx'],"folio" => $Resultado['folio'], "video" =>$Resultado['video']];
			CLog::escribirLog("Datos Folio:".["id" =>$res['id'],"folio" => $res['folio'], "video" =>$res['video']]);
			$datos[] = $foliovideo;
		
		}
		return $datos;		
	}
	public function GuardarVideo($sVideoBase64, $sNombreVideo)
	{
		$datos 				      = "";
		$datos->respuesta		  = 0;
		$datos->mensaje 	      = "";
		$datos->info 	      = "";
		if ($sVideoBase64 != '') 
		{
			
		$RutaDestino = RUTA_DESTINO . $sNombreVideo . ".mov";
		$sVideo = base64_decode($sVideoBase64);

			//CLog::escribirLog("Inicia Guardado de Video".$sNombreVideo);
			//CLog::escribirLog("Ruta destino video =".$RutaDestino);
		
			if (file_put_contents($RutaDestino, $sVideo)) 
			{
				$datos->mensaje= '<h6 class="alert alert-success"> Video descargado correctamente. </h6>';
				$datos->respuesta = 1;
				$datos->info = $sVideoBase64;
			//	CLog::escribirLog("Video Guardado Correctamente, Nombre: ".$sNombreVideo . ".mov");
			}
			else
			{
				$datos->respuesta = 0;
				$datos->mensaje= '<h6 class="alert alert-danger"> Error al intentar descargar el video. </h6>';
				//CLog::escribirLog("Error al intentar descargar el video.".$sNombreVideo . ".mov");
			}
			
		}
		else
		{
			$datos->respuesta = 0;
			$datos->mensaje= '<h6 class="alert alert-danger"> No se encuentra video. </h6>';
			//CLog::escribirLog("No se encuentra video.");
		}

		return $datos;
	}
}
?> 
