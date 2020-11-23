<?php
	session_start();
	session_destroy();
?>
<!-- coba css dan js sweetalert -->
    <link rel="stylesheet" href="dist/sweetalert2.css">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="dist/sweetalert2.all.min.js"></script>
	<script type="text/javascript">
		 setTimeout(function(){
	              Swal.fire({
	                icon : 'success', title : 'Sukses',
	                text : 'Anda Telah Logout',
	                type : 'Success', timer : 3200,
	                showConfirmButton : true
	              });
	            }, 10);

	            window.setTimeout(function(){
	              window.location.replace('login.php');
	            }, 3000);
		//alert('Anda Telah Logout');
		//document.location='login.php';
	</script>
<?php
	
?>