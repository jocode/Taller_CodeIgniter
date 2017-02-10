<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("frontend");
	}
	
	/* Métodos de la Estructura del Controlador */
	/*
		servidor/controlador/index
		servidor/controlador/add
		servidor/controlador/edit/1
		servidor/controlador/search
		servidor/controlador/delete/1
	*/

	public function add()
	{
		//Zona de procesamiento del formulario
		if($this->input->post()){
			if ($this->form_validation->run('add_formulario')){
				// Entra y procesa el formulario
				echo $this->input->post("nombre").'<br>';
				echo $this->input->post("correo").'<br>';
				echo $this->input->post("telefono").'<br>';
				echo $this->input->post("rut");

			}
		}
		//Zona de visualización del formulario
		$this->layout->view("add");
	}
	
}
