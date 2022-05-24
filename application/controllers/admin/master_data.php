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
        $this->load->model('m_data_kuis');
        $this->load->helper('url', 'form', 'file');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }
    //  method yang akan diakses saat controller ini diakses
    public function tampil_jabatan()
    {
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['jabatan'] = $this->m_data_jabatan->tampil_jabatan()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
        $this->load->view('admin/v_jabatan', $data);
        $this->load->view('admin/tamplate/footer');  
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
        $this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
        $this->load->view('admin/v_tambah_jabatan', $data);  
        $this->load->view('admin/tamplate/footer');
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
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['divisi'] = $this->m_data_divisi->tampil_divisi()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
        $this->load->view('admin/v_divisi', $data);
        $this->load->view('admin/tamplate/footer');  
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
         $this->load->view('admin/tamplate/header');
         $this->load->view('admin/tamplate/sidebar');
         $this->load->view('admin/v_tambah_divisi', $data);  
         $this->load->view('admin/tamplate/footer');
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

     public function tampil_kriteria_op()
    {
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['kriteria_op'] = $this->m_data_kriteria->tampil_kriteria_op()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
        $this->load->view('admin/v_kriteria_operator', $data);
        $this->load->view('admin/tamplate/footer');  
    }
    
     public function tambah_kriteria_op()
     {
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
         $this->load->view('admin/tamplate/header');
         $this->load->view('admin/tamplate/sidebar');
         $this->load->view('admin/v_tambah_kriteria_op', $data);  
         $this->load->view('admin/tamplate/footer');
     }
     public function aksitambah_kriteria_op()
     {
         // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
         $id_kriteria_op = $this->input->post('id_kriteria_op');
         $nama_kriteria_op = $this->input->post('nama_kriteria_op');
         // array yang berguna untuk mennjadikanva variabel diatas menjadi 1 variabel yang nantinya akan di sertakan dalam query insert
         $data = array(
            'id_kriteria_op' =>  $id_kriteria_op,
             'nama_kriteria_op' => $nama_kriteria_op
 
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

     public function tampil_kriteria_kasi()
    {
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['kriteria_kasi'] = $this->m_data_kriteria->tampil_kriteria_kasi()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
        $this->load->view('admin/v_kriteria_kasi', $data);
        $this->load->view('admin/tamplate/footer');  
    }
    
     public function tambah_kriteria_kasi()
     {
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
         $this->load->view('admin/tamplate/header');
         $this->load->view('admin/tamplate/sidebar');
         $this->load->view('admin/v_tambah_kriteria_kasi', $data);  
         $this->load->view('admin/tamplate/footer');
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

     public function tampil_nilai()
     {
         // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
         $data['nilai'] = $this->m_data_nilai->tampil_nilai()->result();
         // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
         $this->load->view('admin/tamplate/header');
         $this->load->view('admin/tamplate/sidebar');
         $this->load->view('admin/v_nilai_banding', $data);
         $this->load->view('admin/tamplate/footer');  
     }
     
      public function tambah_nilai()
      {
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
          $this->load->view('admin/tamplate/header');
          $this->load->view('admin/tamplate/sidebar');
          $this->load->view('admin/v_tambah_nilai', $data);  
          $this->load->view('admin/tamplate/footer');
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
  
      public function tampil_kuisioner_op()
    {
        // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
        $data['kriteria_op'] = $this->m_data_kriteria->tampil_kriteria_op()->result();
        // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
        $this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
        $this->load->view('admin/v_kuisioner_op', $data);
        $this->load->view('admin/tamplate/footer');  
    }

    function detail_kuisioner_op($id)
    {

        $where = array('tb_kriteria_operator.id_kriteria_op' => $id);
        // kode di bawah ini adalah kode yang mengambil data user berdasarkan id dan disimpan kedalam array $data dengan index bernama user
        $result = $this->m_data_kriteria->edit_kriteria_op($where, 'tb_kriteria_operator')->result();
        $resultKuisioner= $this->m_data_kuis->tampil_kuisop_where($where, 'data_kuisioner_op')->result();
        // kode ini memuat vie edit dan membawa data hasil query diatas
        $data = array(
            'tb_kriteria_operator' => $result,
            'data_kuisioner_op' => $resultKuisioner
        );

        $this->load->view('admin/tamplate/header');
		$this->load->view('admin/tamplate/sidebar');
        $this->load->view('admin/v_detailkuis_op', $data);
        $this->load->view('admin/tamplate/footer');  
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
          $this->load->view('admin/tamplate/header');
          $this->load->view('admin/tamplate/sidebar');
          $this->load->view('admin/v_tambah_kuisop', $data);  
          $this->load->view('admin/tamplate/footer');
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
          $this->load->view('admin/tamplate/header');
          $this->load->view('admin/tamplate/sidebar');
          $this->load->view('admin/v_kuisioner_kasi', $data);
          $this->load->view('admin/tamplate/footer');  
      }
  
      function detail_kuisioner_kasi($id)
      {
  
          $where = array('tb_kriteria_kasi.id_kriteria_kasi' => $id);
          // kode di bawah ini adalah kode yang mengambil data user berdasarkan id dan disimpan kedalam array $data dengan index bernama user
          $result = $this->m_data_kriteria->edit_kriteria_kasi($where, 'tb_kriteria_kasi')->result();
          $resultKuisionerkasi= $this->m_data_kuis->tampil_kuiskasi_where($where, 'data_kuisioner_kasi')->result();
          // kode ini memuat vie edit dan membawa data hasil query diatas
          $data = array(
              'tb_kriteria_kasi' => $result,
              'data_kuisioner_kasi' => $resultKuisionerkasi
          );
  
          $this->load->view('admin/tamplate/header');
          $this->load->view('admin/tamplate/sidebar');
          $this->load->view('admin/v_detailkuis_kasi', $data);
          $this->load->view('admin/tamplate/footer');  
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
            $this->load->view('admin/tamplate/header');
            $this->load->view('admin/tamplate/sidebar');
            $this->load->view('admin/v_tambah_kuiskasi', $data);  
            $this->load->view('admin/tamplate/footer');
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