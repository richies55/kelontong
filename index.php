<?php session_start() ?>
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
$query_produk = mysqli_query($conn,"SELECT * FROM produk WHERE status!=0 AND stok>0");

while($produk = mysqli_fetch_assoc($query_produk)){
     ?>
    <div class='foto'>
            <img src="<?php echo $produk['foto']; ?>">
            <h1><?php echo $produk['nama']; ?></h1>
            <p><?php echo $produk['harga']; ?></p>
            <a href="./detail.php?id=<?php echo $produk['id'];?>">Beli Sekarang</a>
        </div>
<?php } ?>

</div>

<div class='footer'>
    <p>Copyright 2020 - <a href=''>Tokopaedi</a></p>
</div>
</div>
</body>
</html>