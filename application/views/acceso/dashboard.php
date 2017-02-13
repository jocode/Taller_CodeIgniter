<div class="container">
	<h3 class="text-center">Hola <?php echo $this->session->userdata('nombre'); ?> ñandú</h3>
	<p>
		<a href="<?php echo base_url(); ?>acceso/salir" title="">Salir</a>
	</p>
</div>