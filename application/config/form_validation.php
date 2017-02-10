<?php
/**
 * Reglas de validacion para formularios
 */
$config = array(
       
        /**
         * add_formulario
         * */
        'add_formulario'
        => array(
            
            array('field' => 'nombre','label' => 'Nombre','rules' => 'required|is_string|trim|max_length[5]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|valid_email'),
            array('field' => 'telefono','label' => 'Teléfono','rules' => 'required|is_numeric|trim'),
            
        ), 
        
        
        /**
         * elefante
         * */
        'elefante'
        => array(
            
            array('field' => 'nombre','label' => 'Nombre','rules' => 'required|is_string|trim|max_length[5]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|valid_email'),
            
        ), 
        
        
        /**
         * manzana
         * */
        'manzana'
        => array(
            
            array('field' => 'nombre','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[5]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
            
        ),
   
   //éste es el final      
);