<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Clientes_model");
	}

	public function index()
	{
		$data = array(
			'clientes' => $this->Clientes_model->getClientes(), 
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/clientes/list',$data);
		$this->load->view('layouts/footer');
	}

	public function add(){
		$data = array(
			'tipoclientes' => $this->Clientes_model->getTipoClientes(),
			'tipodocumentos' => $this->Clientes_model->getTipoDocumentos(), 
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/clientes/add',$data);
		$this->load->view('layouts/footer');
	}

	public function store(){
		$nombre = $this->input->post("nombre");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocliente = $this->input->post("tipocliente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");

		$this->form_validation->set_rules('nombre', 'Nombre del Cliente', 'required');
		$this->form_validation->set_rules('tipocliente', 'Tipo de Cliente', 'required');
		$this->form_validation->set_rules('tipodocumento', 'Tipo de Documento', 'required');
		$this->form_validation->set_rules('numero', 'Numero de Documento', 'required|is_unique[clientes.num_documento]');

		if ($this->form_validation->run()) {
			$data = array(
				'nombre' => $nombre,
				'tipo_documento_id' => $tipodocumento,
				'tipo_cliente_id' => $tipocliente,
				'direccion' => $direccion,
				'telefono' => $telefono,
				'num_documento' => $num_documento,
				'estado' => "1" 
			);

			if ($this->Clientes_model->save($data)) {
				redirect(base_url()."mantenimiento/clientes");
			}
			else{
				$this->session->set_flashdata('error', 'No se ha podido guardar la información');
				redirect(base_url()."mantenimiento/clientes/add");
			}

		} else {
			$this->add();
		}
	}

	public function edit($id){
		$data = array(
			'cliente' => $this->Clientes_model->getCliente($id),
			'tipoclientes' => $this->Clientes_model->getTipoClientes(),
			'tipodocumentos' => $this->Clientes_model->getTipoDocumentos(),  
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/clientes/edit',$data);
		$this->load->view('layouts/footer');
	}

	public function update(){
		$idcliente = $this->input->post("idcliente");
		$nombre = $this->input->post("nombre");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocliente = $this->input->post("tipocliente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");

		$clienteActual = $this->Clientes_model->getCliente($idcliente);

		if ($num_documento == $clienteActual->num_documento) {
			$is_unique = '';
		}
		else{
			$is_unique = '|is_unique[clientes.num_documento]';
		}

		$this->form_validation->set_rules('nombre', 'Nombre del Cliente', 'required');
		$this->form_validation->set_rules('tipocliente', 'Tipo de Cliente', 'required');
		$this->form_validation->set_rules('tipodocumento', 'Tipo de Documento', 'required');
		$this->form_validation->set_rules('numero', 'Numero de Documento', 'required'.$is_unique);

		if ($this->form_validation->run()) {
			$data = array(
				'nombre' => $nombre,
				'tipo_documento_id' => $tipodocumento,
				'tipo_cliente_id' => $tipocliente,
				'direccion' => $direccion,
				'telefono' => $telefono,
				'num_documento' => $num_documento,
			);

			if ($this->Clientes_model->update($idcliente,$data)) {
				redirect(base_url()."mantenimiento/clientes");
			}
			else{
				$this->session->set_flashdata('error', 'No se ha podido actualizar la información');
				redirect(base_url()."mantenimiento/clientes/edit/".$idcliente);
			}

		} else {
			$this->edit($idcliente);
		}
	}

	public function delete($id){
		$data = array(
			'estado' => "0", 
		);
		$this->Clientes_model->update($id,$data);
		echo "mantenimiento/clientes";
	}
}
/*--- Fin Clientes.php ---*/