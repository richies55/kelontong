<?php
session_start();

if(empty($_SESSION['pembeli'])){
    header("location: index.php");
}
?>