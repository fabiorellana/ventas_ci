<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Clientes_model");
	}

	public function index(){
		$data = array(
			'clientes' => $this->Clientes_model->getClientes(), 
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/reportes/clientes',$data);
		$this->load->view('layouts/footer');
	}
}
/*--- Fin Clientes.php ---*/