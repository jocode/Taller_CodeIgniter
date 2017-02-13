<div class="container">
	<div class="panel-primary">
		<div class="panel-heading">Listado de productos (<?php echo $cuantos; ?> registros)</div>
		<div class="panel-body">
			<?php if($this->session->flashdata('mensaje') != ''){ ?>
			<div class="alert alert-<?php echo $this->session->flashdata('css'); ?> text-center">
				<?php echo $this->session->flashdata('mensaje'); ?>
			</div>
			<?php } ?>
			<p class="pull-right">
				<a href="<?php echo base_url(); ?>productos/pdf" target="_black" class="btn btn-danger"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Exportar a PDF</a>
				<a href="<?php echo base_url(); ?>productos/excel" target="_black" class="btn btn-success"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Exportar a Excel</a>
			</p>
			<p>
				<a class="btn btn-success" href="<?php echo base_url(); ?>productos/add" title="Agregar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar</a>
				<table class="table table-bordered table-sprited table-hover text-center">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Stock</th>
							<th>Fecha</th>
							<th>Fotos</th>
							<th>Acciones</th>
						</tr>
					</thead>	
					<tbody>
						<?php 
						foreach ($datos as $dato) { ?>
						<tr>
							<td><?php echo $dato->id; ?></td>
							<td><?php echo $dato->nombre; ?></td>
							<td><?php echo number_format($dato->precio, 0, '', '.'); ?></td>
							<td><?php echo $dato->stock; ?></td>
							<td><?php echo fecha($dato->fecha); ?></td>
							<td>
								<a href="<?php echo base_url(); ?>productos/fotos_multiples/<?php echo $dato->id; ?>/<?php echo $pagina; ?>"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
							</td>
							<td>
								<a href="<?php echo base_url(); ?>productos/edit/<?php echo $dato->id; ?>/<?php echo $pagina; ?>" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url(); ?>productos/delete/<?php echo $dato->id; ?>');" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<nav aria-label="Page navigation"><?php echo $this->pagination->create_links(); ?>
				</nav>
			</p>
		</div>
	</div>
</div>