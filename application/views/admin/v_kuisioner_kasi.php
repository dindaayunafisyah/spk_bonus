<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Kuisioner Penilaian untuk Kepala Divisi</h6>
  </div>
  <div class="card-content collapse show">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Kriteria Kepala Divisi</th>
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
            <a class="btn btn-warning" href="<?php echo base_url('admin/master_data/detail_kuisioner_kasi/' . $kri->id_kriteria_kasi); ?>">Lihat</a>
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
