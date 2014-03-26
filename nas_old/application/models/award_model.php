<?php
	class Award_model extends CI_Model {

		public function __construct()
		{
		}
		
		function set_award($args)
		{
			$this->db->set($args);
			$this->db->insert('award');
		}
	}
?>