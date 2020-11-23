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

    $pengguna = new pengguna();

    if(isset($_GET['kd_pengguna'])){
        $kode = $_GET['kd_pengguna'];
        $data_pengguna = $pengguna->get_by_id($kode);
    }
    else
    {
        header('Location: pengguna.php');
    }

    if(isset($_POST['tombol_ubah'])){
        $kd_pengguna = $_POST['kd_pengguna'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $status_update = $pengguna->update($kd_pengguna, $username, $password, $level);
        if($status_update){ ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Data pengguna berhasil diubah',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('pengguna.php');
            }, 3000);
            //alert('Data Berhasil Diubah');
            //document.location='pengguna.php'
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
              window.location.replace('penggunaubah.php');
            }, 3000);
            //alert('Data Gagal Diubah');
            //document.location='penggunaubah.php'
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
                    <h5 class="mb-0">Data pengguna</h5>
                  </div>
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group row">
                            <label for="kd_pengguna" class="col-sm-3 col-form-label">Kode pengguna</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="kd_pengguna" name="kd_pengguna" value="<?php echo $data_pengguna['kd_pengguna']; ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Nama pengguna</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="username" name="username" value="<?php echo $data_pengguna['username']; ?>" required data-parsley-pattern="^[a-zA-Z ]+$">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label"> Password</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="password" name="password" value="<?php echo $data_pengguna['password']; ?>" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="level" class="col-sm-3 col-form-label"> Level</label>
                            <div class="col-sm-3">
                              <select class="form-control" id="level" name="level" required>
                                <option><?php echo $data_pengguna['level']; ?></option>
                                <option>Peserta</option>
                                <option>Panitia</option>
                                <option>Pembina</option>
                                <option>OSIS</option>
                              </select>
                            </div>
                          </div>
                          <br>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">&nbsp;</label>
                              <div class="col-sm-10">
                                <input type="submit" name="tombol_ubah" class="btn btn-success mr-2" value="SIMPAN">
                                <a href="pengguna.php" class="btn btn-light">KEMBALI</a>
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
