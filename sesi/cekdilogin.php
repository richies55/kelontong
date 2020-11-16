<?php
session_start();

if(isset($_SESSION['pembeli'])){
    header("location: index.php");
}
?>