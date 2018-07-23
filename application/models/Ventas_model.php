<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_model extends CI_Model {

	public function getComprobantes(){
		$resultados = $this->db->get("tipo_comprobante");
		return $resultados->result();
	}

	public function getproductos($valor){
		$this->db->select("id,codigo,nombre as label,precio,stock");
		$this->db->from("productos");
		$this->db->like("nombre",$valor);
		$resultados = $this->db->get();
		return $resultados->result_array();
	}
}