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


<div class= 'gambar'>

<?php
require 'database.php';
$query_keranjang = mysqli_query($conn,"SELECT * FROM keranjang WHERE id_akun='$id_akun'");
$total = 0;
while($keranjang = mysqli_fetch_assoc($query_keranjang)){
    $id_produk=$keranjang['id_produk'];
    $query_produk = mysqli_query($conn,"SELECT * FROM produk WHERE status!=0 AND id='$id_produk'");
    $produk = mysqli_fetch_assoc($query_produk);
     ?>
    <div class='foto'>
            <img src="<?php echo $produk['foto']; ?>">
            <h1><?php echo $produk['nama']; ?></h1>
            <p><?php echo $produk['harga']; ?></p>
            <p>Kuantitas: <?php echo $keranjang['kuantitas']; ?></p>
            <p>Total: <?php echo $produk['harga']*$keranjang['kuantitas']; ?></p>
        </div>
<?php $total = $total+($produk['harga']*$keranjang['kuantitas']); } ?>
<form action="./proses.php" method="POST">
<input type="hidden" name="id_akun" value="<?php echo $id_akun; ?>">
<button class="button" type="submit" name="submit">Beli Semua Barang <?php echo $total; ?></button>
</form>
</div>

<div class='footer'>
    <p>Copyright 2020 - <a href=''>Tokopaedi</a></p>
</div>
</div>
</body>
</html>