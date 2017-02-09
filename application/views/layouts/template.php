<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Archivo frontend</title>
</head>
<body>
	<h1>Título desde Template</h1>
	<p>Aquí puede se crean los estilos y menús para todo el sitio</p>
	<!--contenido-->
	<?php echo $content_for_layout;?>
	<!--/contenido-->
</body>
<footer>
	<p>Página renderizada en <strong>{elapsed_time}</strong> segundos. Uso de memoria <strong>{memory_usage}</strong></p>
</footer>
</html>