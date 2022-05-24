<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	
	public function proseslogin($table,$where)
	{	
            return $this->db->get_where($table,$where);
        }	
}
