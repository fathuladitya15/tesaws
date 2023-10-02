<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TestModel extends CI_Model{

	private $_table = 'gambar';
	public $id;
	public $name;
	public $status;
	public $desk;


	public function rules() {
		return [
				[			
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required',
				],[
					'field'	=>	'status',
					'label'	=>	'Status',
					'rules'	=>	'required',
				],[
					'field'	=>	'desk',
					'label'	=>	'Desk',
					'rules'	=>	'required',
				],
			];
	}

	function getAll() {
		return $this->db->get($this->_table)->result();
	}

	function getById($id)  {
		return $this->db->get_where($this->_table,["id" => 	$id])->row();
	}

	function save() {
		$post			=	$this->input->post();
		$this->name		=	$post['name'];
		$this->status	=	$post['status'];
		$this->desk		=	$post['desk'];

		return $this->db->insert($this->_table,$this);
	}

	function update() {
		$post 			=	$this->input->post();
		$this->id		=	$post["id"];
		$this->name		=	$post["name"];
		$this->status	=	$post["status"];
		$this->desk		=	$post["desk"];

		return $this->db->update($this->_table, $this, array('id' => $post["id"]));
	}

	function delete($id) {
		return $this->db->delete($this->_table, array('id'=>$id));
	}
}