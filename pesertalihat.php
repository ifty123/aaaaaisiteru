<?php
	error_reporting(E_ALL);
	session_start();

	spl_autoload_register(function($class_name){
		include 'kelas/'.$class_name.'.php';
	});

	$pesertaambil = new peserta();

	if(isset($_GET['kd_peserta'])){
		$kode = $_GET['kd_peserta'];
		$peserta = $pesertaambil->get_by_id($kode);
	}
	else{
		header('location: peserta.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Lihat Peserta</title>
	<?php include "linkcss.php"; ?>
</head>
<body>
	<div class="container-scroller">
		 <?php include "navbar.php"; ?>
		 <div class="container-fluid page-body-wrapper">
		 	<?php include "sidebar.php"; ?>
		 	<div class="main-panel">
		 		<div class="content-wrapper">
		 			<!-- main -->
		 			<div class="row quick-action-toolbar">
		              <div class="col-md-12 grid-margin">

		                <div class="card">
		                  <div class="card-header d-block d-md-flex">
		                    <h5 class="mb-0">Biodata Peserta</h5>
		                  </div>
		                  <h3><center>DETAIL BIODATA PESERTA</center></h3>
		                  <hr>
		                  <table width="900" align="center">
		                  	<tr>
		                  		<td rowspan="10" valign="top"><img align="left" src="uploads/<?php echo $peserta['foto']; ?>"  style="width: 200px;float: left;margin-bottom: 7px; margin-left: 20px;"></td>
		                  		<td></td>
		                  		<td>Kode Peserta</td><td> : </td> <td><?php echo $peserta['kd_peserta']; ?></td>
		                  	</tr>
		                  	<tr>
		                  		<td></td>
		                  		<td>Nama</td>	<td> : </td>
		                  		<td><?php echo $peserta['nm_peserta']; ?></td>
		                  	</tr>
		                  	<tr>
		                  		<td></td>
		                  		<td>NIS</td><td> : </td>
		                  		<td><?php echo $peserta['nis']; ?></td>
		                  	</tr>
		                  	<tr>
		                  		<td></td>
		                  		<td>Kelas</td><td> : </td>
		                  		<td><?php echo $peserta['kelas']; ?></td>
		                  	</tr>
		                  	<tr>
		                  		<td></td>
		                  		<td>Visi</td><td> : </td>
		                  		<td><?php echo $peserta['visi']; ?></td>
		                  	</tr>
		                  	<tr>
		                  		<td></td>
		                  		<td>Misi</td><td> : </td>
		                  		<td><?php echo $peserta['misi']; ?></td>
		                  	</tr>
		                  </table>
		                </div>
		              </div>
           			 </div>
           			 <a href="peserta.php" class="btn btn-inverse-primary">KEMBALI</a>
		 			<!-- bawah -->
		 		</div>
		 	</div>
		 	
		 </div>
	</div>
</body>
</html>