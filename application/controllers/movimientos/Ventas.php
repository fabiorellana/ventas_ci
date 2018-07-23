<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Ventas_model");
		$this->load->model("Clientes_model");
	}

	public function index(){
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ventas/list');
		$this->load->view('layouts/footer');
	}

	public function add(){
		$data = array(
			'tipocomprobantes' => $this->Ventas_model->getComprobantes(),
			'clientes' => $this->Clientes_model->getClientes(), 
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ventas/add',$data);
		$this->load->view('layouts/footer');
	}

	public function getproductos(){
		$valor = $this->input->post("valor");
		$clientes = $this->Ventas_model->getproductos($valor);
		echo json_encode($clientes);
	}
}
/*--- Fin Ventas.php ---*/