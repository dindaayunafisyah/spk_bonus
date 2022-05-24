<div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Kuisioner Kepala Divisi</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Content Row -->
                <!-- Disini tempat membuat Edit Profil nya! -->
            </div>
            <div class="col-lg-10">
            <?php
                foreach($tb_kriteria_kasi as $kar) ?>
                <form action="<?php echo base_url() . 'admin/master_data/aksitambah_kuiskasi'; ?>" method="post">
                    <div class="form-group">
                        <label for="id_kuis_op"> ID Kusioner Kasi : </label>
                        <input type="hidden" class="form-control form-control-user"  id="id_kriteria_kasi" name="id_kriteria_kasi" value="<?php echo $kar->id_kriteria_kasi ?>">
                        <input type="text" name="id_kuis_kasi" id="id_kuis_kasi" value="<?= $id_kuis_kasi; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_divisi"> Kuisoner : </label>
                        <input type="text" class="form-control form-control-user" id="kuis_kasi" name="kuis_kasi" placeholder="Masukan Kuisioner" title="Isikan data dengan benar" required>
                    </div>
                    <hr>
                    <button type="submit" name="submit" class="btn btn-success btn-user btn-block">Tambah</button>
                    <br>
                    <a href="<?php echo base_url('admin/master_data/detail_kuisioner_kasi/'  . $kar->id_kriteria_kasi);?>"><button type="button" name="button" class="btn btn-outline-secondary btn-user btn-block">Batal</button></a>
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