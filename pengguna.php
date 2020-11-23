<!-- coba css dan js sweetalert -->
    <link rel="stylesheet" href="dist/sweetalert2.css">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="dist/sweetalert2.all.min.js"></script>

<?php
    //autoload class
    error_reporting(E_ALL);
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $pengguna = new pengguna();
    $data_pengguna = $pengguna->show();

    if(isset($_GET['kd_pengguna'])){
        $kode = $_GET['kd_pengguna'];
        $hapus = $pengguna->delete($kode);
        if ($hapus) { ?>
          <script type="text/javascript">
            setTimeout(function(){
              Swal.fire({
                icon : 'success', title : 'Sukses',
                text : 'Data pengguna berhasil dihapus',
                type : 'Success', timer : 3200,
                showConfirmButton : true
              });
            }, 10);

            window.setTimeout(function(){
              window.location.replace('pengguna.php');
            }, 3000);
            //alert('Data Berhasil Dihapus');
            //document.location='pengguna.php'
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
              window.location.replace('pengguna.php');
            }, 3000);
            //alert('Data Gagal Diubah');
            //document.location='pengguna.php'
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
                <h3 class="tile-title"><a href="penggunatambah.php" class="btn btn-success btn-sm"><i class="icon-plus"></i>&nbsp; Tambah Data</a></h3>
              
                <div class="card">
                  <div class="card-header d-block d-md-flex">
                    <h5 class="mb-0">Data pengguna</h5>
                  </div>
                  <div class="card-body">
                    <table class="table table-hover">
                      <thead>
                        <tr align="center">
                          <th>No</th>
                          <th>Kode</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Level</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody align="center">
                        <?php
                          $no = 1;
                          foreach($data_pengguna as $row)
                          {
                              echo "<tr>";
                              echo "<td>".$no."</td>";
                              echo "<td>".$row['kd_pengguna']."</td>";
                              echo "<td>".$row['username']."</td>";
                              echo "<td>".$row['password']."</td>";
                              echo "<td>".$row['level']."</td>";
                              ?>
                              <td align='center'>
                                <a class='btn btn-success btn-rounded btn-sm' href='penggunaubah.php?kd_pengguna=<?=$row['kd_pengguna']; ?>'><i class='icon-note btn-icon-note'></i> Ubah</a>
                                <a  href='pengguna.php?kd_pengguna=<?=$row['kd_pengguna']; ?> ' class='btn btn-danger btn-rounded btn-sm delete-link'><i class='icon-note btn-icon-note'></i> Hapus</a>
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

<!--<script>
   $('.delete-link').on('click',function(e){
    e.preventDefault();
     const getLink = $(this).attr('href');

     Swal.fire({
                        icon : 'question',
                        title: 'Hapus Data',
                        text: 'anda yakin akan hapus data ini?',
                        type : 'warning',
                        confirmButtonColor: '#d9534f',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        closeOnConfirm: false,
                        }).then((result)=>{
                          if((result)){
                            document.location.href = getLink;
                          }
                        })
   }
</script>
   
<script>
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
                          
                        window.location.href = 'penggunahapus.php?kd_pengguna=<?=$row['kd_pengguna']; ?>'
                    });
                return false;
            });
        });
    </script>
    

  </body>
</html>
