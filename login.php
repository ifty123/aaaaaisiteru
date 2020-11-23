<?php
    error_reporting(E_ALL);
    session_start();
    //nge load kelas
    spl_autoload_register(function ($class_name){
      include 'kelas/'.$class_name.'.php';
    });

    $pengguna = new pengguna();
?>
    <!-- coba css dan js sweetalert -->
    <link rel="stylesheet" href="dist/sweetalert2.css">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="dist/sweetalert2.all.min.js"></script>

<?php
    if(isset($_POST['signin'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      $check = $pengguna->get_by_userpassword($username, $password);
      if ($check){
        $_SESSION['pengguna'] = $check;
        $_SESSION['pengguna']['username'] = $check['username'];
        $_SESSION['pengguna']['password'] = $check['password'];
        $_SESSION['pengguna']['kd_pengguna'] = $check['kd_pengguna'];

        //cek isi pengguna lewat level
        if($_SESSION['pengguna']['level']=='Peserta'){
          ?>
          <script type="text/javascript">
           setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Selamat datang di Web Peserta',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('peserta/index.php');
            }, 3000);
            //alert('Selamat Datang Di Halaman Peserta');
            //document.location='peserta/index.php'; //lokasi
          </script>
          <?php
        }
        else if($_SESSION['pengguna']['level']=='Panitia'){
          ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Selamat datang di Web Panitia',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('index.php');
            }, 3000);
            //alert('Selamat Datang Di Halaman Panitia');
            //document.location='index.php'; //lokasi
          </script>
          <?php
        }
        else if($_SESSION['pengguna']['level']=='OSIS')
        {
          ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Selamat datang di Web OSIS',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('index.php');
            }, 3000);
            //alert('Selamat Datang Di Halaman Pengurus OSIS');
            //document.location='osis/index.php'; //lokasi
          </script>
          <?php
        }
        else{
          ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Selamat datang di Web Pembina',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('index.php');
            }, 3000);
            //alert('Selamat Datang Di Halaman Pembina OSIS');
            //document.location='pembina/index.php'; //lokasi
          </script>
          <?php
        }
      }
      else{
        ?>
        <script type="text/javascript">
          setTimeout(function(){
              Swal.fire({
                icon : 'error', title : 'Gagal',
                text : 'Cek kembali username dan password',
                type : 'warning', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('login.php');
            }, 3000);
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
    <title>Login Site</title>

    <?php //include "linkcss.php"; ?>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="images/logo.svg">
                </div>
                <h4>Halo! Selamat Datang</h4>
                <h6 class="font-weight-light">Silahkan login untuk melanjutkan</h6>
                <form class="pt-3" method="post">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="signin" id="signin" type="submit">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <?php
    include "footer.php";
    include "linkjs.php";
    ?>
    <!-- endinject -->
  </body>
</html>