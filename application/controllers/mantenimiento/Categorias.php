<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Categorias_model");
	}

	public function index()
	{
		$data = array(
			'categorias' => $this->Categorias_model->getCategorias(), 
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/categorias/list',$data);
		$this->load->view('layouts/footer');
	}

	public function add(){
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/categorias/add');
		$this->load->view('layouts/footer');
	}

	public function store(){
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[categorias.nombre]');

		if ($this->form_validation->run()) {
			$data = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'estado' => "1" 
			);

			if ($this->Categorias_model->save($data)) {
				redirect(base_url()."mantenimiento/categorias");
			}
			else{
				$this->session->set_flashdata('error', 'No se ha podido guardar la información');
				redirect(base_url()."mantenimiento/categorias/add");
			}

		} else {
			$this->add();
		}
	}

	public function edit($id){
		$data = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/categorias/edit',$data);
		$this->load->view('layouts/footer');
	}

	public function update(){
		$idCategoria = $this->input->post("idCategoria");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$categoriaActual = $this->Categorias_model->getCategoria($idCategoria);

		if ($nombre == $categoriaActual->nombre) {
			$unique = '';
		}
		else{
			$unique = '|is_unique[categorias.nombre]';
		}

		$this->form_validation->set_rules('nombre', 'Nombre', 'required'.$unique);

		if ($this->form_validation->run()) {
			$data = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion, 
			);

			if ($this->Categorias_model->update($idCategoria,$data)) {
				redirect(base_url()."mantenimiento/categorias");
			}
			else{
				$this->session->set_flashdata('error', 'No se ha podido actualizar la información');
				redirect(base_url()."mantenimiento/categorias/edit/".$idCategoria);
			}

		} else {
			$this->edit($idCategoria);
		}
	}

	public function view($id){
		$data = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);
		$this->load->view("admin/categorias/view",$data);
	}

	public function delete($id){
		$data = array(
			'estado' => "0", 
		);
		$this->Categorias_model->update($id,$data);
		echo "mantenimiento/categorias";
	}
}
/*--- Fin Categorias.php ---*/