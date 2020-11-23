<?php
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $kriteria = new kriteria();
    $data_kriteria = $kriteria->show();
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
                <h3 class="tile-title"><a href="kriteriatambah.php" class="btn btn-success btn-sm"><i class="icon-plus"></i>&nbsp; Tambah Data</a></h3>
              
                <div class="card">
                  <div class="card-header d-block d-md-flex">
                    <h5 class="mb-0">Data Kriteria</h5>
                  </div>
                  <div class="card-body">
                    <table class="table table-hover">
                      <thead>
                        <tr align="center">
                          <th>No</th>
                          <th>Kode</th>
                          <th>Nama Kriteria</th>
                          <th>Prosentase</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody align="center">
                        <?php
                          $no = 1;
                          foreach($data_kriteria as $row)
                          {
                              echo "<tr>";
                              echo "<td>".$no."</td>";
                              echo "<td>".$row['kd_kriteria']."</td>";
                              echo "<td>".$row['nm_kriteria']."</td>";
                              echo "<td>".$row['prosentase']."</td>";
                              echo "<td align='center'><a class='btn btn-success btn-rounded btn-sm' href='kriteriaubah.php?kd_kriteria=".$row['kd_kriteria']."'><i class='icon-note btn-icon-note'></i> Ubah</a>
                              </td>";
                              $no++;
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
  </body>
</html>
