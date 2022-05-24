<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Divisi</h6>
  </div>
  <div class="card-content collapse show">
      <div class="card-body">
          <a href="<?= base_url() . 'admin/master_data/tambah_divisi'; ?>"><button type="button" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="ft-plus"> </i> Tambah Divisi</button></a>
      </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Divisi</th>
            <th>Nama Divisi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($divisi as $div ) { ?>
          <tr>
            <td><?=$div->id_divisi?></td>
            <td><?=$div->nama_divisi?></td>
            <td>
            <a class="btn btn-primary" href="<?php echo base_url('admin/master_data/edit_divisi/' . $div->id_divisi); ?>">Edit</a>
            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="<?= base_url('admin/master_data/hapus_divisi/' . $div->id_divisi) ?>" class="btn btn-danger">Hapus</a>
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
