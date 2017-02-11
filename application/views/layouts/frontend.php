<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Archivo frontend</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
</head>
<body>
	<h1 class="text-center">Clase 7</h1>
	<p class="text-center">Paginación de Registros. <br>
	En esta ocasión, aprenderemos a trabajar con la librería pagination, en donde aprenderemos a configurar sus parámetros base_url, total_rows, per_page, uri_segment, num_links, first_link, next_link, prev_link, last_link, full_tag_open, first_tag_open, first_tag_close, last_tag_open, last_tag_close, next_tag_open, next_tag_close, prev_tag_open, prev_tag_close, cur_tag_open, cur_tag_close, num_tag_open y num_tag_close.
	</p>
	<!--contenido-->
	<?php echo $content_for_layout;?>
	<!--/contenido-->
	<script src="<?php echo base_url(); ?>public/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/js/funciones.js" type="text/javascript"></script>
</body>
<footer class="text-center">
	&copy Todos los derechos reservados.
</footer>
</html>