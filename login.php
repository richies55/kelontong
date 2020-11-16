<?php require './sesi/cekdilogin.php'; ?>
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
    <div class='foto'>
        <form action="login.php" method="POST">
            <label>Email: </label> <input type="email" size="10" name="email"> <br>
            <label>Password: </label> <input type="password" size="10" name="password"><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

</div>

<div class='footer'>
    <p>Copyright 2020 - <a href=''>Tokopaedi</a></p>
</div>
</div>
</body>
</html>

<?php
if (isset($_POST['login'])){
    if(empty($_POST['email']) || empty($_POST['password'])){
        $txt = "ISI EMAIL ATAU PASSWORD DENGAN LENGKAP";
        header("location: login.php?warning=$txt");
        exit;
    }else{
        require 'database.php';
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        // cek data di table akun
        $queryAkun = mysqli_query($conn, "SELECT * FROM akun WHERE email='$email' AND password='$password'");
        $cekAkun = mysqli_num_rows($queryAkun);
        $akun = mysqli_fetch_assoc($queryAkun);
        if($cekAkun<1 || $cekAkun>1){
            $txt = "Data tidak ditemukan atau error";
            header("location: login.php?warning=$txt");
            exit;
        }else{
            $_SESSION['pembeli'] = TRUE;
            $_SESSION['id_pembeli'] = $akun['id'];
            header("location: cart.php");
            exit;
        }
    }
    $txt = "error";
    header("location: login.php?warning=$txt");
    exit;
}
?>