<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

	public function getClientes(){
		$this->db->select("c.*, tc.nombre as tipocliente, td.nombre as tipodocumento");
		$this->db->from("clientes c");
		$this->db->join("tipo_cliente tc", "c.tipo_cliente_id = tc.id");
		$this->db->join("tipo_documentos td", "c.tipo_documento_id = td.id");
		$this->db->where("c.estado", "1");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("clientes",$data);
	}

	public function getCliente($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("clientes");
		return $resultado->row();
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("clientes",$data);
	}

	public function getTipoClientes(){
		$resultado = $this->db->get("tipo_cliente");
		return $resultado->result();
	}

	public function getTipoDocumentos(){
		$resultado = $this->db->get("tipo_documentos");
		return $resultado->result();
	}
}