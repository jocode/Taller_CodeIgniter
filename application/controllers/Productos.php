<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("frontend");
	}
	
	public function index(){
		$datos = $this->productos_model->getAll();
		//print_r($datos); exit;
		$this->layout->view('index', compact("datos"));
	}

	public function listado(){

		// Zona de configuración inicial de la paginacion
		if($this->uri->segment(3)){
			$pagina = $this->uri->segment(3);
		} else {
			$pagina = 0;
		}
		$por_pagina = 10;

		// Zona de carga de datos
		$datos = $this->productos_model->getAllPagination($pagina, $por_pagina, "limit");
		$cuantos = $this->productos_model->getAllPagination($pagina, $por_pagina,"cuantos");
		
		// Zona de configuración de la librería pagination
		$config['base_url']= base_url()."productos/listado";
		$config['total_rows'] = $cuantos;
		$config['per_page'] = $por_pagina;
		/*Definir el uri_sergment directamente como string, porque al pasarlo por la variable no toma el diseño correcto en la vista*/
		$config['uri_segment'] = '3';
		/* Define la cantidad de numeros a mostrar, y se incrementan en base al cambio de página */
		$config['num_links'] = '5';

		/* Personalización de los links de navegación */
		$config['first_link'] = 'Primero';
		$config['last_link'] = 'Último';
		$config['next_link'] = 'Siguiente';
		$config['prev_link'] = 'Anterior';

		/*Definir estilos de los tags para los links*/
		$config['full_tag_open'] = '<ul class="pagination">';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['full_tag_close'] = '</ul>';

		$this->pagination->initialize($config);

		$this->layout->view('listado', compact("datos", "cuantos", "pagina"));
	}

	public function add(){
		if($this->input->post()){
			if($this->form_validation->run('add_producto')){
				$data = array(
					'nombre'=>$this->input->post('nombre', true),
					'precio'=>$this->input->post('precio', true),
					'stock'=>$this->input->post('stock', true),
					'fecha'=>date('Y-m-d'),
					);
				$insertar = $this->productos_model->insertar($data);
				//echo $insertar; exit;

				/*Configuramos cookies de un segundo para mostrar el mensaje de la operación*/
				$this->session->set_flashdata('css', 'success');
				$this->session->set_flashdata('mensaje', 'El Registro se ha creado exitosamente');

				/*Redireccionar al usuario al listado de productos*/
				redirect(base_url().'productos');
			}
		}
		$this->layout->view('add');
	}

	public function edit($id=null, $pagina = null){
		/*Si no vienen parámetros, mostrar error 404*/
		if(!$id){show_404();}
		$datos = $this->productos_model->getAllById($id);
		/*Si no hay informacion relacionada con ese id, mostrar error 404*/
		if(sizeof($datos)==0){show_404();}

		if ($this->input->post()){
			if ($this->form_validation->run('add_producto')){
				$data = array(
					'nombre'=>$this->input->post('nombre', true),
					'precio'=>$this->input->post('precio', true),
					'stock'=>$this->input->post('stock', true),
					);

				$this->productos_model->update($data, $this->input->post('id', true));

				$this->session->set_flashdata('css', 'success');
				$this->session->set_flashdata('mensaje', 'El Registro se ha modificado exitosamente');

				redirect(base_url().'productos');
			}
		}

		$this->layout->view('edit', compact('datos','id','pagina'));
	}

	public function fotos($id=null, $pagina=null){
		if(!$id){show_404();}
		$datos = $this->productos_model->getAllById($id);
		if(sizeof($datos)==0){show_404();}

		if($this->input->post()){
			/*Debo crear el callback para validar el tipo de archivo*/
			/*Subimos el archivo*/
			$config['upload_path'] = './public/uploads/productos';
			$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
			/*$config['max_size']     = '100'; # Tamaño máximo en bytes
			$config['max_width'] = '1024';
			$config['max_height'] = '768'; */
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
			}

			/*Obtenemos en nombre del archivo*/
			$imagen = $this->upload->data();
			$file_name = $imagen['file_name'];

			/*Generamos el insert en la tabla respectiva*/
			/* el true en el método post() es para evitar el filtro xss*/
			$data = array(
				"id_producto"=>$this->input->post('id', true),
				"foto"=>$file_name,
				);
			$this->productos_model->insertarFoto($data);

			$this->session->set_flashdata('css', 'success');
			$this->session->set_flashdata('mensaje','El Registro se ha insertado exitosamente');

			redirect(base_url().'productos/fotos/'.$this->input->post('id').'/'.$this->input->post('pagina'));
		}

		$fotos = $this->productos_model->getFotosById($id);
		$this->layout->view('fotos', compact('datos','id','pagina', 'fotos'));
	}

	public function fotos_multiples($id=null, $pagina=null){
		if(!$id){show_404();}
		$datos = $this->productos_model->getAllById($id);
		if(sizeof($datos)==0){show_404();}

		if($this->input->post()){

			$total = count($_FILES['file']['name']);

			for($i=0; $i<$total; $i++){
				#print_r($_FILES['file']['type'][$i]);
				switch ($_FILES['file']['type'][$i]) {
					#Case para el formato mimetype
					case 'image/jpeg':
						// Insertamos el registro con la foto vacía
					$data = array(
						"id_producto"=>$this->input->post('id', true),
						"foto"=>'',
						);
					$valor = $this->productos_model->insertarFoto($data);
						// Subimos la foto
					$foto = 'foto_'.$this->input->post('id',true).'_'.$valor.'.jpg';
					copy($_FILES['file']['tmp_name'][$i],"public/uploads/productos/".$foto);
						//Actualizamos el registro con el nombre de la foto
					$data1=array
					(
						"foto"=>$foto,
						);
					$this->productos_model->updateFoto($data1,$valor);

					break;
					case 'image/png':
					$data = array(
						"id_producto"=>$this->input->post('id', true),
						"foto"=>'',
						);
					$valor = $this->productos_model->insertarFoto($data);
					$foto = 'foto_'.$this->input->post('id',true).'_'.$valor.'.png';
					copy($_FILES['file']['tmp_name'][$i],"public/uploads/productos/".$foto);
					$data1=array
					(
						"foto"=>$foto,
						);
					$this->productos_model->updateFoto($data1,$valor);
					break;
					
					default:
					$this->session->set_flashdata('css', 'danger');
					$this->session->set_flashdata('mensaje','El tipo de archivo no es correcto');

					redirect(base_url().'productos/fotos_multiples/'.$this->input->post('id').'/'.$this->input->post('pagina'));
					break;
				}
			}
			//Redireccionamos al usaurio a la vista respectiva
			$this->session->set_flashdata('css', 'success');
			$this->session->set_flashdata('mensaje','Se han agregado '.$i.' fotos exitosamente.');

			redirect(base_url().'productos/fotos_multiples/'.$this->input->post('id').'/'.$this->input->post('pagina'));
		}

		$fotos = $this->productos_model->getFotosById($id);
		$this->layout->view('fotos', compact('datos', 'id', 'fotos','pagina'));
	}

	public function fotos_delete($id_producto=null, $id_foto=null, $pagina=null){
		if(! ($id_producto or $id_foto)){show_404();}
		$datos = $this->productos_model->getAllById($id_producto);
		if(sizeof($datos)==0){show_404();}
		$foto = $this->productos_model->getFotoById($id_foto);
		if(count($foto)==0){show_404();}
		// Borrar la foto físicamente
		unlink('public/uploads/productos/'.$foto->foto);
		// Borar el registro de la base de 
		$this->productos_model->deleteFoto($id_foto);
		// Redireccionar al usuario
		$this->session->set_flashdata('css', 'success');
		$this->session->set_flashdata('mensaje','Se ha eliminado la foto exitosamente.');

		redirect(base_url().'productos/fotos_multiples/'.$id_producto.'/'.$pagina);
	}

	public function delete($id=null){
		if(!$id){show_404();}
		$datos = $this->productos_model->getAllById($id);
		if(sizeof($datos)==0){show_404();}
		$this->productos_model->delete($id);

		$this->session->set_flashdata('css', 'success');
		$this->session->set_flashdata('mensaje','El Registro se ha eliminado exitosamente');

		redirect(base_url().'productos');
	}

	/**
	* PDF
	**/
	public function pdf(){
		$datos = $this->productos_model->getAll();
		$html.= '<h1 class="text-center">Listado de productos</h1>';
		$html.= '
		<table class="table table-bordered table-sprited table-hover text-center">
			<thead align="center">
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Precio</th>
					<th class="text-center">Stock</th>
					<th class="text-center">Fecha</th>
				</tr>
			</thead>
			<tbody>';
	    #Construir la estructura dinámica del pdf
	    foreach ($datos as $dato) {
	    	$html.='
				<tr>
				   <td>'.$dato->id.'</td>
				   <td>'.$dato->nombre.'</td>
				   <td>'.number_format($dato->precio, 0, '', '.').'</td>
				   <td>'.$dato->stock.'</td>
				   <td>'.fecha($dato->fecha).'</td>
				</tr>
	    	';
	    }
				
		$html.='</tbody></table>';
		/*Agregar estilos al PDF*/
		$estilos=file_get_contents(base_url().'public/css/bootstrap.min.css');
        $this->mpdf->WriteHTML($estilos,1);
		$this->mpdf->WriteHTML($html);
		$this->mpdf->setDisplayMode('fullpage');
		$this->mpdf->Output();
		exit;
	}

}
