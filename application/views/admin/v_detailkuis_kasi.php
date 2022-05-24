<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Detail Kuisoner Berdasarkan Kriteria</h6>
  </div>
  <div class="card-content collapse show">
      <div class="card-body">
    <?php
        foreach($tb_kriteria_kasi as $div) ?>
          <a href="<?php echo base_url('admin/master_data/tambah_kuis_kasi/' . $div->id_kriteria_kasi);?>"><button type="button" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="ft-plus"> </i> Tambah Data</button></a>
      </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Kuisioner</th>
            <th>Kuisioner</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($data_kuisioner_kasi as $kuis ) { ?>
          <tr>
            <td><?=$kuis->id_kuis_kasi?></td>
            <td><?=$kuis->kuis_kasi?></td>
            <td>
            <a class="btn btn-primary" href="<?php echo base_url('admin/master_data/edit_kuis_kasi/' . $kuis->id_kuis_kasi . '/' . $div->id_kriteria_kasi); ?>">Edit</a>
            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="<?php echo base_url('admin/master_data/hapus_kuis_kasi/' . $kuis->id_kuis_kasi . '/' . $div->id_kriteria_kasi); ?>" class="btn btn-danger">Hapus</a>
            </td>
          </tr>
        <?php } ?>
          </tbody>
        </table>
        </div>
    </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- modal delete -->
