<div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Kuisioner Operator</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Content Row -->
                <!-- Disini tempat membuat Edit Profil nya! -->
            </div>
            <div class="col-lg-10">
            <?php
                foreach($tb_kriteria_operator as $kar) ?>
                <form action="<?php echo base_url() . 'admin/master_data/aksitambah_kuisop'; ?>" method="post">
                    <div class="form-group">
                        <label for="id_kuis_op"> ID Kusioner Operator : </label>
                        <input type="hidden" class="form-control form-control-user"  id="id_kriteria_op" name="id_kriteria_op" value="<?php echo $kar->id_kriteria_op ?>">
                        <input type="text" name="id_kuis_op" id="id_kuis_op" value="<?= $id_kuis_op; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_divisi"> Kuisoner : </label>
                        <input type="text" class="form-control form-control-user" id="kuis_op" name="kuis_op" placeholder="Masukan Nama Kriteria" title="Isikan data dengan benar" required>
                    </div>
                    <hr>
                    <button type="submit" name="submit" class="btn btn-success btn-user btn-block">Tambah</button>
                    <br>
                    <a href="<?php echo base_url('admin/master_data/detail_kuisioner_op/'  . $kar->id_kriteria_op);?>"><button type="button" name="button" class="btn btn-outline-secondary btn-user btn-block">Batal</button></a>
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