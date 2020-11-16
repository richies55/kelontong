<?php require './sesi/sesipembeli.php';
      $id_akun = $_SESSION['id_pembeli'];
?>
<html>
    <head>
        <title>Website Tokopaedi</title>
        <link rel='stylesheet' href='style.css'>
    </head>
<body>
    
    <div class= 'header'>
        <div class='logo'>
            <h1>Tokopaedi</h1>
        </div>

        <?php require './elemen/navbar.php'; ?>
    </div>

<h2> Daftar Pembelian barang </h2>
<div class= 'gambar'>

<?php
require 'database.php';
$query_keranjang = mysqli_query($conn,"SELECT * FROM transaksi WHERE id_akun='$id_akun'");
while($keranjang = mysqli_fetch_assoc($query_keranjang)){
    $id_produk=$keranjang['id_produk'];
    $invoice=$keranjang['invoice'];

    $query_produk = mysqli_query($conn,"SELECT * FROM produk WHERE status!=0 AND id='$id_produk'");
    $produk = mysqli_fetch_assoc($query_produk);

    $query_status = mysqli_query($conn, "SELECT * FROM status WHERE invoice = '$invoice'");
    $status = mysqli_fetch_assoc($query_status);
     ?>
    <div class='foto'>
            <img src="<?php echo $produk['foto']; ?>">
            <h1><?php echo $produk['nama']; ?></h1>
            <p><?php echo $produk['harga']; ?></p>
            <p>Kuantitas: <?php echo $keranjang['kuantitas']; ?></p>
            <p>Total: <?php echo $produk['harga']*$keranjang['kuantitas']; ?></p>
            <p>Status: <?php echo $status['status']?></p>
            <p>Resi: <?php echo $status['resi']?></p>
        </div>
<?php } ?>
</div>

<div class='footer'>
    <p>Copyright 2020 - <a href=''>Tokopaedi</a></p>
</div>
</div>
</body>
</html>