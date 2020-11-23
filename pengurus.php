<!-- coba css dan js sweetalert -->
    <link rel="stylesheet" href="dist/sweetalert2.css">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="dist/sweetalert2.all.min.js"></script>

<?php
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $pengurus = new pengurus();
    $data_pengurus = $pengurus->show();

    if(isset($_GET['kd_pengurus'])){
        $kode = $_GET['kd_pengurus'];
        $hapus = $pengurus->delete($kode);
        if ($hapus) { ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Data pengurus berhasil dihapus',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('pengurus.php');
            }, 3000);
            //alert('Data Berhasil Dihapus');
            //document.location='pengurus.php'
          </script>
          <?php
        } else{ ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'error', title : 'Gagal',
                text : 'Data pengguna gagal dihapus',
                type : 'Error', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('pengurus.php');
            }, 3000);
            //alert('Data Gagal Dihapus');
            //document.location='pengurus.php'
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
    <title>Admin Panitia</title>
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
                <h3 class="tile-title"><a href="pengurustambah.php" class="btn btn-success btn-sm"><i class="icon-plus"></i>&nbsp; Tambah Data</a></h3>
              
                <div class="card">
                  <div class="card-header d-block d-md-flex">
                    <h5 class="mb-0">Data pengurus OSIS</h5>
                  </div>
                  <div class="card-body">
                    <table class="table table-hover">
                      <thead>
                        <tr align="center">
                          <th>No</th>
                          <th>Kode</th>
                          <th>Nama Pengurus</th>
                          <th>Jabatan</th>
                          <th>Masa Bakti</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody align="center">
                        <?php
                          $no = 1;
                          foreach($data_pengurus as $row)
                          {
                              echo "<tr>";
                              echo "<td>".$no."</td>";
                              echo "<td>".$row['kd_pengurus']."</td>";
                              echo "<td>".$row['nm_pengurus']."</td>";
                              echo "<td>".$row['jabatan']."</td>";
                              echo "<td>".$row['masa_bakti']."</td>";
                              ?>
                              <td align='center'>
                                <a class='btn btn-success btn-rounded btn-sm' href='pengurusubah.php?kd_pengurus=<?=$row['kd_pengurus']; ?>'><i class='icon-note btn-icon-note'></i> Ubah</a>
                                <a class='delete-link btn btn-danger btn-rounded btn-sm' href='pengurus.php?kd_pengurus=<?=$row['kd_pengurus']; ?> '><i class='icon-note btn-icon-note'></i> Hapus</a>
                              </td>
                             <?php $no++;
                          }
                        ?>
                      </tbody>
                    </table>
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
        jQuery(document).ready(function($){
            $('.delete-link').on('click',function(){
                var getLink = $(this).attr('href');
                Swal.fire({
                        icon : "question",
                        title: "Hapus Data?",
                        text: "data akan dihapus",
                        type: "warning",
                        confirmButtonColor: '#d9534f',
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: 'Yes',
                        showCancelButton: true,
                        closeOnConfirm: false,
                        selectCancelButton : false
                        }).then ((result)=>{
                          if(result.value){
                            document.location.href = getLink;
                          }
                          else{
                            return false;
                          }
                    });
                return false;
            });
        });
    </script>
   
   <!-- <script>
        jQuery(document).ready(function($){
            $('.delete-link').on('click',function(){
                var getLink = $(this).attr('href');
                Swal.fire({
                        icon : 'question',
                        title: 'Hapus Data',
                        text: 'anda yakin akan hapus data ini?',
                        type : 'warning',
                        confirmButtonColor: '#d9534f',
                        showCancelButton: true,
                        confirmButtonText: "Yes", 
                        html : true,  
                        closeOnConfirm: false
                        },function(){
                          
                        window.location.href = 'pengurushapus.php?kd_pengurus=<?=$row['kd_pengurus']; ?>'
                    });
                return false;
            });
        });
    </script>
    

  </body>
</html>
