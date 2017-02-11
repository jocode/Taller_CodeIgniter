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
		$datos = $this->productos_model->getAll();
		$this->layout->view('listado', compact("datos"));
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

	public function edit($id=null){
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

		$this->layout->view('edit', compact('datos','id'));
	}

	public function delete($id=null){
		if(!id){show_404();}
		$datos = $this->productos_model->getAllById($id);
		if(sizeof($datos)==0){show_404();}
		$this->productos_model->delete($id);

		$this->session->set_flashdata('css', 'success');
		$this->session->set_flashdata('mensaje', 'El Registro se ha eliminado exitosamente');

		redirect(base_url().'productos');
	}
	
}
