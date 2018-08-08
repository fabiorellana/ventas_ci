<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url()."dashboard");
		}
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data = array(
			'cantVentas' => $this->Backend_model->rowCount("ventas"),
			'cantUsuarios' => $this->Backend_model->rowCount("usuarios"), 
			'cantClientes' => $this->Backend_model->rowCount("clientes"), 
			'cantProductos' => $this->Backend_model->rowCount("productos"),
			'years' => $this->Ventas_model->years()  
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('layouts/footer');
	}

	public function getData(){
		$year = $this->input->post("year");
		$resultados = $this->Ventas_model->montos($year);
		echo json_encode($resultados);
	}
}
/*--- Fin Dashboard.php ---*/