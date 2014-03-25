<?php
class Project_model extends CI_Model {

	public function __construct()
	{
	}
	
	function get_project_teacher($args = FALSE)
	{
		$str = "SELECT * FROM project WHERE p_adviser LIKE '%{$this->input->post("p_adviser")}%'";
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	
	}	
	function get_projectbySQL($args)
	{
		$query = $this->db->query($args);
		log_message('debug',json_encode($query->result_array()));
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}
	
	function get_project($args = FALSE)
	{
		$str = "SELECT * FROM project WHERE p_name LIKE '%{$this->input->post("p_name")}%'";
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}	

	function set_project($args = FALSE)
	{
		$this->db->set($args);
		$this->db->insert('project');
	}
	
	function get_project_keyword($args = FALSE)
	{
		$str = "SELECT P.* FROM project as P, keyword AS K WHERE K.k_value like '%{$this->input->post("k_value")}%' AND K.k_project=P.p_id";
		$query = $this->db->query($str);
		if ($query->num_rows() > 0)
		{
		   return $query->result_array();
		} else
			return 0;
	}

}
