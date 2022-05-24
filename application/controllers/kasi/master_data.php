<?php
defined('BASEPATH') or exit('No direct script access allowed');

class master_data extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // ini adalah function untuk memuat model bernama m_data
        $this->load->model('m_data_jabatan');
        $this->load->model('m_data_divisi');
        $this->load->model('m_data_kriteria');
        $this->load->model('M_data_nilai', 'mdn');
        $this->load->model('M_data_kuis', 'mdk');
        $this->load->model('DataKaryawan_Model', 'dkm');
        $this->load->helper('url', 'form', 'file');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function penilaian_op()
    {
        $this->form_validation->set_rules('productivity', 'Kuis Productivity', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('komker', 'Kuis Komunikasi dan Kerjasama', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('pelaksana5r', 'Kuis Pelaksanaan 5 R', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('dokumentasi', 'Kuis Dokumentasi', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('pahamdanlaksanak3', 'Kuis Pemahaman dan Pelaksanaan K3', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('pahamsop', 'Kuis Paham SOP dan SPK', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('pahamtools', 'Kuis Paham Tools', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('hadir', 'Kuis Kehadiran', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('disiplin', 'Kuis Kedisiplinan', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('inisiatif', 'Kuis Inisiatif', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('nama_karyawan', 'Nama', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('id_divisi', 'ID Divisi', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('id_jabatan', 'ID Jabatan', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {

            $data['title'] = "Penilaian Operator";
            $data['data'] = $this->mdn->showPenilaianOP()->result_array();
            $data['karyawan'] = $this->dkm->showDataOperator();
            $data['quiz'] = $this->mdk->showQuisionerOperator();
            $data['jawaban_productivity'] = $this->mdk->showPrioritasProductivity();
            $data['jawaban_komker'] = $this->mdk->showPrioritasKomKer();
            $data['jawaban_pelaksana5r'] = $this->mdk->showPrioritasPelaksana5r();
            $data['jawaban_dokumentasi'] = $this->mdk->showPrioritasDokumentasi();
            $data['jawaban_pahamdanlaksanak3'] = $this->mdk->showPrioritasPahamdanLaksanaK3();
            $data['jawaban_pahamsop'] = $this->mdk->showPrioritasPahamSOP();
            $data['jawaban_pahamtools'] = $this->mdk->showPrioritasPahamTools();
            $data['jawaban_hadir'] = $this->mdk->showPrioritasKehadiran();
            $data['jawaban_disiplin'] = $this->mdk->showPrioritasDisiplin();
            $data['jawaban_inisiatif'] = $this->mdk->showPrioritasInisiatif();

            // echo "<pre>";
            // print_r($data['product']);
            // die;
            // echo "</pre>";
            $this->load->view('kasi/tamplate/header');
            $this->load->view('kasi/tamplate/sidebar', $data);
            $this->load->view('kasi/tamplate/penilaian_op', $data);
            $this->load->view('kasi/tamplate/footer', $data);
        } else {
            $data['kriteria'] = $this->mdk->showPriorMatrixOP();
            $product = $data['kriteria'][0]['prioritas'];
            $komker = $data['kriteria'][1]['prioritas'];
            $pl5r = $data['kriteria'][2]['prioritas'];
            $doc = $data['kriteria'][3]['prioritas'];
            $plk3 = $data['kriteria'][4]['prioritas'];
            $pss = $data['kriteria'][5]['prioritas'];
            $ptls = $data['kriteria'][6]['prioritas'];
            $hdr = $data['kriteria'][7]['prioritas'];
            $dsp = $data['kriteria'][8]['prioritas'];
            $inf = $data['kriteria'][9]['prioritas'];

            $p1 = $this->input->post('productivity');
            $p2 = $this->input->post('komker');
            $p3 = $this->input->post('pelaksana5r');
            $p4 = $this->input->post('dokumentasi');
            $p5 = $this->input->post('pahamdanlaksanak3');
            $p6 = $this->input->post('pahamsop');
            $p7 = $this->input->post('pahamtools');
            $p8 = $this->input->post('hadir');
            $p9 = $this->input->post('disiplin');
            $p10 = $this->input->post('inisiatif');

            $q1 = doubleval($p1) * $product;
            $q2 = doubleval($p2) * $komker;
            $q3 = doubleval($p3) * $pl5r;
            $q4 = doubleval($p4) * $doc;
            $q5 = doubleval($p5) * $plk3;
            $q6 = doubleval($p6) * $pss;
            $q7 = doubleval($p7) * $ptls;
            $q8 = doubleval($p8) * $hdr;
            $q9 = doubleval($p9) * $dsp;
            $q10 = doubleval($p10) * $inf;

            $total = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10;


            $data = [
                'productivity' => $q1,
                // <===>
                'komker' => $q2,
                // <===>
                'pelaksana5r' => $q3,
                // <===>
                'dokumentasi' => $q4,
                // <===>
                'pahamdanlaksanak3' => $q5,
                // <===>
                'pahamsop' => $q6,
                // <===>
                'pahamtools' => $q7,
                // <===>
                'kehadiran' => $q8,
                // <===>
                'kedisiplinan' => $q9,
                // <===>
                'inisiatif' => $q10,
                // <===>
                'nama_karyawan' => $this->input->post('nama_karyawan'),
                'id_divisi' => $this->input->post('id_divisi'),
                'id_jabatan' => $this->input->post('id_jabatan'),
                // 
                'total' => $total
            ];

            // echo "<pre>";
            // print_r($data);
            // die;
            // echo "</pre>";

            $query = $this->db->insert('tb_penilaian', $data);
            if ($query) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Operator Sukses dinilai
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('kasi/master_data/penilaian_op');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                       Operator  Gagal dinilai
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('kasi/master_data/penilaian_op');
            }
        }
    }

    public function ajax_show_karyawan()
    {
        $nama_karyawan = $this->input->post('nama_karyawan');

        $bio = $this->mdn->ajax_show_karyawan($nama_karyawan);

        $data = array(
            'id_divisi' => $bio['id_divisi'],
            'id_jabatan' => $bio['id_jabatan'],
        );

        echo json_encode($data);
    }
}
