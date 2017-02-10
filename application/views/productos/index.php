<div class="container">
	<div class="panel-primary">
		<div class="panel-heading">Listado de productos</div>
		<div class="panel-body">
			<p>
				<a class="btn btn-success" href="<?php echo base_url(); ?>productos/add" title="Agregar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar</a>
				<table class="table table-bordered table-sprited table-hover">
					<thead>
						<tr>
                           <th>ID</th>
                           <th>Nombre</th>
                           <th>Precio</th>
                           <th>Stock</th>
                           <th>Fecha</th>
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
									<td class="text-center">
										<a href="<?php echo base_url(); ?>productos/edit/<?php echo $dato->id; ?>" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
										<a href="<?php echo base_url(); ?>productos/delete/<?php echo $dato->id; ?>" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>
			</p>
		</div>
	</div>
</div>