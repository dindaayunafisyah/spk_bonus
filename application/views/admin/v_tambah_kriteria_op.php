<div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Kriteria Penilaian Operator</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Content Row -->
                <!-- Disini tempat membuat Edit Profil nya! -->
            </div>
            <div class="col-lg-10">
                <form action="<?php echo base_url() . 'admin/master_data/aksitambah_kriteria_op'; ?>" method="post">
                
                    <div class="form-group">
                        <label for="id_divisi"> ID Kriteria Operator : </label>
                        <input type="text" name="id_kriteria_op" id="id_kriteria_op" value="<?= $id_kriteria_op; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_divisi"> Kriteria Penilaian : </label>
                        <input type="text" class="form-control form-control-user" id="nama_kriteria_op" name="nama_kriteria_op" placeholder="Masukan Nama Kriteria" title="Isikan data dengan benar" required>
                    </div>
                    <hr>
                    <button type="submit" name="submit" class="btn btn-success btn-user btn-block">Tambah</button>
                    <br>
                    <a href="<?php echo base_url();?>admin/master_data/tampil_kriteria_op"><button type="button" name="button" class="btn btn-outline-secondary btn-user btn-block">Batal</button></a>
                </form>
                <br>
                <div class="text-center">
                    <div class="row">

                    </div>
                    <!-- Batas edit profil -->
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>