<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent ::__construct();
		$this->load->model("TestModel");
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$arr['data'] = $this->TestModel->getAll();

		// echo"<pre>", print_r($arr);
		// die();

		$this->load->view('welcome_message', $arr);
	}

	function add()  {
		$this->load->view('tambah');
	}

	function create() {

		$post = $this->input->post();

		$model 		= 	$this->TestModel;
		$validation	=	$this->form_validation;
		$validation->set_rules($model->rules());
		
		
		if ($validation->run()) {
			$model->save();
			$this->session->set_flashdata('success',TRUE);
		}

		redirect('welcome/index','refresh');
	}

	function edit($id) {
		$arr['data'] = $this->TestModel->getById($id);
		// echo "<pre>",print_r($arr);
		// die();
		$this->load->view('edit',$arr);
	}
}
