<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Kriteria untuk Kepala Divisi</h6>
  </div>
  <div class="card-content collapse show">
      <div class="card-body">
          <a href="<?= base_url() . 'admin/master_data/tambah_kriteria_kasi'; ?>"><button type="button" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="ft-plus"> </i> Tambah Kriteria</button></a>
      </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Kriteria Kasi</th>
            <th>Kriteria Penilaian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($kriteria_kasi as $kri ) { ?>
          <tr>
            <td><?=$kri->id_kriteria_kasi?></td>
            <td><?=$kri->nama_kriteria_kasi?></td>
            <td>
            <a class="btn btn-primary" href="<?php echo base_url('admin/master_data/edit_kriteria_kasi/' . $kri->id_kriteria_kasi); ?>">Edit</a>
            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="<?= base_url('admin/master_data/hapus_kriteria_kasi/' . $kri->id_kriteria_kasi) ?>" class="btn btn-danger">Hapus</a>
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
