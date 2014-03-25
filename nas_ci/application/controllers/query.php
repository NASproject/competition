<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query extends CI_Controller {

	private $data;
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url');
//		log_message('debug', 'this->setMessage()');
//		$this->setMessage();
	}
	
	public function index()
	{
//		echo "123";
		$this->load->model('project_model');
		$action = $this->input->post("action");
		if ($action == "keyword") {
			$this->keyword();
		} else if ($action == "teacher") {
			$this->teacher();
		} else if ($action == "project") {
			$this->project();
		}	
	}


	private function project() {
		echo json_encode($this->project_model->get_project());
	}

	private function teacher() {
//		echo "123";
		echo json_encode($this->project_model->get_project_teacher());
	}

	private function keyword() {
		echo json_encode($this->project_model->get_project_keyword());
//		echo json_encode($array,JSON_HEX_QUOT);
	}
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
