<!-- coba css dan js sweetalert -->
    <link rel="stylesheet" href="dist/sweetalert2.css">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="dist/sweetalert2.all.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
<?php
    error_reporting(E_ALL);
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $data_peserta = new peserta();

    if(isset($_GET['kd_peserta'])){
        $kode = $_GET['kd_peserta'];
        $peserta = $data_peserta->get_by_id($kode);
    }
    else
    {
        header('Location: peserta.php');
    }

    if(isset($_POST['tombol_ubah'])){
        $kd_peserta = $_POST['kd_peserta'];
        $nm_peserta = $_POST['nm_peserta'];
        $nis = $_POST['nis'];
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];
        $kelas = $_POST['kelas'];
        
        //membuat variabel untuk menyimpan foto
        $tmp = $_FILES['foto']['tmp_name'];
        $nama_foto = $_FILES['foto']['name'];
        $tipe_foto = $_FILES['foto']['type'];

        //$foto = $nama_foto.".".$tipe_foto;
        //cek file dulu
        if(empty($nama_foto)){
        $status_update1 = $data_peserta->update($kd_peserta, $nm_peserta, $nis, $visi, $misi, $kelas);

        if($status_update1){ ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Data Peserta Berhasil Diubah',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('peserta.php');
            }, 3000);
           //alert('Data Berhasil Diubah');
           //document.location='peserta.php'
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
                type : 'error', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('pesertaedit.php');
            }, 3000);
            //alert('Data Gagal Disimpan');
            //document.location='pesertaedit.php'
          </script>
          <?php
        }
          }
          else{
            $fotobaru = $kd_peserta.'_'.$nm_peserta.'_'.date('dmYHis').'.'.'jpg';
          // Set path folder tempat menyimpan fotonya
          $path = "uploads/".$fotobaru;
          // Proses upload
          $nama_foto = $fotobaru;

          if(move_uploaded_file($tmp, $path))
          {
            if($tipe_foto == "image/jpeg")
            {
              //identitas file asli
              $im_src = imagecreatefromjpeg($path);
              $src_width = imageSX($im_src);
              $src_height= imageSY($im_src);
            }
            else if($tipe_foto == "image/png")
            {
              $im_src = imagecreatefrompng($path);
              $src_width = imageSX($im_src);
              $src_height= imageSY($im_src);
            }

            //Simpan dalam ukuran medium 320px
            $dst_width = 300;
            $dst_height = ($dst_width/$src_width)*$src_height;

            //proses untuk perubahan ukuran
            $im = imagecreatetruecolor($dst_width,$dst_height);
            imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

            //menyimpan gambar
              imagejpeg($im,$path);
              imagedestroy($im_src);
              imagedestroy($im);
            unlink("uploads/".$peserta['foto']); // Hapus file foto sebelumnya yang ada di folder images
            $status_update2 = $data_peserta->update_foto($kd_peserta, $nm_peserta, $nis, $visi, $misi, $kelas, $nama_foto);
            if($status_update2)
            {
              ?>
              <script type="text/javascript">
                setTimeout(function(){
                Swal.fire({
                  icon : 'success', title : 'Sukses',
                  text : 'Data Peserta Berhasil Diubah',
                  type : 'Success', timer : 3200,
                  showConfirmButton : true
                });
              }, 10);

              window.setTimeout(function(){
                window.location.replace('peserta.php');
              }, 3000);
                //alert('Data Berhasil Diubah');
                //document.location='peserta.php'
              </script>
              <?php
            }
            else
            {
              ?>
              <script type="text/javascript">
                setTimeout(function(){
                Swal.fire({
                  icon : 'error', title : 'Gagal',
                  text : 'Data Peserta Gagal Diubah',
                  type : 'error', timer : 3200,
                  showConfirmButton : true
                });
              }, 10);

              window.setTimeout(function(){
                window.location.replace('pesertaedit.php');
              }, 3000);
                //alert('Data Gagal Diubah');
                //document.location='pesertaedit.php'
              </script>
              <?php
            }
          }
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
    <!-- di dalam udah ada link parsley -->
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
                    <h5 class="mb-0">Data Peserta</h5>
                  </div>
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                          <div class="form-group row">
                            <label for="kd_peserta" class="col-sm-3 col-form-label">Kode Peserta</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="kd_peserta" name="kd_peserta" value="<?php echo $peserta['kd_peserta']; ?>" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="nm_peserta" class="col-sm-3 col-form-label">Nama Peserta</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="nm_peserta" name="nm_peserta" value="<?php echo $peserta['nm_peserta']; ?>" required data-parsley-pattern="^[a-zA-Z ]+$">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="nis" class="col-sm-3 col-form-label"> NIS</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $peserta['nis']; ?>" required data-parsley-type="number">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="kelas" class="col-sm-3 col-form-label"> Kelas</label>
                            <div class="col-sm-5">
                              <select class = "form-control" name="kelas" id="kelas">
                                <option ><?php echo $peserta['kelas']; ?></option>
                                <option>10</option>
                                <option>11</option>
                                </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="visi" class="col-sm-3 col-form-label"> Visi</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="visi" name="visi" value="<?php echo $peserta['visi']; ?>" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="misi" class="col-sm-3 col-form-label"> Misi</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="misi" name="misi" value="<?php echo $peserta['misi']; ?>" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="foto" class="col-sm-3 col-form-label">Unggah Foto</label>
                            <div class="col-sm-5">
                              <img src="uploads/<?php echo $peserta['foto']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
                                <input type="file" name="foto" class="form-control" id="foto" onchange="readURL(this)">
                                <img id="blah" src="#" alt="your image" />
                            </div>
                          </div>
                          <br>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">&nbsp;</label>
                              <div class="col-sm-10">
                                <input type="submit" name="tombol_ubah" class="btn btn-success mr-2" value="SIMPAN">
                                <a href="peserta.php" class="btn btn-light">KEMBALI</a>
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

    <!-- fungsi js onchange -->
    <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#blah').attr('src', e.target.result).width(300);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }

        $("#foto").change(function() {
        readURL(this);
        });
   </script>

   <!-- fungsi parsley -->
   <script>
    $(document).ready(function(){
      $('form').parsley();
    });
  </script>

  </body>
</html>
