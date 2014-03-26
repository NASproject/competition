<?php
	class Verifycode_model extends CI_Model {

		public function __construct()
		{
		}
		
		function set_verifycode($args)
		{
			$this->db->set($args);
			$this->db->insert('verifycode');
		}
	}
?>