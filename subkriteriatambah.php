<!-- coba css dan js sweetalert -->
    <link rel="stylesheet" href="dist/sweetalert2.css">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="dist/sweetalert2.all.min.js"></script>

<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $subkriteria = new subkriteria();
    $data_kri = $subkriteria->showk();

    if(isset($_POST['tombol_tambah'])){
        $kd_sub = $_POST['kd_sub'];
        $nm_sub = $_POST['nm_sub'];
        $bobot_sub = $_POST['bobot_sub'];
        $cf_sf    = !isset($_POST['cf_sf'])    ? 0 : $_POST['cf_sf'];
        $kd_kriteria = $_POST['kd_kriteria'];

        $adddata = $subkriteria->add_data($kd_sub, $nm_sub, $bobot_sub, $cf_sf, $kd_kriteria);
        if($adddata){ ?>
          <script type="text/javascript">
            setTimeout(function(){
                Swal.fire({
                  icon : 'success', title : 'Sukses',
                  text : 'Data Sub Kriteria berhasil ditambah',
                  type : 'error', timer : 3200,
                  showConfirmButton : true
                });
              }, 10);

              window.setTimeout(function(){
                window.location.replace('subkriteria.php');
              }, 3000);
            //alert('Data Berhasil Disimpan');
            //document.location='subkriteria.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            setTimeout(function(){
                Swal.fire({
                  icon : 'error', title : 'Gagal',
                  text : 'Data Sub Kriteria Gagal Ditambah',
                  type : 'error', timer : 3200,
                  showConfirmButton : true
                });
              }, 10);

              window.setTimeout(function(){
                window.location.replace('subkriteriatambah.php');
              }, 3000);
            //alert('Data Gagal Disimpan');
            //document.location='subkriteriatambah.php'
          </script>
          <?php
        }
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stellar Admin</title>
    <!-- parsley error di dalam linkcss -->
    <?php include "linkcss.php"; ?>
  </head>
  <body>
    <div class="container-scroller">
      <?php include "navbar.php"; ?>
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include "sidebar.php"; ?>
        <!-- partial -->
        <div class="main-panel">

          <div class="content-wrapper">

            <!-- Quick Action Toolbar Starts-->
            <div class="row quick-action-toolbar">
              <div class="col-md-12 grid-margin">

                <div class="card">
                  <div class="card-header d-block d-md-flex">
                    <h5 class="mb-0">Data Sub Kriteria</h5>
                  </div>
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="" >
                          <div class="form-group row">
                            <label for="kd_sub" class="col-sm-3 col-form-label">Kode Sub Kriteria</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="kd_sub" name="kd_sub" value="<?php echo $subkriteria->createCode(); ?>" readonly>
                          </div>
                          </div>
                            <div class="form-group row">
                            <label for="kd_kriteria" class="col-sm-3 col-form-label">Kode Kriteria</label>
                            <div class="col-sm-5">
                              <select class="form-control" id="kd_kriteria" name="kd_kriteria" required>
                                <option value="" selected="selected"> - Pilih - </option>
                                <?php foreach ($data_kri as $row) { ?>
                                  <option><?php echo $row['kd_kriteria'].' - '. $row['nm_kriteria'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="nm_sub" class="col-sm-3 col-form-label">Nama Sub Kriteria</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="nm_sub" name="nm_sub" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="bobot_sub" class="col-sm-3 col-form-label">bobot_sub</label>
                            <div class="col-sm-5">
                              <select class = "form-control" name="bobot_sub" id="bobot_sub" required>
                                <option value="" selected="selected"> - Pilih - </option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="cf_sf" class="col-sm-3 col-form-label">Jenis (CF/SF)</label>
                            
                              <div class="col-sm-3">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="cf_sf" id="cf_sf" value="1" checked> Core Factor </label>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="cf_sf" id="cf_sf1" value="0"> Secondary Factor </label>
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">&nbsp;</label>
                              <div class="col-sm-10">
                                <input type="submit" id="tombol_tambah" name="tombol_tambah" class="btn btn-success mr-2" value="SIMPAN">
                                <a href="subkriteria.php" class="btn btn-light">KEMBALI</a>
                              </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- content-wrapper ends -->

          <?php include "footer.php"; ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include "linkjs.php"; ?>

    <!-- cfungsi parsley -->
    <script>
    $(document).ready(function(){
      $('form').parsley();
    });
    </script>
  </body>
</html>
