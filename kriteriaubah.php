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

    $kriteria = new kriteria();

    if(isset($_GET['kd_kriteria'])){
        $kode = $_GET['kd_kriteria'];
        $data_kriteria = $kriteria->get_by_id($kode);
    }
    else
    {
        header('Location: kriteria.php');
    }

    if(isset($_POST['tombol_ubah'])){
        $kd_kriteria = $_POST['kd_kriteria'];
        $nm_kriteria = $_POST['nm_kriteria'];
        $prosentase = $_POST['prosentase'];

        $status_update = $kriteria->update($kd_kriteria, $nm_kriteria, $prosentase);
        if($status_update){ ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Data kriteria berhasil diubah',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('kriteria.php');
            }, 3000);
            //alert('Data Berhasil Diubah');
            //document.location='kriteria.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'error', title : 'Gagal',
                text : 'Data Kriteria Gagal Diubah',
                type : 'warning', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('kriteriaubah.php');
            }, 3000);
            //alert('Data Gagal Diubah');
            //document.location='kriteriaubah.php'
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
                    <h5 class="mb-0">Data Kriteria</h5>
                  </div>
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group row">
                            <label for="kd_kriteria" class="col-sm-3 col-form-label">Kode Kriteria</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="kd_kriteria" name="kd_kriteria" value="<?php echo $data_kriteria['kd_kriteria']; ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="nm_kriteria" class="col-sm-3 col-form-label">Nama Kriteria</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="nm_kriteria" name="nm_kriteria" value="<?php echo $data_kriteria['nm_kriteria']; ?>" required data-parsley-pattern="^[a-zA-Z ]+$">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="prosentase" class="col-sm-3 col-form-label"> Prosentase</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="prosentase" name="prosentase" value="<?php echo $data_kriteria['prosentase']; ?>" required data-parsley-type="number">
                            </div>
                          </div>
                          <br>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">&nbsp;</label>
                              <div class="col-sm-10">
                                <input type="submit" name="tombol_ubah" class="btn btn-success mr-2" value="SIMPAN">
                                <a href="kriteria.php" class="btn btn-light">KEMBALI</a>
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

    <script>
    $(document).ready(function(){
      $('form').parsley();
    });
    </script>
  </body>
</html>
