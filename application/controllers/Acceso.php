<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout("frontend");
	}
	
	public function index(){
		$this->layout->view('index');
	}

	public function login(){
		if($this->input->post()){
			if($this->form_validation->run('login')){
				# Crear y referenciar un método para preguntar si los datos ingresados por el usuario existen en la BD
				$datos = $this->usuarios_model->getLogin($this->input->post('correo', true), sha1($this->input->post('pass', true)));
				# Crear una condicióon para validar lo anterior
				if(count($datos)==0){
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje','El usuario no está registrado.');
					redirect(base_url().'acceso/login');
				} else {
					# Darle un nombre al array general de sesiones
					$this->session->set_userdata('sesion_user');

					# Asignamos los datos a cada sesion por separado
					/**
					* Uno se crea al menos 3 sesiones por aplicación
					* - La que almacena el id del usuario
					* - Nombre del usuario
					* - El perfil o rol del usuario

					* Siempre saludar al usuario cuando ingrese a la aplicación
					*/
					$this->session->set_userdata('id', $datos->id);
					$this->session->set_userdata('nombre', $datos->nombre);

					#Redireccionamos a la url principal de los contenidos restringidos
					redirect(base_url().'acceso/dashboard');
				}

			}
		}
		$this->layout->view('login');
	}

	public function dashboard(){
		if($this->session->userdata('id')){
            $this->layout->view('dashboard');
		} else {
			redirect(base_url().'acceso/login');
		}
	}

	public function salir(){
		$this->session->sess_destroy('sesion_user');
		$this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','Has cerrado la sesion.');

		redirect(base_url().'acceso/login');
	}
}
