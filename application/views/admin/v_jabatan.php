<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Jabatan Karyawan</h6>
  </div>
  <div class="card-content collapse show">
      <div class="card-body">
          <a href="<?= base_url() . 'admin/master_data/tambah_jabatan'; ?>"><button type="button" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="ft-plus"> </i> Tambah Jabatan</button></a>
      </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID Jabatan</th>
            <th>Nama Jabatan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($jabatan as $jab ) { ?>
          <tr>
            <td><?=$jab->id_jabatan?></td>
            <td><?=$jab->nama_jabatan?></td>
            <td>
            <a class="btn btn-primary" href="<?php echo base_url('admin/master_data/edit_jabatan/' . $jab->id_jabatan); ?>">Edit</a>
            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="<?= base_url('admin/master_data/hapus_jabatan/' . $jab->id_jabatan) ?>" class="btn btn-danger">Hapus</a>
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
<?php
        foreach($jabatan as $jab) :    
    ?>
        <!--  delete Modal -->
        <div class="modal fade" id="deleteModal<?= $jab->id_jabatan?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="deletePaketModalTitle">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePaketModalTitle">Hapus data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-justify">Apakah anda yakin akan menghapus data Jabatan<em><strong> <?= $jab->nama_jabatan;?></strong></em></h5>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"> Batal </button>
                        <a href="<?php echo base_url() ?>admin/master_data/hapus_jabatan/<?php echo $jab->id_jabatan ?>" role="button" class="btn btn-danger"> Ya </a>
                      </div>
                </div>
            </div>
        </div>

    <?php
        endforeach;
    ?>

</div>
      <!-- End of Main Content -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->