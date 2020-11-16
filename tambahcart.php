<?php
require 'database.php';

$id_produk = $_POST['id_produk'];
$kuantitas = $_POST['kuantitas'];
date_default_timezone_set('Asia/Jakarta');
$sekarang = date("Y-m-d H:i:s");

if(empty($id_produk) || empty($kuantitas)){
    header('location: index.php');
    exit;
}else{
    // cek apakah masih ada produknya atau enggak
    $cek_stok = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id_produk' AND stok>0");
    if($stok = mysqli_num_rows($cek_stok)<1){
        $txt = "Stok habis!";
        header("location: index.php?warning=$txt");
        exit;
    } else{
            // kurangi stok
            $kurang = mysqli_query($conn, "UPDATE produk SET stok=(stok-$kuantitas) WHERE id='$id_produk'");
            
            // cek apakah sudah ada datanya belum di akun dan barang yang sama di keranjang
             $cek_keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_produk='$id_produk' AND id_akun='1' ");
             if($keranjang = mysqli_num_rows($cek_keranjang)>0){
                $input = mysqli_query($conn, "UPDATE keranjang SET kuantitas =(kuantitas+$kuantitas) WHERE id_produk='$id_produk' AND id_akun='1'");
            }else{
                // tidak ada, buat baru
                $input = mysqli_query($conn, "INSERT INTO keranjang (id_produk, id_akun, kuantitas) VALUES ('$id_produk', '1', '$kuantitas')");
             }
            if(!$input){
                $txt = "Gagal tambah ke keranjang";
                header("location: index.php?warning=$txt");
            }else{
                $txt = "berhasil tambah ke keranjang";
                header("location: index.php?warning=$txt");
            }
    }
}

?>