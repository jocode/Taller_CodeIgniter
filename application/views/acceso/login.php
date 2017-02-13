<div class="container">
    <?php 
    # Mensajes de flash data
    if($this->session->flashdata('mensaje')!=''){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('css'); ?>">
			<?php echo $this->session->flashdata('mensaje'); ?>
		</div>
    <?php } ?>
    

	<?php
	# Errores de validacion 
	$errors = validation_errors('<li>','</li>');
	if($errors!=''){ ?>
		<div class="alert alert-danger">
			<ul>
				<?php echo $errors; ?>
			</ul>
		</div>
	<?php } ?>
	<?php echo form_open(null, array('name'=>'form')); ?>
	<p>
		<label for="correo">Email</label>
		<input type="email" name="correo" class="form-control" autofocus="true" value="<?php  echo set_value_input(array(), 'correo', 'correo');  ?>" />
		<label for="pass">Contraseña</label>
		<input type="password" name="pass" class="form-control" value="<?php echo set_value_input(array(), 'pass', 'pass') ?>" />
		<hr/>
		<input type="submit" name="btnEnviar" value="Enviar" class="btn btn-default"/>
	</p>
<?php echo form_close(); ?>
</div>