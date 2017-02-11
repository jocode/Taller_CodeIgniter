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
		$por_pagina = 1;

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

	public function delete($id=null){
		if(!id){show_404();}
		$datos = $this->productos_model->getAllById($id);
		if(sizeof($datos)==0){show_404();}
		$this->productos_model->delete($id);

		$this->session->set_flashdata('css', 'success');
		$this->session->set_flashdata('mensaje','El Registro se ha eliminado exitosamente');

		redirect(base_url().'productos');
	}
	
}
