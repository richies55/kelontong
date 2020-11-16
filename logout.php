<?php 
      session_start();
      unset($_SESSION['pembeli']);
      unset($_SESSION['id_pembeli']);
      $txt = "Berhasil Logout";
      header("location: login.php?warning=$txt");
      exit;
?>