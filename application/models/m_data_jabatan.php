<?php
//  berfungsi untuk melayani segala query CRUD database
class M_data_jabatan extends CI_Model
{

  public function tampil_jabatan()
  {
    return $this->db->get('tb_jabatan');
  }
  function tampil_jabatan_akhir()
  {
    $this->db->order_by('id_jabatan', 'DESC');
    return $this->db->get('tb_jabatan', 1);
  }
  function tambah_jabatan($data, $table)
  {
    $this->db->insert($table, $data);
  }
  function delete_jabatan($where, $table)
  {
    $this->db->delete($table, $where);
  }

}