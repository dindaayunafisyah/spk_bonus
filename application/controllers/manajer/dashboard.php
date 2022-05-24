<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
    }

	public function index()
	{
		$this->load->view('manajer/tamplate/header');
		$this->load->view('manajer/tamplate/sidebar');
		$this->load->view('manajer/tamplate/pageheading');
		$this->load->view('manajer/tamplate/footer');
	}
}
