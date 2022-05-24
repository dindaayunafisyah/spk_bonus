<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');

		if  ($this->session->userdata('status') != "login") {
			redirect(base_url("login"));
		}
    }

	public function index()
	{
		$this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
		$this->load->view('admin/tamplate/pageheading');
		$this->load->view('admin/tamplate/footer');
	}
}
