<?php
//  berfungsi untuk melayani segala query CRUD database
class M_data_divisi extends CI_Model
{

  public function tampil_divisi()
  {
    return $this->db->get('tb_divisi');
  }
  function tampil_divisi_akhir()
  {
    $this->db->order_by('id_divisi', 'DESC');
    return $this->db->get('tb_divisi', 1);
  }
  function tambah_divisi($data, $table)
  {
    $this->db->insert($table, $data);
  }
  function delete_divisi($where, $table)
  {
    $this->db->delete($table, $where);
  }

}