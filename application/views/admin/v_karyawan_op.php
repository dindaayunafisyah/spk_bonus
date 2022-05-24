<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <div class="container-fluid">

    <div class="card shadow mb-4">
        
        <div class="card-content collapse show">
            <div class="card-body">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Pilih Divisi Operator
            </button>
            <div>
            <div class="card-header py-3">
              <h10 class="m-0 font-weight-bold text-primary">Data Operator</h10>
            </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Nama Divisi</th>
                          <th>NIK</th>
                          <th>Nama</th>
                        </tr>
                      </thead>
                      <tbody> 
                      <?php 
                        foreach ($karyawan as $kar ) { ?>
                          <tr>
                          <td><?=$kar->nama_divisi?></td>
                            <td><?=$kar->nik?></td>
                            <td><?=$kar->nama_karyawan?></td>
                            <?php } ?>
                        </tbody>
                      </table>
                      </div>
                  </div>
                  </div>
              </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Divisi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url() . 'admin/master_data/set_divisi/'; ?>" method="get">
      <div class="modal-body">
        <h5 class="mt-2">Pilih Divisi Operator</h5>
        <fieldset class="form-group">
        <select name="id_divisi" id="id_divisi" class\="custom-select">
                                            
            <?php
                foreach ($set as $s) :
            ?>
                <option value="<?= $s->id_divisi;?>"><?= $s->nama_divisi;?></option>
            <?php
                endforeach;
            ?>             
        </select>
        </fieldset>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Cek</button>
      </div>
    </div>
  </div>
</div>

  </head>
  <body>
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>