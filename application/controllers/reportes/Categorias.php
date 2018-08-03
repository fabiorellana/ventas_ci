<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Categorias_model");
	}

	public function index(){
		$data = array(
			'categorias' => $this->Categorias_model->getCategorias(), 
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/reportes/categorias',$data);
		$this->load->view('layouts/footer');
	}
}
/*--- Fin Categorias.php ---*/