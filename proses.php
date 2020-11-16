<?php
require './sesi/sesipembeli.php';
require 'database.php';

$id_akun = $_POST['id_akun'];
date_default_timezone_set('Asia/Jakarta');
$sekarang = date("Y-m-d H:i:s");

if(empty($id_akun)){
    header('location: index.php');
    exit;
}else{
    // cek apakah ada produk di keranjang atau tidak
    $cekData =  mysqli_query($conn, "SELECT * FROM keranjang WHERE id_akun='$id_akun'");
    // jika tidak ada, arahkan ke pembelian tanpa ada proses apapun
    if($data = mysqli_num_rows($cekData)<1){
        header("location: pembelian.php");
        exit;
    }else{
        // ada data di keranjang
        // buat kode invoice dengan kombinasi INV.datetime/id_akun
        $invoice = "INV$sekarang/$id_akun";
        // insert invoice ke status
        $status = mysqli_query($conn, "INSERT INTO status (invoice, status, resi) VALUES ('$invoice', 'pending', '0')");

        // fetch semua data di keranjang dari produk
        $cekKeranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_akun='$id_akun'");
        while($keranjang = mysqli_fetch_assoc($cekKeranjang)){
            $id_produk = $keranjang['id_produk'];
            $cekProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id_produk' AND status!=0");
            $produk = mysqli_fetch_assoc($cekProduk);
            // assign variable dari hasil fetch, biar bisa masuk ke query
            $harga = $produk['harga'];
            $kuantitas = $keranjang['kuantitas'];
            $total = $harga*$kuantitas;
            // insert masing-masing produk dengan 1 invoice yang sama ke transaksi
            $insert = mysqli_query($conn, "INSERT INTO transaksi (invoice, id_akun, id_produk, harga, kuantitas, total) VALUES ('$invoice','$id_akun','$id_produk','$harga','$kuantitas','$total')");
        }
        // hapus data di keranjang
        $hapus = mysqli_query($conn, "DELETE FROM keranjang WHERE id_akun = '$id_akun'");

        header("location: pembelian.php");
    }
}

?>