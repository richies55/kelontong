<?php session_start(); ?>
<html>
    <head>
        <title>Website Tokopaedi</title>
        <link rel='stylesheet' href='style.css'>
    <?php $id = $_GET['id'];
    if(empty($id)){
        header('location: index.php');
    }
    ?>
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
$query_produk = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id' AND status!=0 AND stok>0");
$produk = mysqli_fetch_assoc($query_produk);
?>
    <div class='foto'>
            <img src="<?php echo $produk['foto']; ?>">
            <h1><?php echo $produk['nama']; ?></h1>
            <p><?php echo $produk['harga']; ?></p>
            <p><?php echo $produk['deskripsi']; ?> </p>
            <form action="./tambahcart.php" method="POST">
            <?php if(isset($_SESSION['pembeli'])){ ?>
            <input type="hidden" name="id_produk" value="<?php echo $id; ?>">
            <input type="hidden" name="harga" value="<?php echo $produk['harga']; ?>">
            <label> Beli </label><input type="number" name="kuantitas" min="1" max="<?php echo $produk['stok'];?>" value="1">
            <button class="button" type="submit" name="submit">Tambah ke Cart</button>
            <?php }else{ ?>
            <label> <b> Login/Sign Up untuk membeli </b></label>
            <?php } ?>
            </form>
    </div>

</div>

<div class='footer'>
    <p>Copyright 2020 - <a href=''>Tokopaedi</a></p>
</div>
</div>
</body>
</html>