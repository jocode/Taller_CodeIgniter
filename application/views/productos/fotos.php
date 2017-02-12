<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>productos/listado/<?php echo $pagina; ?>">Listado de productos</a></li>
		<li class="active">Agregar fotos Producto</li>
	</ol>
	<div class="panel panel-primary">
		<div class="panel-heading">Agregar Fotos Producto (<?php echo $datos->nombre; ?>)</div>
		<div class="panel-body">
	        <?php if($this->session->flashdata('mensaje') != ''){ ?>
			<div class="alert alert-<?php echo $this->session->flashdata('css'); ?> text-center">
				<?php echo $this->session->flashdata('mensaje'); ?>
			</div>
			<?php } ?>
			<div>
			<?php echo form_open_multipart(null, array("name"=>"form")); ?>
			<?php 
			$errors = validation_errors('<li>','</li>');
			if ($errors!=""){ ?>
			<div class="alert alert-danger">
				<ul>
					<?php echo $errors; ?>
				</ul>
			</div>
			<?php	} ?>	
			<p>
				<label for="file">Foto:</label>
				<input type="file" name="file">
				<!-- 
				Para subir varios archivos
				<input type="file" name="file[]" multiple="true"/> -->
			</p>
			<hr>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
			<input type="submit" name="enviar" value="Subir" class="btn btn-default">
			<?php echo form_close(); ?>
			<hr>
			</div>
			<!--fotos-->
			<div class="row">
				<?php foreach ($fotos as $foto) { ?>
				<div class="col-xs-6 col-md-3">
						<img src="<?php echo base_url(); ?>public/uploads/productos/<?php echo $foto->foto; ?>" alt=""  class="thumbnail" width="100" heigth="100"/>
				</div>
				<?php } ?>
			</div>
			<!--/fotos-->
		</div>
	</div>
</div>