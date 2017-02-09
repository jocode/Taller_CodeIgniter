<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Archivo frontend</title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<!-- href="<?php echo base_url(); ?>public/css/bootstrap.min.css;" -->
</head>
<body>
	<h1>Título desde el Frontend</h1>
	<p>Frontend carga en todas las vistas, es común para todo, y este archivo es el encargado de cargar las vistas de los controladores</p>
	<!--contenido-->
	<?php echo $content_for_layout;?>
	<!--/contenido-->
</body>
<footer>
	<p>Página renderizada en <strong>{elapsed_time}</strong> segundos. Uso de memoria <strong>{memory_usage}</strong></p>
</footer>
</html>