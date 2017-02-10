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
		return $query->result();
	}

}

?>