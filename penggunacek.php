<?php
error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $pengguna = new pengguna();

    if(isset($_POST['user_name'])){
      $username = $_POST['user_name'];
      $validasi = $pengguna->tidaksama($username);
        if(($validasi) > 0){
          echo '<span class="text-danger"><font size="2">Username sudah tersedia</font></span>';
        }
        else{
          echo '<span class="text-succes">Username boleh dipakai</span>';
        }
    }
?>