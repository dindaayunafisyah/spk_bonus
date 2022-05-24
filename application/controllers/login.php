<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
		$this->load->helper('url');
    }
    
	public function index()
	{
		$this->load->view('v_login');
	}
    public function ceklogin()
    {
        // berikut kode untuk merekam data yang dikirim melalui post
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// berikut menyimpan data pada array untuk nantinya diproses ke dalam model
		$where = array(
			'username' => $username,
			'password' =>$password
			);
		// berikut menjalankan method cek_login pada model m_login
		$cek = $this->m_login->proseslogin("tb_user",$where)->num_rows();
		if($cek > 0){
            $pelogin = $this->db->get_where('tb_user', array('username' => $username, 'password' => $password))->row();
            if($pelogin->level == 'HRD'){
                $data_session = array(
                    'username' => $username,
                    'status' => "login"
                    );
                $this->session->set_userdata($data_session);
                
            redirect('admin/dashboard');

            }elseif($pelogin->level == 'Manajer'){
                $data_session = array(
                    'username' => $username,
                    'status' => "login"
                    );
                
                $this->session->set_userdata($data_session);
                
            redirect('manajer/dashboard');

            }elseif ($pelogin->level == 'Kepala Divisi'){
                $data_session = array(
                    'username' => $username,
                    'status' => "login"
                    );
                
                $this->session->set_userdata($data_session);
                
            redirect('kasi/dashboard');
                }

		}else{
			echo "Username dan password salah !";
		}
    }

    public function logout (){
        //  baris kode yang akan menghapus session yang ada
		$this->session->sess_destroy();
		//  baris kode yang mengarahkan pengguna ke controller login
		redirect(base_url('login'));
	}
}

