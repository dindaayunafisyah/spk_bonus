<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Kuisioner Penilaian untuk Operator</h6>
  </div>
  <div class="card-content collapse show">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Kriteria Operator</th>
            <th>Kriteria Penilaian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($kriteria_op as $kri ) { ?>
          <tr>
            <td><?=$kri->id_kriteria_op?></td>
            <td><?=$kri->nama_kriteria_op?></td>
            <td>
            <a class="btn btn-warning" href="<?php echo base_url('admin/master_data/detail_kuisioner_op/' . $kri->id_kriteria_op); ?>">Lihat</a>
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
