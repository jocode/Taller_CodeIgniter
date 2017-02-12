<?php 

class productos_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	/* Métodos de consultas a la base de datos
	* los que van a utilizar el active records
	* Active Record: Es una clase que pertenece a la clase DataBase, que te proporciona
	* una interfaz definida por métodos, mediante los cuales tu vas a parametrizar la      * construcción de las consultas SQL
	* La idea es que el framework, de acuerdo al driver definido, construye la consulta    * con el lenguaje SQL que utilice un motor de base de datos
	*/

	public function getAll(){
		$query = $this->db
		->select("id, nombre, precio, stock, fecha")
		->from("productos")
		->order_by("id","asc")
		->get();
	    // echo $this->db->last_query(); exit;
		/* result() -> Retorna un arreglo compuesto */
		return $query->result();
	}

	public function getAllById($id){
		$query = $this->db
		->select("id, nombre, precio, stock, fecha")
		->from("productos")
		->where(array("id"=>$id))
		->get();
	    /**
	    * Devuelve la consulta que ha construido el active record
	    * echo $this->db->last_query(); exit; */
	    /*  row() -> Retorna una única fila, en un arreglo con formato simple */
	    return $query->row();
	}


	public function insertar($data = array()){
		/* insert() -> recibe por parámetro la tabla y los datos */
		$this->db->insert('productos', $data);
		/* insert_id()-> Devuelve el id, del registro que acaba de ingresar */
		return $this->db->insert_id();
	}


	public function update($data = array(), $id){
		/*Usar el método where y pasar por parámetro el id del producto que se va a editar*/
		$this->db->where('id', $id);
		/*Hacer la actualización de los datos, pasando por patámetro la tabla y los datos que he enviado en en controlador*/
		$this->db->update('productos', $data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('productos');
	}
	
	/**
	* Fotos
	**/
	public function insertarFoto($data = array()){
		$this->db->insert('productos_fotos', $data);
		return $this->db->insert_id();
	}

	public function getFotosById($id){
		$query = $this->db
		->select("id, id_producto, foto")
		->from("productos_fotos")
		->where(array("id_producto"=>$id))
		->get();
		return $query->result();
	}
	
	public function updateFoto($data = array(), $id){
		$this->db->where('id', $id);
		$this->db->update('productos_fotos', $data);
	}

	public function getFotoById($id){
		$query = $this->db
		->select("id, id_producto, foto")
		->from("productos_fotos")
		->where(array("id"=>$id))
		->get();
	    return $query->row();
	}

	public function deleteFoto($id){
		$this->db->where('id', $id);
		$this->db->delete('productos_fotos');
	}

	/**  Método de paginación    **/
	public function getAllPagination($pagina, $por_pagina, $accion){
		switch ($accion) {
			case 'limit':
			$query = $this->db 
			->select('id, nombre, precio, stock, fecha')
			->from('productos')
			->limit($por_pagina, $pagina)
			->order_by('id', 'asc')
			->get();
			return $query->result();
			break;

			case 'cuantos':
			$query = $this->db 
			->select('id, nombre, precio, stock, fecha')
			->from('productos')
			->count_all_results();
			/* count_all_results() -> Retorna la cantidad total de registros */
			return $query;
			break;
		}
	}

}

?>