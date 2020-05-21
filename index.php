<?php
	include("php/CGenerales.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Videos</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="css/bootstrap.4.1.0.min.css" rel="stylesheet"/>
	<link href="css/jquery-ui.css" rel="stylesheet"/>
</head>
<body>

	<div class="container">
			<br>
			<br>
			<br>
			<br>
			<div id="Mensaje"></div>
		<div class="row border">

			<form class="form" method="post"  enctype="multipart/form-data">
			<div class="col-md-4">
		       <label> Archivo </label>
			</div>
			<div class="col-md-4">
		       <input class="file" type="file" name="file" id="file" required="required" />
			</div>
			<div class="col-md-4">
		      <!--  <button type="button" class="btn btn-success" id="btnSubirArchivo">Subir Video</button> -->
			</div>
		    </form>
		</div>
		<div class="row border">
			<table id="tabla" class="table table-sm  estiloTabla">
				<thead class="thead-light">
					<tr class="bg-secondary">
						<th class="text-center" scope="col">#</th>
						<th class="text-center" scope="col">FOLIO</th>
						<th class="text-center" scope="col">Video</th>
					</tr>
				</thead>
				<tbody id="Contenido">
					<!-- llenado de tabla -->
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-4"><button class="btn btn-success" id="btnDescargaVideos">descargar</button></div>
			<div class="col-md-4"><p id="info"></p></div>
		</div>
		<div class="row">	
				<?php 	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/SpringREST/cadenas");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    echo $res;
    curl_close($ch);
				 ?>
		</div>
	</div>
</body>
	<script type="text/javascript" src="js/jquery3.3.1.js" language="javascript"></script>
	<script src="js/bootstrap.4.1.1min.js" language="javascript"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/pruebaArchivo.js"></script>
	<script src="js/jquery.blockUI.js"></script>
</html> 	
