<?php 
 
$conn = mysqli_connect("localhost","root","","kelontong");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>