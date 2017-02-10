<div class="container">
	<div class="panel-primary">
		<div class="panel-heading">Formulario</div>
		<div class="panel-body">
			<!-- Con la llamada a estos métodos, el framework automaticamente le crea un formulario con el action apuntando al controlador, el charset y el método -->
			<?php echo form_open(null, array("class"=>"form-horizontal", "name"=>"form")); ?>
			
			<?php
                //acá visualizamos los mensajes de error
			$errors=validation_errors('<li>','</li>');
			if($errors!="")
			{
				?>
				<div class="alert alert-danger">
					<ul>
						<?php echo $errors;?>
					</ul>
				</div>
				<?php
			}
			?>

			<h3>Ingresa tus datos</h3>
			<p><label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="<?php echo set_value_input(array(), 'nombre', 'nombre'); ?>"/>
			</p>
			<p><label for="correo">E-Mail</label>
				<input type="email" name="correo" class="form-control" value="<?php echo set_value_input(array(), 'correo', 'correo'); ?>"/></p>
			<p><label for="telefono">Teléfono</label>
				<input type="number" name="telefono" class="form-control" value="<?php echo set_value_input(array(), 'telefono', 'telefono'); ?>"/>
			</p>
			<input type="submit" name="enviar" value="Enviar" class="btn btn-default">
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>