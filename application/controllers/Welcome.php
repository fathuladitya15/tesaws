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

	function edit($id = null) {

		if (!isset($id)) redirect('welcome/index','refresh');
			$data 		=	$this->TestModel;
			$validation	=	$this->form_validation;
			$validation->set_rules($data->rules());
			
			if ($validation->run()) {
				$data->update();
				redirect('welcome/index','refresh');
			}
		$arr['data'] = $this->TestModel->getById($id);
		if (!$arr["data"]) 
		show_404();
		$this->load->view('edit',$arr);
	}

	public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->TestModel->delete($id)) {
            redirect('welcome/index','refresh');
        }
    }
	
}
