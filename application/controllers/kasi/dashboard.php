<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
    }

	public function index()
	{
		$this->load->view('kasi/tamplate/header');
		$this->load->view('kasi/tamplate/sidebar');
		$this->load->view('kasi/tamplate/pageheading');
		$this->load->view('kasi/tamplate/footer');
	}
}
