<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Permisos_model");
		$this->load->model("Usuarios_model");
	}

	public function index(){
		$data = array(
			'permisos' => $this->Permisos_model->getPermisos(), 
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/permisos/list',$data);
		$this->load->view('layouts/footer');
	}

	public function add(){
		$data = array(
			'roles' => $this->Usuarios_model->getRoles(),
			'menus' => $this->Permisos_model->getMenus(),  
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/permisos/add',$data);
		$this->load->view('layouts/footer');
	}

	public function store(){
		$menu = $this->input->post("menu");
		$rol = $this->input->post("rol");
		$insert = $this->input->post("insert");
		$read = $this->input->post("read");
		$update = $this->input->post("update");
		$delete = $this->input->post("delete");

		$data = array(
			'menu_id' => $menu,
			'rol_id' => $rol, 
			'read' => $read, 
			'insert' => $insert, 
			'update' => $update, 
			'delete' => $delete,  
		);

		if ($this->Permisos_model->save($data)) {
			redirect(base_url()."administrador/permisos");
		}else{
			$this->session->set_flashdata('error', 'No se ha podido guardar la información');
			redirect(base_url()."administrador/permisos/add");
		}
	}
}
/*--- Fin Permisos.php ---*/