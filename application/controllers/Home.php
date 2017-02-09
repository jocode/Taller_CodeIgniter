<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// Definir el archivo que utilizará la librería layout
		$this->layout->setLayout("frontend");
	}
	//localhost/home/index
	# servidor/controlador/metodo
	public function index()
	{
		$this->layout->view("index");
	}
	public function nosotros($id = null){
		// Pasar datos a la vista
		$texto = "Hola primera palabra";
		$arreglo = array("Buenas", "Chao", "Nos vemos");
		//Renderizar la vista
		$this->layout->view('nosotros', compact('id', 'texto', 'arreglo'));
	}

	public function contacto(){
		$this->layout->setLayout('template');
		$this->layout->view('contacto');
	}
}
