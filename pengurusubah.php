<!-- coba css dan js sweetalert -->
    <link rel="stylesheet" href="dist/sweetalert2.css">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="dist/sweetalert2.all.min.js"></script>
<?php
    error_reporting(E_ALL);
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $pengurus = new pengurus();

    if(isset($_GET['kd_pengurus'])){
        $kode = $_GET['kd_pengurus'];
        $data_pengurus = $pengurus->get_by_id($kode);
    }
    else
    {
        header('Location: pengurus.php');
    }

    if(isset($_POST['tombol_ubah'])){
        $kd_pengurus = $_POST['kd_pengurus'];
        $nm_pengurus = $_POST['nm_pengurus'];
        $jabatan = $_POST['jabatan'];
        $masa_bakti = $_POST['masa_bakti'];

        $status_update = $pengurus->update($kd_pengurus, $nm_pengurus, $jabatan, $masa_bakti);
        if($status_update){ ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Data pengurus berhasil diubah',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('pengurus.php');
            }, 3000);
            //alert('Data Berhasil Diubah');
            //document.location='pengurus.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'error', title : 'Gagal',
                text : 'Data Peserta Gagal Diubah',
                type : 'warning', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('pengurusubah.php');
            }, 3000);
            //alert('Data Gagal Diubah');
            //document.location='pengurusubah.php'
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
                    <h5 class="mb-0">Data pengurus</h5>
                  </div>
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group row">
                            <label for="kd_pengurus" class="col-sm-3 col-form-label">Kode pengurus</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="kd_pengurus" name="kd_pengurus" value="<?php echo $data_pengurus['kd_pengurus']; ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="nm_pengurus" class="col-sm-3 col-form-label">Nama pengurus</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="nm_pengurus" name="nm_pengurus" value="<?php echo $data_pengurus['nm_pengurus']; ?>" required data-parsley-pattern="^[a-zA-Z ]+$">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label"> jabatan</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $data_pengurus['jabatan']; ?>" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="masa_bakti" class="col-sm-3 col-form-label"> masa_bakti</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="masa_bakti" name="masa_bakti" value="<?php echo $data_pengurus['masa_bakti']; ?>" required>
                            </div>
                          </div>
                          <br>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">&nbsp;</label>
                              <div class="col-sm-10">
                                <input type="submit" name="tombol_ubah" class="btn btn-success mr-2" value="SIMPAN">
                                <a href="pengurus.php" class="btn btn-light">KEMBALI</a>
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
     <!-- di bawah udah ada link parsley nya -->
    <?php include "linkjs.php"; ?>

     <!-- fungsi parsley check  -->
    <script>
    $(document).ready(function(){
      $('form').parsley();
    });
    </script>

  </body>
</html>
