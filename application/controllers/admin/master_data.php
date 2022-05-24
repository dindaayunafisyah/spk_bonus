<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // ini adalah function untuk memuat model bernama m_data
        $this->load->model('m_data_jabatan');
        $this->load->model('m_data_divisi');
        $this->load->model('m_data_kriteria');
        $this->load->model('m_data_nilai');
        $this->load->model('M_data_kuis', 'mdk');
        $this->load->model('DataKaryawan_Model');
        $this->load->helper('url', 'form', 'file');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }
    //  method yang akan diakses saat controller ini diakses
    public function tampil_jabatan()
    {
        $data['title'] = 'tampil_jabatan';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['jabatan'] = $this->m_data_jabatan->tampil_jabatan()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_jabatan', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    public function tambah_jabatan()
    {
        // Membuat fungsi untuk melakukan penambahan id produk secara otomatis
        // Mendapatkan jumlah produk yang ada di database
        $jumlahJabatan = $this->m_data_jabatan->tampil_jabatan()->num_rows();
        // Jika jumlah produk lebih dari 0
        if ($jumlahJabatan > 0) {
            // Mengambil id produk sebelumnya
            $lastId = $this->m_data_jabatan->tampil_jabatan_akhir()->result();
            // Melakukan perulangan untuk mengambil data
            foreach ($lastId as $row) {
                // Melakukan pemisahan huruf dengan angka pada id produk
                $rawIdJabatan = substr($row->id_jabatan, 3);
                // Melakukan konversi nilai pemisahan huruf dengan angka pada id order menjadi integer
                $idJabatanInt = intval($rawIdJabatan);

                // Menghitung panjang id yang sudah menjadi integer
                if (strlen($idJabatanInt) == 1) {
                    // jika panjang id hanya 1 angka
                    $id_jabatan = "JB00" . ($idJabatanInt + 1);
                } else if (strlen($idJabatanInt) == 2) {
                    // jika panjang id hanya 2 angka
                    $id_jabatan = "JB0" . ($idJabatanInt + 1);
                } else if (strlen($idJabatanInt) == 3) {
                    // jika panjang id hanya 3 angka
                    $id_jabatan = "JB" . ($idJabatanInt + 1);
                }
            }
        } else {
            // Jika jumlah paket soal kurang dari sama dengan 0
            $id_jabatan = "JB001";
        }


        $data = array(
            'id_jabatan' => $id_jabatan
        );
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_tambah_jabatan', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function aksitambah_jabatan()
    {
        // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
        $id_jabatan = $this->input->post('id_jabatan');
        $nama_jabatan = $this->input->post('nama_jabatan');
        // array yang berguna untuk mennjadikanva variabel diatas menjadi 1 variabel yang nantinya akan di sertakan dalam query insert
        $data = array(
            'id_jabatan' => $id_jabatan,
            'nama_jabatan' => $nama_jabatan

        );
        // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
        $this->m_data_jabatan->tambah_jabatan($data, 'tb_jabatan');
        // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
        $this->session->set_flashdata('pesan', '
        <div class="alert alert-success" role="alert">
        <strong>Selamat!</strong> Anda Berhasil Menambahkan Data Jabatan. Data yang baru ditambahkan dapat dilihat di tabel.
        </div>
        ');

        redirect('admin/master_data/tampil_jabatan');
    }

    public function hapus_jabatan($id)
    {
        $where = array(
            'id_jabatan' => $id
        );

        $this->m_data_jabatan->delete_jabatan($where, 'tb_jabatan');
        $this->session->set_flashdata('pesan', '
        <div class="alert alert-success" role="alert">
        <strong>Berhasil!</strong> Data anda telah terhapus.
        </div>
        ');
        redirect('admin/master_data/tampil_jabatan');
    }

    public function tampil_divisi()
    {
        $data['title'] = 'tampil_divisi';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['divisi'] = $this->m_data_divisi->tampil_divisi()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_divisi', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    public function tambah_divisi()
    {
        // Membuat fungsi untuk melakukan penambahan id produk secara otomatis
        // Mendapatkan jumlah produk yang ada di database
        $jumlahDivisi = $this->m_data_divisi->tampil_divisi()->num_rows();
        // Jika jumlah produk lebih dari 0
        if ($jumlahDivisi > 0) {
            // Mengambil id produk sebelumnya
            $lastId = $this->m_data_divisi->tampil_divisi_akhir()->result();
            // Melakukan perulangan untuk mengambil data
            foreach ($lastId as $row) {
                // Melakukan pemisahan huruf dengan angka pada id produk
                $rawIdDivisi = substr($row->id_divisi, 3);
                // Melakukan konversi nilai pemisahan huruf dengan angka pada id order menjadi integer
                $idDivisiInt = intval($rawIdDivisi);

                // Menghitung panjang id yang sudah menjadi integer
                if (strlen($idDivisiInt) == 1) {
                    // jika panjang id hanya 1 angka
                    $id_divisi = "DV00" . ($idDivisiInt + 1);
                } else if (strlen($idDivisiInt) == 2) {
                    // jika panjang id hanya 2 angka
                    $id_divisi = "DV0" . ($idDivisiInt + 1);
                } else if (strlen($idDivisiInt) == 3) {
                    // jika panjang id hanya 3 angka
                    $id_divisi = "DV" . ($idDivisiInt + 1);
                }
            }
        } else {
            // Jika jumlah paket soal kurang dari sama dengan 0
            $id_divisi = "DV001";
        }


        $data = array(
            'id_divisi' => $id_divisi
        );
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_tambah_divisi', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function aksitambah_divisi()
    {
        // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
        $id_divisi = $this->input->post('id_divisi');
        $nama_divisi = $this->input->post('nama_divisi');
        // array yang berguna untuk mennjadikanva variabel diatas menjadi 1 variabel yang nantinya akan di sertakan dalam query insert
        $data = array(
            'id_divisi' => $id_divisi,
            'nama_divisi' => $nama_divisi

        );
        // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
        $this->m_data_divisi->tambah_divisi($data, 'tb_divisi');
        // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
        $this->session->set_flashdata('pesan', '
         <div class="alert alert-success" role="alert">
         <strong>Selamat!</strong> Anda Berhasil Menambahkan Data Divisi. Data yang baru ditambahkan dapat dilihat di tabel.
         </div>
         ');

        redirect('admin/master_data/tampil_divisi');
    }

    public function hapus_divisi($id)
    {
        $where = array(
            'id_divisi' => $id
        );

        $this->m_data_divisi->delete_divisi($where, 'tb_divisi');
        $this->session->set_flashdata('pesan', '
         <div class="alert alert-success" role="alert">
         <strong>Berhasil!</strong> Data anda telah terhapus.
         </div>
         ');
        redirect('admin/master_data/tampil_divisi');
    }






    // ---------------------- Data Karyawan ----------------------

    // ---------------------- Data Operator ----------------------
    public function data_operator()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        // $this->form_validation->set_rules('id_jabatan', 'ID JABATAN', 'required|trim', [
        //     'required' => '%s tidak boleh kosong',
        // ]);
        $this->form_validation->set_rules('id_divisi', 'ID DIVISI', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'data_operator';
            $data['data_operator'] = $this->DataKaryawan_Model->showDataOperator();
            $data['data_divisi'] = $this->m_data_divisi->showDataDivisi();
            // $data['data_jabatan'] = $this->m_data_jabatan->tampil_jabatan()->result();
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/data_operator', $data);
            $this->load->view('admin/tamplate/footer', $data);
        } else {
            $data = [
                'nik' => $this->input->post('nik'),
                'id_jabatan' => 'JB004',
                'id_divisi' => $this->input->post('id_divisi'),
                'nama_karyawan' => $this->input->post('nama_karyawan'),
            ];
            $true = $this->db->insert('tb_karyawan', $data);
            if ($true) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Sukses ditambah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/data_operator');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal ditambah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/data_operator');
            }
        }
    }

    public function update_data_operator()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        // $this->form_validation->set_rules('id_jabatan', 'ID JABATAN', 'required|trim', [
        //     'required' => '%s tidak boleh kosong',
        // ]);
        $this->form_validation->set_rules('id_divisi', 'ID DIVISI', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Operator';
            $data['data_operator'] = $this->DataKaryawan_Model->showDataOperator();
            $data['data_divisi'] = $this->m_data_divisi->showDataDivisi();
            // $data['data_jabatan'] = $this->m_data_jabatan->tampil_jabatan()->result();
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/data_operator', $data);
            $this->load->view('admin/tamplate/footer', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'nik' => $this->input->post('nik'),
                'id_jabatan' => 'JB004',
                'id_divisi' => $this->input->post('id_divisi'),
                'nama_karyawan' => $this->input->post('nama_karyawan'),
            ];
            $this->db->where('id_karyawan', $id);
            $true = $this->db->update('tb_karyawan', $data);
            if ($true) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sukses diperbarui
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
                redirect('admin/master_data/data_operator');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal diperbarui
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
                redirect('admin/master_data/data_operator');
            }
        }
    }

    public function delete_data_operator($id)
    {
        $this->db->where('id_karyawan', $id);
        $true = $this->db->delete('tb_karyawan');
        if ($true) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sukses dihapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/data_operator');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dihapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/data_operator');
        }
    }
    // ---------------------- End Data Operator ----------------------



    // ---------------------- Data Operator ----------------------
    public function data_kepdis()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        // $this->form_validation->set_rules('id_jabatan', 'ID JABATAN', 'required|trim', [
        //     'required' => '%s tidak boleh kosong',
        // ]);
        $this->form_validation->set_rules('id_divisi', 'ID DIVISI', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'data_kepdis';
            $data['data_kepdis'] = $this->DataKaryawan_Model->showDataKepdis();
            $data['data_divisi'] = $this->m_data_divisi->showDataDivisi();
            // $data['data_jabatan'] = $this->m_data_jabatan->tampil_jabatan()->result();
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/data_kepdis', $data);
            $this->load->view('admin/tamplate/footer', $data);
        } else {
            $data = [
                'nik' => $this->input->post('nik'),
                'id_jabatan' => 'JB003',
                'id_divisi' => $this->input->post('id_divisi'),
                'nama_karyawan' => $this->input->post('nama_karyawan'),
            ];
            $true = $this->db->insert('tb_karyawan', $data);
            if ($true) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Sukses ditambah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/data_kepdis');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal ditambah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/data_kepdis');
            }
        }
    }

    public function update_data_kepdis()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        // $this->form_validation->set_rules('id_jabatan', 'ID JABATAN', 'required|trim', [
        //     'required' => '%s tidak boleh kosong',
        // ]);
        $this->form_validation->set_rules('id_divisi', 'ID DIVISI', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kepala Divisi';
            $data['data_kepdis'] = $this->DataKaryawan_Model->showDataKepdis();
            $data['data_divisi'] = $this->m_data_divisi->showDataDivisi();
            // $data['data_jabatan'] = $this->m_data_jabatan->tampil_jabatan()->result();
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/data_kepdis', $data);
            $this->load->view('admin/tamplate/footer', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'nik' => $this->input->post('nik'),
                'id_jabatan' => 'JB003',
                'id_divisi' => $this->input->post('id_divisi'),
                'nama_karyawan' => $this->input->post('nama_karyawan'),
            ];
            $this->db->where('id_karyawan', $id);
            $true = $this->db->update('tb_karyawan', $data);
            if ($true) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sukses diperbarui
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
                redirect('admin/master_data/data_kepdis');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal diperbarui
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
                redirect('admin/master_data/data_kepdis');
            }
        }
    }

    public function delete_data_kepdis($id)
    {
        $this->db->where('id_karyawan', $id);
        $true = $this->db->delete('tb_karyawan');
        if ($true) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sukses dihapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/data_kepdis');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dihapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/data_kepdis');
        }
    }
    // ---------------------- End Data Operator ----------------------

    // ---------------------- End Data Karyawan ----------------------









    // ---------------------- Kriteria OP ----------------------
    public function tampil_kriteria_op()
    {
        $data['title'] = 'tampil_kriteria_op';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['kriteria_op'] = $this->m_data_kriteria->tampil_kriteria_op()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user

        // echo '<pre>';
        // // print_r($data['data_countop']);
        // $data[] = $data['data_sum1'];
        // print_r($data);
        // die;
        // echo '</pre>';

        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_kriteria_operator', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    public function update_kriteria_op()
    {
        $data['title'] = 'update_kriteria_op';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['kriteria_op'] = $this->m_data_kriteria->tampil_kriteria_op()->result();
        $data['data_nilban'] = $this->m_data_nilai->tampil_nilai()->result_array();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $update = [
            'nama_kriteria_op' => $this->input->post('nama_kriteria_op'),
        ];
        $id = $this->input->post('id_kriteria_op');
        $this->db->where('id_kriteria_op', $id);
        $true = $this->db->update('tb_kriteria_operator', $update);
        if ($true) {
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/v_kriteria_operator', $data);
            $this->load->view('admin/tamplate/footer', $data);
            $this->session->set_flashdata(
                'pesan_update_kriteria_op',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sukses diupdate
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/tampil_kriteria_op');
        } else {
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/v_kriteria_operator', $data);
            $this->load->view('admin/tamplate/footer', $data);
            $this->session->set_flashdata(
                'pesan_update_kriteria_op',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal diupdate
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/tampil_kriteria_op');
        }
    }

    public function tambah_kriteria_op()
    {

        $idDivisiInt = 0;
        // Membuat fungsi untuk melakukan penambahan id produk secara otomatis
        // Mendapatkan jumlah produk yang ada di database
        $jumlahKriteriaOp = $this->m_data_kriteria->tampil_kriteria_op()->num_rows();
        // Jika jumlah produk lebih dari 0
        if ($jumlahKriteriaOp > 0) {
            // Mengambil id produk sebelumnya
            $lastId = $this->m_data_kriteria->tampil_kriteria_akhir_op()->result();
            // Melakukan perulangan untuk mengambil data
            foreach ($lastId as $row) {
                // Melakukan pemisahan huruf dengan angka pada id produk
                $rawIdKriteriaOp = substr($row->id_kriteria_op, 3);
                // Melakukan konversi nilai pemisahan huruf dengan angka pada id order menjadi integer
                $idKriteriaOpInt = intval($rawIdKriteriaOp);

                // Menghitung panjang id yang sudah menjadi integer
                if (strlen($idKriteriaOpInt) == 1) {
                    // jika panjang id hanya 1 angka
                    $id_kriteria_op = "KOP00" . ($idKriteriaOpInt + 1);
                } else if (strlen($idDivisiInt) == 2) {
                    // jika panjang id hanya 2 angka
                    $id_kriteria_op = "KOP0" . ($idKriteriaOpInt + 1);
                } else if (strlen($idKriteriaOpInt) == 3) {
                    // jika panjang id hanya 3 angka
                    $id_kriteria_op = "KOP" . ($idKriteriaOpInt + 1);
                }
            }
        } else {
            // Jika jumlah paket soal kurang dari sama dengan 0
            $id_kriteria_op = "KOP001";
        }


        $data = array(
            'id_kriteria_op' =>  $id_kriteria_op
        );
        $data['data_nilban'] = $this->m_data_nilai->tampil_nilai()->result_array();
        $data['title'] = 'tambah_kriteria_op';
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_tambah_kriteria_op', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function aksitambah_kriteria_op()
    {
        // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
        $id_kriteria_op = $this->input->post('id_kriteria_op');
        $nama_kriteria_op = $this->input->post('nama_kriteria_op');
        // array yang berguna untuk mennjadikanva variabel diatas menjadi 1 variabel yang nantinya akan di sertakan dalam query insert
        $data = array(
            'id_kriteria_op' =>  $id_kriteria_op,
            'nama_kriteria_op' => $nama_kriteria_op,
        );
        // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
        $this->m_data_kriteria->tambah_kriteria_op($data, 'tb_kriteria_operator');
        // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
        $this->session->set_flashdata('pesan', '
         <div class="alert alert-success" role="alert">
         <strong>Selamat!</strong> Anda Berhasil Menambahkan Data Kriteria. Data yang baru ditambahkan dapat dilihat di tabel.
         </div>
         ');

        redirect('admin/master_data/tampil_kriteria_op');
    }

    public function hapus_kriteria_op($id)
    {
        $where = array(
            'id_kriteria_op' => $id
        );

        $this->m_data_kriteria->delete_kriteria_op($where, 'tb_kriteria_operator');
        $this->session->set_flashdata('pesan', '
         <div class="alert alert-success" role="alert">
         <strong>Berhasil!</strong> Data anda telah terhapus.
         </div>
         ');
        redirect('admin/master_data/tampil_kriteria_op');
    }
    //---------------------- End Kriteria OP ----------------------










    //---------------------- Analisa Perbandingan ----------------------




    //---------------------- Pembobotan Kriteria Operator ----------------------
    public function pembobotan_KriOp()
    {
        $data['title'] = 'pembobotan_KriOp';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 

        $data['data_anop'] = $this->DataKaryawan_Model->showAnalyzeOP();
        $data['data_sum'] = $this->DataKaryawan_Model->sumAnalyzeOP();
        $data['data_nilban'] = $this->m_data_nilai->tampil_nilai()->result_array();
        $data['data_nilban1'] = $this->m_data_nilai->tampil_nilai_awal()->result_array();
        $data['data_matrix'] = $this->DataKaryawan_Model->showMatrixOp();
        $data['total_matrix'] = $this->DataKaryawan_Model->totalNilaiMatriks();
        $data['data_countop'] = $this->DataKaryawan_Model->countKritOp();
        $data['ri'] = 1.49;
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user

        // echo '<pre>';
        // // print_r($data['data_countop']);
        // $data[] = $data['data_sum1'];
        // print_r($data);
        // die;
        // echo '</pre>';

        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_pembobotan_kriop', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    //---------------------- End Pembobotan Kriteria Operator ----------------------






    public function update_analisa_perbandingan()
    {


        $pro = $this->input->post('productivity[]');
        $kdk = $this->input->post('kerjasamadankom[]');
        $p5r = $this->input->post('pelaksana5r[]');
        $doc = $this->input->post('dokumentasi[]');
        $ppk3 = $this->input->post('paham_laksana_k3[]');
        $psop = $this->input->post('paham_sop[]');
        $ptls = $this->input->post('paham_tools[]');
        $hdr = $this->input->post('hadir[]');
        $dsp = $this->input->post('disiplin[]');
        $inf = $this->input->post('inisiatif[]');
        $data = array();
        for ($x = 0; $x < sizeof($pro); $x++) {
            $data[] = [
                'productivity' => $pro[$x],
                'kerjasamadankom' => $kdk[$x],
                'pelaksana5r' => $p5r[$x],
                'dokumentasi' => $doc[$x],
                'paham_laksana_k3' => $ppk3[$x],
                'paham_sop' => $psop[$x],
                'paham_tools' => $ptls[$x],
                'hadir' => $hdr[$x],
                'disiplin' => $dsp[$x],
                'inisiatif' => $inf[$x],
                'id_anop' => $x + 1,
            ];
        }
        $query = $this->db->update_batch('tb_analisa_op', $data, 'id_anop');
        //
        // var_dump($query);
        // die;
        if ($query) {
            $data['data_sum'] = $this->DataKaryawan_Model->sumAnalyzeOP();
            $proc = $data['data_sum']['sumProc'];
            $kedako = $data['data_sum']['sumKdk'];
            $pel5r = $data['data_sum']['sump5r'];
            $docs = $data['data_sum']['sumDoc'];
            $plk3 = $data['data_sum']['sumplk3'];
            $pasop = $data['data_sum']['sumPsop'];
            $patols = $data['data_sum']['sumPtls'];
            $hadr = $data['data_sum']['sumHdr'];
            $displ = $data['data_sum']['sumDsp'];
            $inis = $data['data_sum']['sumInf'];
            $data['data_countop'] = $this->DataKaryawan_Model->countKritOp();
            $countKrit = $data['data_countop']['jumKritOp'];
            $data['data_sum1'] = $this->DataKaryawan_Model->sumAnalyzeOPResArray();
            $sumEigen = $data['data_sum1'];

            // print_r($countKrit);
            // die;

            $data = array();
            for ($x = 0; $x < sizeof($pro); $x++) {
                $data1[] = [
                    'productivity' => $pro[$x] / $proc,
                    'kerjasamadankom' => $kdk[$x] / $kedako,
                    'pelaksana5r' => $p5r[$x] / $pel5r,
                    'dokumentasi' => $doc[$x] / $docs,
                    'paham_laksana_k3' => $ppk3[$x] / $plk3,
                    'paham_sop' => $psop[$x] / $pasop,
                    'paham_tools' => $ptls[$x] / $patols,
                    'hadir' => $hdr[$x] / $hadr,
                    'disiplin' => $dsp[$x] / $displ,
                    'inisiatif' => $inf[$x] / $inis,
                    'jumlah' => (($pro[$x] / $proc) + ($kdk[$x] / $kedako) + ($p5r[$x] / $pel5r) + ($doc[$x] / $docs) + ($ppk3[$x] / $plk3) + ($psop[$x] / $pasop) + ($ptls[$x] / $patols) + ($hdr[$x] / $hadr) + ($dsp[$x] / $displ) + ($inf[$x] / $inis)),

                    'prioritas' => (($pro[$x] / $proc) + ($kdk[$x] / $kedako) + ($p5r[$x] / $pel5r) + ($doc[$x] / $docs) + ($ppk3[$x] / $plk3) + ($psop[$x] / $pasop) + ($ptls[$x] / $patols) + ($hdr[$x] / $hadr) + ($dsp[$x] / $displ) + ($inf[$x] / $inis)) / $countKrit,

                    'eigen_value' => ((($pro[$x] / $proc) + ($kdk[$x] / $kedako) + ($p5r[$x] / $pel5r) + ($doc[$x] / $docs) + ($ppk3[$x] / $plk3) + ($psop[$x] / $pasop) + ($ptls[$x] / $patols) + ($hdr[$x] / $hadr) + ($dsp[$x] / $displ) + ($inf[$x] / $inis)) / $countKrit) * $sumEigen[$x],

                    'id_matop' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_matriks_op', $data1, 'id_matop');

            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                        Sukses dianalisa
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/pembobotan_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal dianalisa
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/pembobotan_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dianalisa tahap nilai
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/pembobotan_KriOp');
        }
    }












    //---------------------- Pembobotan Kriteria KASI ----------------------
    public function pembobotan_KriKepdis()
    {
        $data['title'] = 'pembobotan_KriKepdis';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 

        $data['data_anop'] = $this->DataKaryawan_Model->showAnalyzeKasi();
        $data['data_sum'] = $this->DataKaryawan_Model->sumAnalyzeKasi();
        $data['data_nilban'] = $this->m_data_nilai->tampil_nilai()->result_array();
        $data['data_nilban1'] = $this->m_data_nilai->tampil_nilai_awal()->result_array();
        $data['data_matrix'] = $this->DataKaryawan_Model->showMatrixKasi();
        $data['total_matrix'] = $this->DataKaryawan_Model->totalNilaiMatriksKasi();
        $data['data_countop'] = $this->DataKaryawan_Model->countKritKasi();
        $data['ri'] = 1.49;
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user

        // echo '<pre>';
        // // print_r($data['data_countop']);
        // $data[] = $data['data_sum1'];
        // print_r($data);
        // die;
        // echo '</pre>';

        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_pembobotan_krikepdis', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }





    public function update_analisa_kasi()
    {


        $pro = $this->input->post('productivity[]');
        $kdk = $this->input->post('kerjasamadankom[]');
        $p5r = $this->input->post('pelaksana5r[]');
        $doc = $this->input->post('dokumentasi[]');
        $ppk3 = $this->input->post('paham_laksana_k3[]');
        $psop = $this->input->post('paham_sop[]');
        $ptls = $this->input->post('paham_tools[]');
        $hdr = $this->input->post('hadir[]');
        $dsp = $this->input->post('disiplin[]');
        $inf = $this->input->post('inisiatif[]');
        $data = array();
        for ($x = 0; $x < sizeof($pro); $x++) {
            $data[] = [
                'productivity' => $pro[$x],
                'kerjasamadankom' => $kdk[$x],
                'pelaksana5r' => $p5r[$x],
                'dokumentasi' => $doc[$x],
                'paham_laksana_k3' => $ppk3[$x],
                'paham_sop' => $psop[$x],
                'paham_tools' => $ptls[$x],
                'hadir' => $hdr[$x],
                'disiplin' => $dsp[$x],
                'inisiatif' => $inf[$x],
                'id_anop' => $x + 1 + sizeof($pro),
            ];
        }
        // echo "<pre>";
        // print_r($query);
        // die;
        // echo "</pre>";
        $query = $this->db->update_batch('tb_analisa_op', $data, 'id_anop');
        //
        if ($query) {
            $data['data_sum'] = $this->DataKaryawan_Model->sumAnalyzeKasi();
            $proc = $data['data_sum']['sumProc'];
            $kedako = $data['data_sum']['sumKdk'];
            $pel5r = $data['data_sum']['sump5r'];
            $docs = $data['data_sum']['sumDoc'];
            $plk3 = $data['data_sum']['sumplk3'];
            $pasop = $data['data_sum']['sumPsop'];
            $patols = $data['data_sum']['sumPtls'];
            $hadr = $data['data_sum']['sumHdr'];
            $displ = $data['data_sum']['sumDsp'];
            $inis = $data['data_sum']['sumInf'];
            $data['data_countop'] = $this->DataKaryawan_Model->countKritKasi();
            $countKrit = $data['data_countop']['jumKritKasi'];
            $data['data_sum1'] = $this->DataKaryawan_Model->sumAnalyzeKasiResArray();
            $sumEigen = $data['data_sum1'];

            // print_r($countKrit);
            // die;

            $data = array();
            for ($x = 0; $x < sizeof($pro); $x++) {
                $data1[] = [
                    'productivity' => $pro[$x] / $proc,
                    'kerjasamadankom' => $kdk[$x] / $kedako,
                    'pelaksana5r' => $p5r[$x] / $pel5r,
                    'dokumentasi' => $doc[$x] / $docs,
                    'paham_laksana_k3' => $ppk3[$x] / $plk3,
                    'paham_sop' => $psop[$x] / $pasop,
                    'paham_tools' => $ptls[$x] / $patols,
                    'hadir' => $hdr[$x] / $hadr,
                    'disiplin' => $dsp[$x] / $displ,
                    'inisiatif' => $inf[$x] / $inis,
                    'jumlah' => (($pro[$x] / $proc) + ($kdk[$x] / $kedako) + ($p5r[$x] / $pel5r) + ($doc[$x] / $docs) + ($ppk3[$x] / $plk3) + ($psop[$x] / $pasop) + ($ptls[$x] / $patols) + ($hdr[$x] / $hadr) + ($dsp[$x] / $displ) + ($inf[$x] / $inis)),

                    'prioritas' => (($pro[$x] / $proc) + ($kdk[$x] / $kedako) + ($p5r[$x] / $pel5r) + ($doc[$x] / $docs) + ($ppk3[$x] / $plk3) + ($psop[$x] / $pasop) + ($ptls[$x] / $patols) + ($hdr[$x] / $hadr) + ($dsp[$x] / $displ) + ($inf[$x] / $inis)) / $countKrit,

                    'eigen_value' => ((($pro[$x] / $proc) + ($kdk[$x] / $kedako) + ($p5r[$x] / $pel5r) + ($doc[$x] / $docs) + ($ppk3[$x] / $plk3) + ($psop[$x] / $pasop) + ($ptls[$x] / $patols) + ($hdr[$x] / $hadr) + ($dsp[$x] / $displ) + ($inf[$x] / $inis)) / $countKrit) * $sumEigen[$x],

                    'id_matop' => $x + 1 + sizeof($pro),
                ];
            }
            // echo "<pre>";
            // print_r($data1);
            // die;
            // echo "</pre>";
            $query1 = $this->db->update_batch('tb_matriks_op', $data1, 'id_matop');

            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                        Sukses dianalisa
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/pembobotan_KriKepdis');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal dianalisa
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/pembobotan_KriKepdis');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dianalisa tahap nilai
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/pembobotan_KriKepdis');
        }
    }

    //---------------------- End Pembobotan Kriteria KASI ----------------------

    //---------------------- End Analisa Perbandingan ----------------------

























    //---------------------- Subrange Kriteria Operator ----------------------
    public function subrange_KriOp()
    {
        $data['title'] = 'Subrange Kriteria';
        $data['title1'] = 'Productivity';
        $data['title2'] = 'Kerjasama dan Komunikasi';
        $data['title3'] = 'Pelaksanaan 5 R';
        $data['title4'] = 'Dokumentasi';
        $data['title5'] = 'Pemahaman dan Pelaksanaan K3';
        $data['title6'] = 'Pemahaman SOP dan SPK';
        $data['title7'] = 'Pemahaman Tools';
        $data['title8'] = 'Kehadiran';
        $data['title9'] = 'Kedisiplinan';
        $data['title10'] = 'Inisiatif';


        //Productiviity
        $data['subrange_product'] = $this->DataKaryawan_Model->showSubrangeProductivity();
        $data['submatrix_product'] = $this->DataKaryawan_Model->showSubmatrixProductivity();
        $data['count_subproduct'] = $this->DataKaryawan_Model->countSubrangeProductivity();
        $data['sum_subproduct'] = $this->DataKaryawan_Model->sumSubrangeProductivity();
        $data['sum_submatrixproduct'] = $this->DataKaryawan_Model->sumSubmatrixProductivity();


        //Kerjasama dan Komunikasi
        $data['subrange_komdanker'] = $this->DataKaryawan_Model->showSubrangeKomdanKer();
        $data['submatrix_komdanker'] = $this->DataKaryawan_Model->showSubmatrixKomdanKer();
        $data['count_subkomdanker'] = $this->DataKaryawan_Model->countSubrangeKomdanKer();
        $data['sum_subkomdanker'] = $this->DataKaryawan_Model->sumSubrangeKomdanKer();
        $data['sum_submatrixkomdanker'] = $this->DataKaryawan_Model->sumSubmatrixKomdanKer();


        //Pelaksanaan 5 R
        $data['subrange_pelaksana5r'] = $this->DataKaryawan_Model->showSubrangePelaksana5R();
        $data['submatrix_pelaksana5r'] = $this->DataKaryawan_Model->showSubmatrixPelaksana5R();
        $data['count_subpelaksana5r'] = $this->DataKaryawan_Model->countSubrangePelaksana5R();
        $data['sum_subpelaksana5r'] = $this->DataKaryawan_Model->sumSubrangePelaksana5R();
        $data['sum_submatrixpelaksana5r'] = $this->DataKaryawan_Model->sumSubmatrixPelaksana5R();


        //Dokumentasi
        $data['subrange_dokumentasi'] = $this->DataKaryawan_Model->showSubrangeDokumentasi();
        $data['submatrix_dokumentasi'] = $this->DataKaryawan_Model->showSubmatrixDokumentasi();
        $data['count_subdokumentasi'] = $this->DataKaryawan_Model->countSubrangeDokumentasi();
        $data['sum_subdokumentasi'] = $this->DataKaryawan_Model->sumSubrangeDokumentasi();
        $data['sum_submatrixdokumentasi'] = $this->DataKaryawan_Model->sumSubmatrixDokumentasi();


        //Pemahaman dan Pelaksanaan K3
        $data['subrange_pahamdanlaksanak3'] = $this->DataKaryawan_Model->showSubrangePahamdanLaksanaK3();
        $data['submatrix_pahamdanlaksanak3'] = $this->DataKaryawan_Model->showSubmatrixPahamdanLaksanaK3();
        $data['count_subpahamdanlaksanak3'] = $this->DataKaryawan_Model->countSubrangePahamdanLaksanaK3();
        $data['sum_subpahamdanlaksanak3'] = $this->DataKaryawan_Model->sumSubrangePahamdanLaksanaK3();
        $data['sum_submatrixpahamdanlaksanak3'] = $this->DataKaryawan_Model->sumSubmatrixPahamdanLaksanaK3();


        //Pemahaman SOP dan SPK
        $data['subrange_pahamsopspk'] = $this->DataKaryawan_Model->showSubrangePahamSOPSPK();
        $data['submatrix_pahamsopspk'] = $this->DataKaryawan_Model->showSubmatrixPahamSOPSPK();
        $data['count_subpahamsopspk'] = $this->DataKaryawan_Model->countSubrangePahamSOPSPK();
        $data['sum_subpahamsopspk'] = $this->DataKaryawan_Model->sumSubrangePahamSOPSPK();
        $data['sum_submatrixpahamsopspk'] = $this->DataKaryawan_Model->sumSubmatrixPahamSOPSPK();


        //Pemahaman Tools
        $data['subrange_pahamtools'] = $this->DataKaryawan_Model->showSubrangePahamTools();
        $data['submatrix_pahamtools'] = $this->DataKaryawan_Model->showSubmatrixPahamTools();
        $data['count_subpahamtools'] = $this->DataKaryawan_Model->countSubrangePahamTools();
        $data['sum_subpahamtools'] = $this->DataKaryawan_Model->sumSubrangePahamTools();
        $data['sum_submatrixpahamtools'] = $this->DataKaryawan_Model->sumSubmatrixPahamTools();


        //Kehadiran
        $data['subrange_kehadiran'] = $this->DataKaryawan_Model->showSubrangeKehadiran();
        $data['submatrix_kehadiran'] = $this->DataKaryawan_Model->showSubmatrixKehadiran();
        $data['count_subkehadiran'] = $this->DataKaryawan_Model->countSubrangeKehadiran();
        $data['sum_subkehadiran'] = $this->DataKaryawan_Model->sumSubrangeKehadiran();
        $data['sum_submatrixkehadiran'] = $this->DataKaryawan_Model->sumSubmatrixKehadiran();


        //Kedisiplinan
        $data['subrange_kedisiplinan'] = $this->DataKaryawan_Model->showSubrangeKedisiplinan();
        $data['submatrix_kedisiplinan'] = $this->DataKaryawan_Model->showSubmatrixKedisiplinan();
        $data['count_subkedisiplinan'] = $this->DataKaryawan_Model->countSubrangeKedisiplinan();
        $data['sum_subkedisiplinan'] = $this->DataKaryawan_Model->sumSubrangeKedisiplinan();
        $data['sum_submatrixkedisiplinan'] = $this->DataKaryawan_Model->sumSubmatrixKedisiplinan();


        //Inisiatif
        $data['subrange_inisiatif'] = $this->DataKaryawan_Model->showSubrangeInisiatif();
        $data['submatrix_inisiatif'] = $this->DataKaryawan_Model->showSubmatrixInisiatif();
        $data['count_subinisiatif'] = $this->DataKaryawan_Model->countSubrangeInisiatif();
        $data['sum_subinisiatif'] = $this->DataKaryawan_Model->sumSubrangeInisiatif();
        $data['sum_submatrixinisiatif'] = $this->DataKaryawan_Model->sumSubmatrixInisiatif();


        // 
        $data['data_nilban'] = $this->m_data_nilai->tampil_nilai()->result_array();
        $data['data_nilban1'] = $this->m_data_nilai->tampil_nilai_awal()->result_array();
        // 
        $data['ri'] = 0.90;
        //
        $data['ri3'] = 0.58;
        //
        $data['ri8'] = 1.41;

        $data['title'] = 'subrange_KriOp';
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_subrange_op', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }





    //---------------------------------------------------------- Productivity ------------------------------------------------------------
    public function update_subrange_Productivity()
    {
        $_90 = $this->input->post('pekerjaan_90[]');
        $_8090 = $this->input->post('pekerjaan_80_90[]');
        $_6079 = $this->input->post('pekerjaan_60_79[]');
        $_59 = $this->input->post('pekerjaan_59[]');
        $data = array();
        for ($x = 0; $x < sizeof($_90); $x++) {
            $data[] = [
                'pekerjaan_90' => $_90[$x],
                'pekerjaan_80_90' => $_8090[$x],
                'pekerjaan_60_79' => $_6079[$x],
                'pekerjaan_59' => $_59[$x],
                'id_subrange_proc' => $x + 1,
            ];
        }
        $query = $this->db->update_batch('tb_subrange_productivity', $data, 'id_subrange_proc');
        if ($query) {
            $data['sum_subproduct'] = $this->DataKaryawan_Model->sumSubrangeProductivity();
            $sum90 = $data['sum_subproduct']['sum90'];
            $sum8090 = $data['sum_subproduct']['sum8090'];
            $sum6079 = $data['sum_subproduct']['sum6079'];
            $sum59 = $data['sum_subproduct']['sum59'];

            $data['count_subproduct'] = $this->DataKaryawan_Model->countSubrangeProductivity();
            $count_subproduct = $data['count_subproduct']['jumSubProc'];

            $data['sumArray_subproduct'] = $this->DataKaryawan_Model->sumSubrangeProductivityOPResArray();
            $sumSubProducEigen = $data['sumArray_subproduct'];

            $data = array();
            for ($x = 0; $x < sizeof($_90); $x++) {
                $data[] = [
                    'pekerjaan_90' => $_90[$x] / $sum90,
                    'pekerjaan_80_90' => $_8090[$x] / $sum8090,
                    'pekerjaan_60_79' => $_6079[$x] / $sum6079,
                    'pekerjaan_59' => $_59[$x] / $sum59,
                    'jumlah' => (($_90[$x] / $sum90) + ($_8090[$x] / $sum8090) + ($_6079[$x] / $sum6079) + ($_59[$x] / $sum59)),

                    'prioritas' => (($_90[$x] / $sum90) + ($_8090[$x] / $sum8090) + ($_6079[$x] / $sum6079) + ($_59[$x] / $sum59)) / $count_subproduct,

                    'eigen_value' => ((($_90[$x] / $sum90) + ($_8090[$x] / $sum8090) + ($_6079[$x] / $sum6079) + ($_59[$x] / $sum59)) / $count_subproduct) * $sumSubProducEigen[$x],

                    'id_submatrix_proc' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_productivity', $data, 'id_submatrix_proc');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                        Sukses dianalisa Subrange Productivity
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal dianalisa Subrange Productivity
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dianalisa tahap nilai Productivity
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }






    //---------------------------------------------------------- Kerjasama dan Komunikasi ------------------------------------------------------------
    public function update_subrange_KerjasamadanKomunikasi()
    {
        $_sb = $this->input->post('sangat_baik[]');
        $_baik = $this->input->post('baik[]');
        $_krg = $this->input->post('kurang[]');
        $_tkm = $this->input->post('tidak_mampu[]');
        $data = array();
        for ($x = 0; $x < sizeof($_sb); $x++) {
            $data[] = [
                'sangat_baik' => $_sb[$x],
                'baik' => $_baik[$x],
                'kurang' => $_krg[$x],
                'tidak_mampu' => $_tkm[$x],
                'id_subrange_kdk' => $x + 1,
            ];
        }
        $query = $this->db->update_batch('tb_subrange_komdanker', $data, 'id_subrange_kdk');
        if ($query) {
            $data['sum_subkomdanker'] = $this->DataKaryawan_Model->sumSubrangeKomdanKer();
            $sumSB = $data['sum_subkomdanker']['sumSB'];
            $sumBaik = $data['sum_subkomdanker']['sumBaik'];
            $sumKurang = $data['sum_subkomdanker']['sumKurang'];
            $sumTK = $data['sum_subkomdanker']['sumTK'];

            $data['count_subkomdanker'] = $this->DataKaryawan_Model->countSubrangeKomdanKer();
            $count_subkomdanker = $data['count_subkomdanker']['jumSubKdk'];

            $data['sumArray_subkomdanker'] = $this->DataKaryawan_Model->sumSubrangeKomdanKerOPResArray();
            $sumSubKomdankerEigen = $data['sumArray_subkomdanker'];

            $data = array();
            for ($x = 0; $x < sizeof($_sb); $x++) {
                $data[] = [
                    'sangat_baik' => $_sb[$x] / $sumSB,
                    'baik' => $_baik[$x] / $sumBaik,
                    'kurang' => $_krg[$x] / $sumKurang,
                    'tidak_mampu' => $_tkm[$x] / $sumTK,
                    'jumlah' => (($_sb[$x] / $sumSB) + ($_baik[$x] / $sumBaik) + ($_krg[$x] / $sumKurang) + ($_tkm[$x] / $sumTK)),

                    'prioritas' => (($_sb[$x] / $sumSB) + ($_baik[$x] / $sumBaik) + ($_krg[$x] / $sumKurang) + ($_tkm[$x] / $sumTK)) / $count_subkomdanker,

                    'eigen_value' => ((($_sb[$x] / $sumSB) + ($_baik[$x] / $sumBaik) + ($_krg[$x] / $sumKurang) + ($_tkm[$x] / $sumTK)) / $count_subkomdanker) * $sumSubKomdankerEigen[$x],

                    'id_submatrix_kdk' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_komdanker', $data, 'id_submatrix_kdk');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                        Sukses dianalisa Subrange Kerjasama dan Komunikasi
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal dianalisa Subrange Kerjasama dan Komunikasi
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dianalisa tahap nilai Kerjasama dan Komunikasi
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Pelaksanaan 5R ------------------------------------------------------------
    public function update_subrange_Pelaksana5R()
    {
        $_laks = $this->input->post('melaksanakan[]');
        $_kurlaks = $this->input->post('kurang_melaksanakan[]');
        $_tidlaks = $this->input->post('tidak_melaksanakan[]');
        $data = array();
        for ($x = 0; $x < sizeof($_laks); $x++) {
            $data[] = [
                'melaksanakan' => $_laks[$x],
                'kurang_melaksanakan' => $_kurlaks[$x],
                'tidak_melaksanakan' => $_tidlaks[$x],
                'id_subrange_p5r' => $x + 1,
            ];
        }
        $query = $this->db->update_batch('tb_subrange_pelaksana5r', $data, 'id_subrange_p5r');
        if ($query) {
            $data['sum_subpelaksana5r'] = $this->DataKaryawan_Model->sumSubrangePelaksana5R();
            $sumLaks = $data['sum_subpelaksana5r']['sumLaks'];
            $sumKurLaks = $data['sum_subpelaksana5r']['sumKurLaks'];
            $sumTidLaks = $data['sum_subpelaksana5r']['sumTidLaks'];

            $data['count_subpelaksana5r'] = $this->DataKaryawan_Model->countSubrangePelaksana5R();
            $count_subpelaksana5r = $data['count_subpelaksana5r']['jumSubp5r'];

            $data['sumArray_subpelaksana5r'] = $this->DataKaryawan_Model->sumSubrangePelaksana5ROPResArray();
            $sumSubPelaksana5r = $data['sumArray_subpelaksana5r'];

            $data = array();
            for ($x = 0; $x < sizeof($_laks); $x++) {
                $data[] = [
                    'melaksanakan' => $_laks[$x] / $sumLaks,
                    'kurang_melaksanakan' => $_kurlaks[$x] / $sumKurLaks,
                    'tidak_melaksanakan' => $_tidlaks[$x] / $sumTidLaks,
                    'jumlah' => (($_laks[$x] / $sumLaks) + ($_kurlaks[$x] / $sumKurLaks) + ($_tidlaks[$x] / $sumTidLaks)),

                    'prioritas' => (($_laks[$x] / $sumLaks) + ($_kurlaks[$x] / $sumKurLaks) + ($_tidlaks[$x] / $sumTidLaks)) / $count_subpelaksana5r,

                    'eigen_value' => ((($_laks[$x] / $sumLaks) + ($_kurlaks[$x] / $sumKurLaks) + ($_tidlaks[$x] / $sumTidLaks)) / $count_subpelaksana5r) * $sumSubPelaksana5r[$x],

                    'id_submatrix_p5r' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_pelaksana5r', $data, 'id_submatrix_p5r');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                        Sukses dianalisa Subrange Pelaksanaan 5 R
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal dianalisa Subrange Pelaksanaan 5 R
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dianalisa tahap nilai Pelaksanaan 5 R
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Dokumentasi ------------------------------------------------------------
    public function update_subrange_dokumentasi()
    {
        $_sgtlkpsesuai = $this->input->post('sangat_lengkap_sesuai[]');
        $_lengkap = $this->input->post('lengkap[]');
        $_krglkptdksesuai = $this->input->post('kurang_lengkap_tidak_sesuai[]');
        $_tidakmampu = $this->input->post('tidak_mampu[]');
        $data = array();
        for ($x = 0; $x < sizeof($_sgtlkpsesuai); $x++) {
            $data[] = [
                'sgt_lkp_sesuai' => $_sgtlkpsesuai[$x],
                'lkp' => $_lengkap[$x],
                'krg_lkp_tdk_sesuai' => $_krglkptdksesuai[$x],
                'tidak_mampu' => $_tidakmampu[$x],
                'id_subrange_doc' => $x + 1,
            ];
        }
        $query = $this->db->update_batch('tb_subrange_dokumentasi', $data, 'id_subrange_doc');
        if ($query) {
            $data['sum_subdokumentasi'] = $this->DataKaryawan_Model->sumSubrangeDokumentasi();
            $sumSLS = $data['sum_subdokumentasi']['sumSLS'];
            $sumLengkap = $data['sum_subdokumentasi']['sumLengkap'];
            $sumKLTS = $data['sum_subdokumentasi']['sumKLTS'];
            $sumTdkMampu = $data['sum_subdokumentasi']['sumTdkMampu'];

            $data['count_subdokumentasi'] = $this->DataKaryawan_Model->countSubrangeDokumentasi();
            $count_subdokumentasi = $data['count_subdokumentasi']['jumSubDoc'];

            $data['sumArray_subdokumentasi'] = $this->DataKaryawan_Model->sumSubrangeDokumentasiOPResArray();
            $sumSubDokumentasi = $data['sumArray_subdokumentasi'];

            $data = array();
            for ($x = 0; $x < sizeof($_sgtlkpsesuai); $x++) {
                $data[] = [
                    'sgt_lkp_sesuai' => $_sgtlkpsesuai[$x] / $sumSLS,
                    'lkp' => $_lengkap[$x] / $sumLengkap,
                    'krg_lkp_tdk_sesuai' => $_krglkptdksesuai[$x] / $sumKLTS,
                    'tidak_mampu' => $_tidakmampu[$x] / $sumTdkMampu,
                    'jumlah' => (($_sgtlkpsesuai[$x] / $sumSLS) + ($_lengkap[$x] / $sumLengkap) + ($_krglkptdksesuai[$x] / $sumKLTS) + ($_tidakmampu[$x] / $sumTdkMampu)),

                    'prioritas' => (($_sgtlkpsesuai[$x] / $sumSLS) + ($_lengkap[$x] / $sumLengkap) + ($_krglkptdksesuai[$x] / $sumKLTS) + ($_tidakmampu[$x] / $sumTdkMampu)) / $count_subdokumentasi,

                    'eigen_value' => ((($_sgtlkpsesuai[$x] / $sumSLS) + ($_lengkap[$x] / $sumLengkap) + ($_krglkptdksesuai[$x] / $sumKLTS) + ($_tidakmampu[$x] / $sumTdkMampu)) / $count_subdokumentasi) * $sumSubDokumentasi[$x],

                    'id_submatrix_doc' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_dokumentasi', $data, 'id_submatrix_doc');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                        Sukses dianalisa Subrange Dokeumentasi
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal dianalisa Subrange Dokeumentasi
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dianalisa tahap nilai Dokeumentasi
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Pemahaman dan Pelaksanaan K3 ------------------------------------------------------------
    public function update_subrange_pahamdanlaksanak3()
    {
        $_phm = $this->input->post('paham[]');
        $_kurphm = $this->input->post('kurang_paham[]');
        $_tidphm = $this->input->post('tidak_paham[]');
        $data = array();
        for ($x = 0; $x < sizeof($_phm); $x++) {
            $data[] = [
                'paham' => $_phm[$x],
                'kurang_paham' => $_kurphm[$x],
                'tidak_paham' => $_tidphm[$x],
                'id_subrange_plk3' => $x + 1,
            ];
        }
        // echo "<pre>";
        // echo sizeof($_phm) + 1;
        // die;
        // echo "</pre>";
        $query = $this->db->update_batch('tb_subrange_pahamdanlaksanak3', $data, 'id_subrange_plk3');
        if ($query) {
            $data['sum_subpahamdanlaksanak3'] = $this->DataKaryawan_Model->sumSubrangePahamdanLaksanaK3();
            $sumPHM = $data['sum_subpahamdanlaksanak3']['sumPHM'];
            $sumKrgPhm = $data['sum_subpahamdanlaksanak3']['sumKrgPhm'];
            $sumTdkPhm = $data['sum_subpahamdanlaksanak3']['sumTdkPhm'];

            $data['count_subpahamdanlaksanak3'] = $this->DataKaryawan_Model->countSubrangePahamdanLaksanaK3();
            $count_subpahamdanlaksanak3 = $data['count_subpahamdanlaksanak3']['jumSubPLK3'];

            $data['sumArray_subpahamdanlaksanak3'] = $this->DataKaryawan_Model->sumSubrangePahamdanLaksanaK3OPResArray();
            $sumSubPahamdanLaksanaK3 = $data['sumArray_subpahamdanlaksanak3'];

            $data = array();
            for ($x = 0; $x < sizeof($_phm); $x++) {
                $data[] = [
                    'paham' => $_phm[$x] / $sumPHM,
                    'kurang_paham' => $_kurphm[$x] / $sumKrgPhm,
                    'tidak_paham' => $_tidphm[$x] / $sumTdkPhm,
                    'jumlah' => (($_phm[$x] / $sumPHM) + ($_kurphm[$x] / $sumKrgPhm) + ($_tidphm[$x] / $sumTdkPhm)),

                    'prioritas' => (($_phm[$x] / $sumPHM) + ($_kurphm[$x] / $sumKrgPhm) + ($_tidphm[$x] / $sumTdkPhm)) / $count_subpahamdanlaksanak3,

                    'eigen_value' => ((($_phm[$x] / $sumPHM) + ($_kurphm[$x] / $sumKrgPhm) + ($_tidphm[$x] / $sumTdkPhm)) / $count_subpahamdanlaksanak3) * $sumSubPahamdanLaksanaK3[$x],

                    'id_submatrix_plk3' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_pahamdanlaksanak3', $data, 'id_submatrix_plk3');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                         Sukses dianalisa Subrange Pemahaman dan Laksana K 3
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         Gagal dianalisa Subrange Pemahaman dan Laksana K 3
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Gagal dianalisa tahap nilai Pemahaman dan Laksana K 3
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Pemahaman SOP dan SPK ------------------------------------------------------------
    public function update_subrange_pahamsopspk()
    {
        $_sgt_mampu = $this->input->post('sangat_mampu[]');
        $_mampu = $this->input->post('mampu[]');
        $_krg_mampu = $this->input->post('kurang_mampu[]');
        $_tdk_mampu = $this->input->post('tidak_mampu[]');
        $data = array();
        for ($x = 0; $x < sizeof($_sgt_mampu); $x++) {
            $data[] = [
                'sangat_mampu' => $_sgt_mampu[$x],
                'mampu' => $_mampu[$x],
                'kurang_mampu' => $_krg_mampu[$x],
                'tidak_mampu' => $_tdk_mampu[$x],
                'id_subrange_pss' => $x + 1,
            ];
        }
        // echo "<pre>";
        // echo sizeof($_phm) + 1;
        // die;
        // echo "</pre>";
        $query = $this->db->update_batch('tb_subrange_pahamsopspk', $data, 'id_subrange_pss');
        if ($query) {
            $data['sum_subpahamsopspk'] = $this->DataKaryawan_Model->sumSubrangePahamSOPSPK();
            $sumSgtMampu = $data['sum_subpahamsopspk']['sumSgtMampu'];
            $sumMampu = $data['sum_subpahamsopspk']['sumMampu'];
            $sumKrgMampu = $data['sum_subpahamsopspk']['sumKrgMampu'];
            $sumTdkMampu = $data['sum_subpahamsopspk']['sumTdkMampu'];

            $data['count_subpahamsopspk'] = $this->DataKaryawan_Model->countSubrangePahamSOPSPK();
            $count_subpahamsopspk = $data['count_subpahamsopspk']['jumSubPSS'];

            $data['sumArray_subpahamsopspk'] = $this->DataKaryawan_Model->sumSubrangePahamSOPSPKOPResArray();
            $sumSubPahamSOPSPK = $data['sumArray_subpahamsopspk'];

            $data = array();
            for ($x = 0; $x < sizeof($_sgt_mampu); $x++) {
                $data[] = [
                    'sangat_mampu' => $_sgt_mampu[$x] / $sumSgtMampu,
                    'mampu' => $_mampu[$x] / $sumMampu,
                    'kurang_mampu' => $_krg_mampu[$x] / $sumKrgMampu,
                    'tidak_mampu' => $_tdk_mampu[$x] / $sumTdkMampu,
                    'jumlah' => (($_sgt_mampu[$x] / $sumSgtMampu) + ($_mampu[$x] / $sumMampu) + ($_krg_mampu[$x] / $sumKrgMampu) + ($_tdk_mampu[$x] / $sumTdkMampu)),

                    'prioritas' => (($_sgt_mampu[$x] / $sumSgtMampu) + ($_mampu[$x] / $sumMampu) + ($_krg_mampu[$x] / $sumKrgMampu) + ($_tdk_mampu[$x] / $sumTdkMampu)) / $count_subpahamsopspk,

                    'eigen_value' => ((($_sgt_mampu[$x] / $sumSgtMampu) + ($_mampu[$x] / $sumMampu) + ($_krg_mampu[$x] / $sumKrgMampu) + ($_tdk_mampu[$x] / $sumTdkMampu)) / $count_subpahamsopspk) * $sumSubPahamSOPSPK[$x],

                    'id_submatrix_pss' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_pahamsopspk', $data, 'id_submatrix_pss');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                         Sukses dianalisa Subrange Pemahaman SOP dan SPK
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         Gagal dianalisa Subrange Pemahaman SOP dan SPK
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Gagal dianalisa tahap nilai Pemahaman SOP dan SPK
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Pemahaman Tools ------------------------------------------------------------
    public function update_subrange_pahamtools()
    {
        $_baik = $this->input->post('baik[]');
        $_krg_baik = $this->input->post('kurang_baik[]');
        $_tdk_baik = $this->input->post('tidak_baik[]');
        $data = array();
        for ($x = 0; $x < sizeof($_baik); $x++) {
            $data[] = [
                'baik' => $_baik[$x],
                'kurang_baik' => $_krg_baik[$x],
                'tidak_baik' => $_tdk_baik[$x],
                'id_subrange_ptls' => $x + 1,
            ];
        }
        // echo "<pre>";
        // echo sizeof($_phm) + 1;
        // die;
        // echo "</pre>";
        $query = $this->db->update_batch('tb_subrange_pahamtools', $data, 'id_subrange_ptls');
        if ($query) {
            $data['sum_subpahamtools'] = $this->DataKaryawan_Model->sumSubrangePahamTools();
            $sumBaik = $data['sum_subpahamtools']['sumBaik'];
            $sumKrgBaik = $data['sum_subpahamtools']['sumKrgBaik'];
            $sumTdkBaik = $data['sum_subpahamtools']['sumTdkBaik'];

            $data['count_subpahamtools'] = $this->DataKaryawan_Model->countSubrangePahamTools();
            $count_subpahamtools = $data['count_subpahamtools']['jumSubPTLS'];

            $data['sumArray_subpahamtools'] = $this->DataKaryawan_Model->sumSubrangePahamToolsOPResArray();
            $sumSubPahamTools = $data['sumArray_subpahamtools'];

            $data = array();
            for ($x = 0; $x < sizeof($_baik); $x++) {
                $data[] = [
                    'baik' => $_baik[$x] / $sumBaik,
                    'kurang_baik' => $_krg_baik[$x] / $sumKrgBaik,
                    'tidak_baik' => $_tdk_baik[$x] / $sumTdkBaik,
                    'jumlah' => (($_baik[$x] / $sumBaik) + ($_krg_baik[$x] / $sumKrgBaik) + ($_tdk_baik[$x] / $sumTdkBaik)),

                    'prioritas' => (($_baik[$x] / $sumBaik) + ($_krg_baik[$x] / $sumKrgBaik) + ($_tdk_baik[$x] / $sumTdkBaik)) / $count_subpahamtools,

                    'eigen_value' => ((($_baik[$x] / $sumBaik) + ($_krg_baik[$x] / $sumKrgBaik) + ($_tdk_baik[$x] / $sumTdkBaik)) / $count_subpahamtools) * $sumSubPahamTools[$x],

                    'id_submatrix_ptls' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_pahamtools', $data, 'id_submatrix_ptls');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                         Sukses dianalisa Subrange Pemahaman Tools
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         Gagal dianalisa Subrange Pemahaman Tools
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Gagal dianalisa tahap nilai Pemahaman Tools
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Kehadiran ------------------------------------------------------------
    public function update_subrange_kehadiran()
    {
        $_hadir100 = $this->input->post('hadir100[]');
        $_hadir100t = $this->input->post('hadir100t[]');
        $_hadir90 = $this->input->post('hadir90[]');
        $_hadir90t = $this->input->post('hadir90t[]');
        $_hadir80 = $this->input->post('hadir80[]');
        $_hadir80t = $this->input->post('hadir80t[]');
        $_hadir70 = $this->input->post('hadir70[]');
        $_hadir70t = $this->input->post('hadir70t[]');
        $data = array();
        for ($x = 0; $x < sizeof($_hadir100); $x++) {
            $data[] = [
                'hadir100' => $_hadir100[$x],
                'hadir100t' => $_hadir100t[$x],
                'hadir90' => $_hadir90[$x],
                'hadir90t' => $_hadir90t[$x],
                'hadir80' => $_hadir80[$x],
                'hadir80t' => $_hadir80t[$x],
                'hadir70' => $_hadir70[$x],
                'hadir70t' => $_hadir70t[$x],
                'id_subrange_hdr' => $x + 1,
            ];
        }
        // echo "<pre>";
        // echo sizeof($_phm) + 1;
        // die;
        // echo "</pre>";
        $query = $this->db->update_batch('tb_subrange_kehadiran', $data, 'id_subrange_hdr');
        if ($query) {
            $data['sum_subkehadiran'] = $this->DataKaryawan_Model->sumSubrangeKehadiran();
            $sum100 = $data['sum_subkehadiran']['sum100'];
            $sum100t = $data['sum_subkehadiran']['sum100t'];
            $sum90 = $data['sum_subkehadiran']['sum90'];
            $sum90t = $data['sum_subkehadiran']['sum90t'];
            $sum80 = $data['sum_subkehadiran']['sum80'];
            $sum80t = $data['sum_subkehadiran']['sum80t'];
            $sum70 = $data['sum_subkehadiran']['sum70'];
            $sum70t = $data['sum_subkehadiran']['sum70t'];

            $data['count_subkehadiran'] = $this->DataKaryawan_Model->countSubrangeKehadiran();
            $count_subkehadiran = $data['count_subkehadiran']['jumSubHDR'];

            $data['sumArray_subkehadiran'] = $this->DataKaryawan_Model->sumSubrangeKehadiranOPResArray();
            $sumSubKehadiran = $data['sumArray_subkehadiran'];

            $data = array();
            for ($x = 0; $x < sizeof($_hadir100); $x++) {
                $data[] = [
                    'hadir100' => $_hadir100[$x] / $sum100,
                    'hadir100t' => $_hadir100t[$x] / $sum100t,
                    'hadir90' => $_hadir90[$x] / $sum90,
                    'hadir90t' => $_hadir90t[$x] / $sum90t,
                    'hadir80' => $_hadir80[$x] / $sum80,
                    'hadir80t' => $_hadir80t[$x] / $sum80t,
                    'hadir70' => $_hadir70[$x] / $sum70,
                    'hadir70t' => $_hadir70t[$x] / $sum70t,
                    'jumlah' => (($_hadir100[$x] / $sum100) + ($_hadir100t[$x] / $sum100t) + ($_hadir90[$x] / $sum90) + ($_hadir90t[$x] / $sum90t) + ($_hadir80[$x] / $sum80) + ($_hadir80t[$x] / $sum80t) + ($_hadir70[$x] / $sum70) + ($_hadir70t[$x] / $sum70t)),

                    'prioritas' => (($_hadir100[$x] / $sum100) + ($_hadir100t[$x] / $sum100t) + ($_hadir90[$x] / $sum90) + ($_hadir90t[$x] / $sum90t) + ($_hadir80[$x] / $sum80) + ($_hadir80t[$x] / $sum80t) + ($_hadir70[$x] / $sum70) + ($_hadir70t[$x] / $sum70t)) / $count_subkehadiran,

                    'eigen_value' => ((($_hadir100[$x] / $sum100) + ($_hadir100t[$x] / $sum100t) + ($_hadir90[$x] / $sum90) + ($_hadir90t[$x] / $sum90t) + ($_hadir80[$x] / $sum80) + ($_hadir80t[$x] / $sum80t) + ($_hadir70[$x] / $sum70) + ($_hadir70t[$x] / $sum70t)) / $count_subkehadiran) * $sumSubKehadiran[$x],

                    'id_submatrix_hdr' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_kehadiran', $data, 'id_submatrix_hdr');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                         Sukses dianalisa Subrange Kehadiran
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         Gagal dianalisa Subrange Kehadiran
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Gagal dianalisa tahap nilai Kehadiran
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Kedisiplinan ------------------------------------------------------------
    public function update_subrange_kedisiplinan()
    {
        $_tidak_melanggar = $this->input->post('tidak_melanggar[]');
        $_sedikit_melanggar = $this->input->post('sedikit_melanggar[]');
        $_banyak_melanggar = $this->input->post('banyak_melanggar[]');
        $data = array();
        for ($x = 0; $x < sizeof($_tidak_melanggar); $x++) {
            $data[] = [
                'tidak_melanggar' => $_tidak_melanggar[$x],
                'sedikit_melanggar' => $_sedikit_melanggar[$x],
                'banyak_melanggar' => $_banyak_melanggar[$x],
                'id_subrange_dsp' => $x + 1,
            ];
        }
        // echo "<pre>";
        // echo sizeof($_phm) + 1;
        // die;
        // echo "</pre>";
        $query = $this->db->update_batch('tb_subrange_kedisiplinan', $data, 'id_subrange_dsp');
        if ($query) {
            $data['sum_subkedisiplinan'] = $this->DataKaryawan_Model->sumSubrangeKedisiplinan();
            $sumTDK_MLGR = $data['sum_subkedisiplinan']['sumTDK_MLGR'];
            $sumSDK_MLGR = $data['sum_subkedisiplinan']['sumSDK_MLGR'];
            $sumBYK_MLGR = $data['sum_subkedisiplinan']['sumBYK_MLGR'];

            $data['count_subkedisiplinan'] = $this->DataKaryawan_Model->countSubrangeKedisiplinan();
            $count_subkedisiplinan = $data['count_subkedisiplinan']['jumSubDSP'];

            $data['sumArray_subkedisiplinan'] = $this->DataKaryawan_Model->sumSubrangeKedisiplinanOPResArray();
            $sumSubDisiplin = $data['sumArray_subkedisiplinan'];

            $data = array();
            for ($x = 0; $x < sizeof($_tidak_melanggar); $x++) {
                $data[] = [
                    'tidak_melanggar' => $_tidak_melanggar[$x] / $sumTDK_MLGR,
                    'sedikit_melanggar' => $_sedikit_melanggar[$x] / $sumSDK_MLGR,
                    'banyak_melanggar' => $_banyak_melanggar[$x] / $sumBYK_MLGR,
                    'jumlah' => (($_tidak_melanggar[$x] / $sumTDK_MLGR) + ($_sedikit_melanggar[$x] / $sumSDK_MLGR) + ($_banyak_melanggar[$x] / $sumBYK_MLGR)),

                    'prioritas' => (($_tidak_melanggar[$x] / $sumTDK_MLGR) + ($_sedikit_melanggar[$x] / $sumSDK_MLGR) + ($_banyak_melanggar[$x] / $sumBYK_MLGR)) / $count_subkedisiplinan,

                    'eigen_value' => ((($_tidak_melanggar[$x] / $sumTDK_MLGR) + ($_sedikit_melanggar[$x] / $sumSDK_MLGR) + ($_banyak_melanggar[$x] / $sumBYK_MLGR)) / $count_subkedisiplinan) * $sumSubDisiplin[$x],

                    'id_submatrix_dsp' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_kedisiplinan', $data, 'id_submatrix_dsp');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                         Sukses dianalisa Subrange Kedisiplinan
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         Gagal dianalisa Subrange Kedisiplinan
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Gagal dianalisa tahap nilai Kedisiplinan
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }







    //---------------------------------------------------------- Inisiatif ------------------------------------------------------------
    public function update_subrange_inisiatif()
    {
        $_sangat_bagus = $this->input->post('sangat_bagus[]');
        $_bagus = $this->input->post('bagus[]');
        $_kurang_bagus = $this->input->post('kurang_bagus[]');
        $_tidak_bagus = $this->input->post('tidak_bagus[]');
        $data = array();
        for ($x = 0; $x < sizeof($_sangat_bagus); $x++) {
            $data[] = [
                'sangat_bagus' => $_sangat_bagus[$x],
                'bagus' => $_bagus[$x],
                'kurang_bagus' => $_kurang_bagus[$x],
                'tidak_bagus' => $_tidak_bagus[$x],
                'id_subrange_inf' => $x + 1,
            ];
        }
        // echo "<pre>";
        // echo sizeof($_phm) + 1;
        // die;
        // echo "</pre>";
        $query = $this->db->update_batch('tb_subrange_inisiatif', $data, 'id_subrange_inf');
        if ($query) {
            $data['sum_subinisiatif'] = $this->DataKaryawan_Model->sumSubrangeInisiatif();
            $sumSGT_BGS = $data['sum_subinisiatif']['sumSGT_BGS'];
            $sumBGS = $data['sum_subinisiatif']['sumBGS'];
            $sumKRG_BGS = $data['sum_subinisiatif']['sumKRG_BGS'];
            $sumTDK_BGS = $data['sum_subinisiatif']['sumTDK_BGS'];

            $data['count_subinisiatif'] = $this->DataKaryawan_Model->countSubrangeInisiatif();
            $count_subinisiatif = $data['count_subinisiatif']['jumSubINF'];

            $data['sumArray_subinisiatif'] = $this->DataKaryawan_Model->sumSubrangeInisiatifOPResArray();
            $sumSubInisiatif = $data['sumArray_subinisiatif'];

            $data = array();
            for ($x = 0; $x < sizeof($_sangat_bagus); $x++) {
                $data[] = [
                    'sangat_bagus' => $_sangat_bagus[$x] / $sumSGT_BGS,
                    'bagus' => $_bagus[$x] / $sumBGS,
                    'kurang_bagus' => $_kurang_bagus[$x] / $sumKRG_BGS,
                    'tidak_bagus' => $_tidak_bagus[$x] / $sumTDK_BGS,
                    'jumlah' => (($_sangat_bagus[$x] / $sumSGT_BGS) + ($_bagus[$x] / $sumBGS) + ($_kurang_bagus[$x] / $sumKRG_BGS) + ($_tidak_bagus[$x] / $sumTDK_BGS)),

                    'prioritas' => (($_sangat_bagus[$x] / $sumSGT_BGS) + ($_bagus[$x] / $sumBGS) + ($_kurang_bagus[$x] / $sumKRG_BGS) + ($_tidak_bagus[$x] / $sumTDK_BGS)) / $count_subinisiatif,

                    'eigen_value' => ((($_sangat_bagus[$x] / $sumSGT_BGS) + ($_bagus[$x] / $sumBGS) + ($_kurang_bagus[$x] / $sumKRG_BGS) + ($_tidak_bagus[$x] / $sumTDK_BGS)) / $count_subinisiatif) * $sumSubInisiatif[$x],

                    'id_submatrix_inf' => $x + 1,
                ];
            }
            $query1 = $this->db->update_batch('tb_submatriks_inisiatif', $data, 'id_submatrix_inf');
            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success success-dismissible fade show" role="alert">
                         Sukses dianalisa Subrange Inisiatif
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         Gagal dianalisa Subrange Inisiatif
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('admin/master_data/subrange_KriOp');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Gagal dianalisa tahap nilai Inisiatif
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
            redirect('admin/master_data/subrange_KriOp');
        }
    }
    //---------------------- End Subrange Kriteria Operator ----------------------
















    //

    public function tampil_kriteria_kasi()
    {
        $data['title'] = 'tampil_kriteria_kasi';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['kriteria_kasi'] = $this->m_data_kriteria->tampil_kriteria_kasi()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_kriteria_kasi', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    public function tambah_kriteria_kasi()
    {

        $idDivisiInt = 0;
        // Membuat fungsi untuk melakukan penambahan id produk secara otomatis
        // Mendapatkan jumlah produk yang ada di database
        $jumlahKriteriaKasi = $this->m_data_kriteria->tampil_kriteria_kasi()->num_rows();
        // Jika jumlah produk lebih dari 0
        if ($jumlahKriteriaKasi > 0) {
            // Mengambil id produk sebelumnya
            $lastId = $this->m_data_kriteria->tampil_kriteria_akhir_kasi()->result();
            // Melakukan perulangan untuk mengambil data
            foreach ($lastId as $row) {
                // Melakukan pemisahan huruf dengan angka pada id produk
                $rawIdKriteriaKasi = substr($row->id_kriteria_kasi, 3);
                // Melakukan konversi nilai pemisahan huruf dengan angka pada id order menjadi integer
                $idKriteriaKasiInt = intval($rawIdKriteriaKasi);

                // Menghitung panjang id yang sudah menjadi integer
                if (strlen($idKriteriaKasiInt) == 1) {
                    // jika panjang id hanya 1 angka
                    $id_kriteria_kasi = "KKS00" . ($idKriteriaKasiInt + 1);
                } else if (strlen($idDivisiInt) == 2) {
                    // jika panjang id hanya 2 angka
                    $id_kriteria_kasi = "KKS0" . ($idKriteriaKasiInt + 1);
                } else if (strlen($idKriteriaKasiInt) == 3) {
                    // jika panjang id hanya 3 angka
                    $id_kriteria_kasi = "KKS" . ($idKriteriaKasiInt + 1);
                }
            }
        } else {
            // Jika jumlah paket soal kurang dari sama dengan 0
            $id_kriteria_kasi = "KKS001";
        }


        $data = array(
            'id_kriteria_kasi' =>  $id_kriteria_kasi
        );
        $data['title'] = 'tambah_kriteria_kasi';
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_tambah_kriteria_kasi', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function aksitambah_kriteria_kasi()
    {
        // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
        $id_kriteria_kasi = $this->input->post('id_kriteria_kasi');
        $nama_kriteria_kasi = $this->input->post('nama_kriteria_kasi');
        // array yang berguna untuk mennjadikanva variabel diatas menjadi 1 variabel yang nantinya akan di sertakan dalam query insert
        $data = array(
            'id_kriteria_kasi' =>  $id_kriteria_kasi,
            'nama_kriteria_kasi' => $nama_kriteria_kasi

        );
        // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
        $this->m_data_kriteria->tambah_kriteria_kasi($data, 'tb_kriteria_kasi');
        // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
        $this->session->set_flashdata('pesan', '
         <div class="alert alert-success" role="alert">
         <strong>Selamat!</strong> Anda Berhasil Menambahkan Data Kriteria. Data yang baru ditambahkan dapat dilihat di tabel.
         </div>
         ');

        redirect('admin/master_data/tampil_kriteria_kasi');
    }

    public function hapus_kriteria_kasi($id)
    {
        $where = array(
            'id_kriteria_kasi' => $id
        );

        $this->m_data_kriteria->delete_kriteria_kasi($where, 'tb_kriteria_kasi');
        $this->session->set_flashdata('pesan', '
         <div class="alert alert-success" role="alert">
         <strong>Berhasil!</strong> Data anda telah terhapus.
         </div>
         ');
        redirect('admin/master_data/tampil_kriteria_kasi');
    }










    //
    public function tampil_nilai()
    {
        $data['title'] = 'tampil_nilai';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['nilai'] = $this->m_data_nilai->tampil_nilai()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_nilai_banding', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function update_nilai_banding()
    {
        $data['title'] = 'Nilai Banding';
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['nilai'] = $this->m_data_nilai->tampil_nilai()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $update = [
            'nama_nilai' => $this->input->post('nama_nilai'),
            'nilai' => $this->input->post('nilai'),
        ];
        $id = $this->input->post('id_nilai');
        $this->db->where('id_nilai', $id);
        $true = $this->db->update('nilai_banding', $update);
        if ($true) {
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/v_nilai_banding', $data);
            $this->load->view('admin/tamplate/footer', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sukses diupdate
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/tampil_nilai');
        } else {
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/v_nilai_banding', $data);
            $this->load->view('admin/tamplate/footer', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal diupdate
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/tampil_nilai');
        }
    }
    public function delete_nilai_banding($id)
    {
        $this->db->where('id_nilai', $id);
        $true = $this->db->delete('nilai_banding');
        if ($true) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Sukses dihapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/tampil_nilai');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal dihapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/master_data/tampil_nilai');
        }
    }
    //










    public function tambah_nilai()
    {
        $idDivisiInt = 0;
        // Membuat fungsi untuk melakukan penambahan id produk secara otomatis
        // Mendapatkan jumlah produk yang ada di database
        $jumlahNilai = $this->m_data_nilai->tampil_nilai()->num_rows();
        // Jika jumlah produk lebih dari 0
        if ($jumlahNilai > 0) {
            // Mengambil id produk sebelumnya
            $lastId = $this->m_data_nilai->tampil_nilai_akhir()->result();
            // Melakukan perulangan untuk mengambil data
            foreach ($lastId as $row) {
                // Melakukan pemisahan huruf dengan angka pada id produk
                $rawIdNilai = substr($row->id_nilai, 3);
                // Melakukan konversi nilai pemisahan huruf dengan angka pada id order menjadi integer
                $idNilaiInt = intval($rawIdNilai);

                // Menghitung panjang id yang sudah menjadi integer
                if (strlen($idNilaiInt) == 1) {
                    // jika panjang id hanya 1 angka
                    $id_nilai = "NL00" . ($idNilaiInt + 1);
                } else if (strlen($idDivisiInt) == 2) {
                    // jika panjang id hanya 2 angka
                    $id_nilai = "NL0" . ($idNilaiInt + 1);
                } else if (strlen($idNilaiInt) == 3) {
                    // jika panjang id hanya 3 angka
                    $id_nilai = "NL" . ($idNilaiInt + 1);
                }
            }
        } else {
            // Jika jumlah paket soal kurang dari sama dengan 0
            $id_nilai = "NL001";
        }


        $data = array(
            'id_nilai' =>  $id_nilai
        );
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_tambah_nilai', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function aksitambah_nilai()
    {
        // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
        $id_nilai = $this->input->post('id_nilai');
        $nama_nilai = $this->input->post('nama_nilai');
        $nilai = $this->input->post('nilai');
        // array yang berguna untuk mennjadikanva variabel diatas menjadi 1 variabel yang nantinya akan di sertakan dalam query insert
        $data = array(
            'id_nilai' =>  $id_nilai,
            'nama_nilai' => $nama_nilai,
            'nilai' => $nilai

        );
        // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
        $this->m_data_nilai->tambah_nilai($data, 'nilai_banding');
        // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
        $this->session->set_flashdata('pesan', '
          <div class="alert alert-success" role="alert">
          <strong>Selamat!</strong> Anda Berhasil Menambahkan Data Nilai. Data yang baru ditambahkan dapat dilihat di tabel.
          </div>
          ');

        redirect('admin/master_data/tampil_nilai');
    }


















    // -------------------- Kuisioner Operator --------------------
    public function kuisioner_op()
    {
        $this->form_validation->set_rules('idk_productivity', 'ID Productivity', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_productivity', 'Kuis Productivity', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_komker', 'ID Komunikasi dan Kerjasama', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_komker', 'Kuis Komunikasi dan Kerjasama', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pelaksana5r', 'ID Pelaksanaan 5 R', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pelaksana5r', 'Kuis Pelaksanaan 5 R', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_dokumentasi', 'ID Dokumentasi', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_dokumentasi', 'Kuis Dokumentasi', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pahamdanlaksanak3', 'ID Pemahaman dan Pelaksanaan K3', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pahamdanlaksanak3', 'Kuis Pemahaman dan Pelaksanaan K3', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pahamsop', 'ID Paham SOP dan SPK', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pahamsop', 'Kuis Paham SOP dan SPK', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pahamtools', 'ID Paham Tools', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pahamtools', 'Kuis Paham Tools', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_kehadiran', 'ID Kehadiran', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_kehadiran', 'Kuis Kehadiran', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_disiplin', 'ID Kedisiplinan', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_disiplin', 'Kuis Kedisiplinan', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_inisiatif', 'ID Inisiatif', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_inisiatif', 'Kuis Inisiatif', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('status_kuis', 'Status', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'kuisioner_op';
            // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
            $data['header'] = $this->db->list_fields('data_kuisioner');
            $data['data'] = $this->mdk->showQuisionerOperator();
            $data['data_kriteria'] = $this->m_data_kriteria->tampil_kriteria_op()->result_array();
            // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/v_kuisioner_op', $data);
            $this->load->view('admin/tamplate/footer', $data);
        } else {
            $data = [
                'idk_productivity' => $this->input->post('idk_productivity'),
                'kuis_productivity' => $this->input->post('kuis_productivity'),
                // <===>
                'idk_komker' => $this->input->post('idk_komker'),
                'kuis_komker' => $this->input->post('kuis_komker'),
                // <===>
                'idk_pelaksana5r' => $this->input->post('idk_pelaksana5r'),
                'kuis_pelaksana5r' => $this->input->post('kuis_pelaksana5r'),
                // <===>
                'idk_dokumentasi' => $this->input->post('idk_dokumentasi'),
                'kuis_dokumentasi' => $this->input->post('kuis_dokumentasi'),
                // <===>
                'idk_pahamdanlaksanak3' => $this->input->post('idk_pahamdanlaksanak3'),
                'kuis_pahamdanlaksanak3' => $this->input->post('kuis_pahamdanlaksanak3'),
                // <===>
                'idk_pahamsop' => $this->input->post('idk_pahamsop'),
                'kuis_pahamsop' => $this->input->post('kuis_pahamsop'),
                // <===>
                'idk_pahamtools' => $this->input->post('idk_pahamtools'),
                'kuis_pahamtools' => $this->input->post('kuis_pahamtools'),
                // <===>
                'idk_kehadiran' => $this->input->post('idk_kehadiran'),
                'kuis_kehadiran' => $this->input->post('kuis_kehadiran'),
                // <===>
                'idk_disiplin' => $this->input->post('idk_disiplin'),
                'kuis_disiplin' => $this->input->post('kuis_disiplin'),
                // <===>
                'idk_inisiatif' => $this->input->post('idk_inisiatif'),
                'kuis_inisiatif' => $this->input->post('kuis_inisiatif'),
                // <===>
                'status_kuis' => $this->input->post('status_kuis'),
            ];

            $query = $this->db->insert('data_kuisioner', $data);
            if ($query) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Sukses ditambah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/kuisioner_op');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal ditambah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/kuisioner_op');
            }
        }
    }
    // ---------------- UPDATE ----------------
    public function update_kuisioner_op()
    {
        $this->form_validation->set_rules('idk_productivity', 'ID Productivity', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_productivity', 'Kuis Productivity', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_komker', 'ID Komunikasi dan Kerjasama', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_komker', 'Kuis Komunikasi dan Kerjasama', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pelaksana5r', 'ID Pelaksanaan 5 R', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pelaksana5r', 'Kuis Pelaksanaan 5 R', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_dokumentasi', 'ID Dokumentasi', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_dokumentasi', 'Kuis Dokumentasi', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pahamdanlaksanak3', 'ID Pemahaman dan Pelaksanaan K3', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pahamdanlaksanak3', 'Kuis Pemahaman dan Pelaksanaan K3', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pahamsop', 'ID Paham SOP dan SPK', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pahamsop', 'Kuis Paham SOP dan SPK', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_pahamtools', 'ID Paham Tools', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_pahamtools', 'Kuis Paham Tools', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_kehadiran', 'ID Kehadiran', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_kehadiran', 'Kuis Kehadiran', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_disiplin', 'ID Kedisiplinan', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_disiplin', 'Kuis Kedisiplinan', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('idk_inisiatif', 'ID Inisiatif', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kuis_inisiatif', 'Kuis Inisiatif', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);
        // <===>
        $this->form_validation->set_rules('status_kuis', 'Status', 'required', [
            'required' => '%s tidak boleh kosong',
        ]);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Kuisioner Operator';
            // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
            $data['header'] = $this->db->list_fields('data_kuisioner');
            $data['data'] = $this->mdk->showQuisionerOperator();
            $data['data_kriteria'] = $this->m_data_kriteria->tampil_kriteria_op()->result_array();
            // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
            $this->load->view('admin/tamplate/header', $data);
            $this->load->view('admin/tamplate/sidebar', $data);
            $this->load->view('admin/v_kuisioner_op', $data);
            $this->load->view('admin/tamplate/footer', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'idk_productivity' => $this->input->post('idk_productivity'),
                'kuis_productivity' => $this->input->post('kuis_productivity'),
                // <===>
                'idk_komker' => $this->input->post('idk_komker'),
                'kuis_komker' => $this->input->post('kuis_komker'),
                // <===>
                'idk_pelaksana5r' => $this->input->post('idk_pelaksana5r'),
                'kuis_pelaksana5r' => $this->input->post('kuis_pelaksana5r'),
                // <===>
                'idk_dokumentasi' => $this->input->post('idk_dokumentasi'),
                'kuis_dokumentasi' => $this->input->post('kuis_dokumentasi'),
                // <===>
                'idk_pahamdanlaksanak3' => $this->input->post('idk_pahamdanlaksanak3'),
                'kuis_pahamdanlaksanak3' => $this->input->post('kuis_pahamdanlaksanak3'),
                // <===>
                'idk_pahamsop' => $this->input->post('idk_pahamsop'),
                'kuis_pahamsop' => $this->input->post('kuis_pahamsop'),
                // <===>
                'idk_pahamtools' => $this->input->post('idk_pahamtools'),
                'kuis_pahamtools' => $this->input->post('kuis_pahamtools'),
                // <===>
                'idk_kehadiran' => $this->input->post('idk_kehadiran'),
                'kuis_kehadiran' => $this->input->post('kuis_kehadiran'),
                // <===>
                'idk_disiplin' => $this->input->post('idk_disiplin'),
                'kuis_disiplin' => $this->input->post('kuis_disiplin'),
                // <===>
                'idk_inisiatif' => $this->input->post('idk_inisiatif'),
                'kuis_inisiatif' => $this->input->post('kuis_inisiatif'),
                // <===>
                'status_kuis' => $this->input->post('status_kuis'),
            ];
            $this->db->where('id_kuis', $id);
            $query = $this->db->update('data_kuisioner', $data);
            if ($query) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Sukses diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/kuisioner_op');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                redirect('admin/master_data/kuisioner_op');
            }
        }
    }
    // -------------------- END Kuisioner Operator --------------------






    function detail_kuisioner_op($id)
    {

        $where = array('tb_kriteria_operator.id_kriteria_op' => $id);
        // kode di bawah ini adalah kode yang mengambil data user berdasarkan id dan disimpan kedalam array $data dengan index bernama user
        $result = $this->m_data_kriteria->edit_kriteria_op($where, 'tb_kriteria_operator')->result();
        $resultKuisioner = $this->m_data_kuis->tampil_kuisop_where($where, 'data_kuisioner_op')->result();
        // kode ini memuat vie edit dan membawa data hasil query diatas
        $data = array(
            'tb_kriteria_operator' => $result,
            'data_kuisioner_op' => $resultKuisioner
        );

        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_detailkuis_op', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function tambah_kuis_op($id)
    {
        $where = array('tb_kriteria_operator.id_kriteria_op' => $id);
        // Membuat fungsi untuk melakukan penambahan id produk secara otomatis
        // Mendapatkan jumlah produk yang ada di database
        $jumlahKuis = $this->m_data_kuis->tampil_kuisop()->num_rows();
        // Jika jumlah produk lebih dari 0
        if ($jumlahKuis > 0) {
            // Mengambil id produk sebelumnya
            $lastId = $this->m_data_kuis->tampil_kuisop_akhir()->result();
            // Melakukan perulangan untuk mengambil data
            foreach ($lastId as $row) {
                // Melakukan pemisahan huruf dengan angka pada id produk
                $rawIdKuis = substr($row->id_kuis_op, 3);
                // Melakukan konversi nilai pemisahan huruf dengan angka pada id order menjadi integer
                $idKuisInt = intval($rawIdKuis);

                // Menghitung panjang id yang sudah menjadi integer
                if (strlen($idKuisInt) == 1) {
                    // jika panjang id hanya 1 angka
                    $id_kuis_op = "KP00" . ($idKuisInt + 1);
                } else if (strlen($idKuisInt) == 2) {
                    // jika panjang id hanya 2 angka
                    $id_kuis_op = "KP0" . ($idKuisInt + 1);
                } else if (strlen($idKuisInt) == 3) {
                    // jika panjang id hanya 3 angka
                    $id_kuis_op = "KP" . ($idKuisInt + 1);
                }
            }
        } else {
            // Jika jumlah paket soal kurang dari sama dengan 0
            $id_kuis_op = "KP001";
        }

        $result = $this->m_data_kriteria->edit_kriteria_op($where, 'tb_kriteria_operator')->result();
        $data = array(
            'id_kuis_op' =>  $id_kuis_op,
            'tb_kriteria_operator' => $result
        );
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_tambah_kuisop', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    public function aksitambah_kuisop()
    {

        // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
        $id_kuis_op = $this->input->post('id_kuis_op');
        $id_kriteria_op = $this->input->post('id_kriteria_op');
        $kuis_op = $this->input->post('kuis_op');

        $data = array(
            'id_kuis_op' => $id_kuis_op,
            'id_kriteria_op' => $id_kriteria_op,
            'kuis_op' => $kuis_op
        );
        // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
        $this->m_data_kuis->tambah_kuisop($data, 'data_kuisioner_op');
        // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
        $this->session->set_flashdata('pesan', '
              <div class="alert alert-success" role="alert">
              <strong>Selamat!</strong> Data telah di Tambahkan. Scroll layar kebawah untuk melihat data yang baru ditambahkan.
              </div>
              ');
        redirect('admin/master_data/detail_kuisioner_op/' . $id_kriteria_op);
    }
    function hapus_kuis_op($id_kuis_op, $id_kriteria_op)
    {
        //function hapus menangkap NIK dari pengiriman NIK yang ditampilkan di view masuk
        $where = array('id_kuis_op' => $id_kuis_op); // kemudian diubah menjadi array
        $this->m_data_kuis->delete_kuis_kasi($where, 'data_kuisioner_op'); //dan barulah kita kirim data array hapus tersebut pada m_data_soal yang ditangkap oleh function hapus_data
        // id paket disini merujuk pada id paket soal mana yang digunakan sekarang

        $this->session->set_flashdata('pesan', '
          <div class="alert alert-success" role="alert">
          <strong>Berhasil!</strong> Data anda telah terhapus.
          </div>
          ');
        redirect('admin/master_data/detail_kuisioner_op/' . $id_kriteria_op); // setelah itu langsung diarah kan ke function index yang menampilkan v_masuk
    }

    public function tampil_kuisioner_kasi()
    {
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['kriteria_kasi'] = $this->m_data_kriteria->tampil_kriteria_kasi()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_kuisioner_kasi', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    function detail_kuisioner_kasi($id)
    {

        $where = array('tb_kriteria_kasi.id_kriteria_kasi' => $id);
        // kode di bawah ini adalah kode yang mengambil data user berdasarkan id dan disimpan kedalam array $data dengan index bernama user
        $result = $this->m_data_kriteria->edit_kriteria_kasi($where, 'tb_kriteria_kasi')->result();
        $resultKuisionerkasi = $this->m_data_kuis->tampil_kuiskasi_where($where, 'data_kuisioner_kasi')->result();
        // kode ini memuat vie edit dan membawa data hasil query diatas
        $data = array(
            'tb_kriteria_kasi' => $result,
            'data_kuisioner_kasi' => $resultKuisionerkasi
        );

        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_detailkuis_kasi', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }
    public function tambah_kuis_kasi($id)
    {
        $where = array('tb_kriteria_kasi.id_kriteria_kasi' => $id);
        // Membuat fungsi untuk melakukan penambahan id produk secara otomatis
        // Mendapatkan jumlah produk yang ada di database
        $jumlahKuis = $this->m_data_kuis->tampil_kuiskasi()->num_rows();
        // Jika jumlah produk lebih dari 0
        if ($jumlahKuis > 0) {
            // Mengambil id produk sebelumnya
            $lastId = $this->m_data_kuis->tampil_kuiskasi_akhir()->result();
            // Melakukan perulangan untuk mengambil data
            foreach ($lastId as $row) {
                // Melakukan pemisahan huruf dengan angka pada id produk
                $rawIdKuis = substr($row->id_kuis_kasi, 3);
                // Melakukan konversi nilai pemisahan huruf dengan angka pada id order menjadi integer
                $idKuisInt = intval($rawIdKuis);

                // Menghitung panjang id yang sudah menjadi integer
                if (strlen($idKuisInt) == 1) {
                    // jika panjang id hanya 1 angka
                    $id_kuis_kasi = "KS00" . ($idKuisInt + 1);
                } else if (strlen($idKuisInt) == 2) {
                    // jika panjang id hanya 2 angka
                    $id_kuis_kasi = "KS0" . ($idKuisInt + 1);
                } else if (strlen($idKuisInt) == 3) {
                    // jika panjang id hanya 3 angka
                    $id_kuis_kasi = "KS" . ($idKuisInt + 1);
                }
            }
        } else {
            // Jika jumlah paket soal kurang dari sama dengan 0
            $id_kuis_kasi = "KS001";
        }

        $result = $this->m_data_kriteria->edit_kriteria_kasi($where, 'tb_kriteria_kasi')->result();
        $data = array(
            'id_kuis_kasi' =>  $id_kuis_kasi,
            'tb_kriteria_kasi' => $result
        );
        $this->load->view('admin/tamplate/header', $data);
        $this->load->view('admin/tamplate/sidebar', $data);
        $this->load->view('admin/v_tambah_kuiskasi', $data);
        $this->load->view('admin/tamplate/footer', $data);
    }

    public function aksitambah_kuiskasi()
    {

        // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
        $id_kuis_kasi = $this->input->post('id_kuis_kasi');
        $id_kriteria_kasi = $this->input->post('id_kriteria_kasi');
        $kuis_kasi = $this->input->post('kuis_kasi');

        $data = array(
            'id_kuis_kasi' => $id_kuis_kasi,
            'id_kriteria_kasi' => $id_kriteria_kasi,
            'kuis_kasi' => $kuis_kasi
        );
        // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
        $this->m_data_kuis->tambah_kuiskasi($data, 'data_kuisioner_kasi');
        // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                <strong>Selamat!</strong> Data telah di Tambahkan. Scroll layar kebawah untuk melihat data yang baru ditambahkan.
                </div>
                ');
        redirect('admin/master_data/detail_kuisioner_kasi/' . $id_kriteria_kasi);
    }
    function hapus_kuis_kasi($id_kuis_kasi, $id_kriteria_kasi)
    {
        //function hapus menangkap NIK dari pengiriman NIK yang ditampilkan di view masuk
        $where = array('id_kuis_kasi' => $id_kuis_kasi); // kemudian diubah menjadi array
        $this->m_data_kuis->delete_kuis_kasi($where, 'data_kuisioner_kasi'); //dan barulah kita kirim data array hapus tersebut pada m_data_soal yang ditangkap oleh function hapus_data
        // id paket disini merujuk pada id paket soal mana yang digunakan sekarang

        $this->session->set_flashdata('pesan', '
          <div class="alert alert-success" role="alert">
          <strong>Berhasil!</strong> Data anda telah terhapus.
          </div>
          ');
        redirect('admin/master_data/detail_kuisioner_kasi/' . $id_kriteria_kasi); // setelah itu langsung diarah kan ke function index yang menampilkan v_masuk
    }
}
