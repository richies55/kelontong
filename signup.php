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
        <form action="signup.php" method="POST">
            <label>Nama: </label> <input type="text" size="10" name="nama"> <br>
            <label>Email: </label> <input type="email" size="10" name="email"> <br>
            <label>Password: </label> <input type="password" size="10" name="password"><br>
            <button type="submit" name="signup">Sign Up</button>
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
if (isset($_POST['signup'])){
    if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['nama'])){
        $txt = "ISI DATA DENGAN LENGKAP";
        header("location: signup.php?warning=$txt");
        exit;
    }else{
        require 'database.php';
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $nama = $_POST['nama'];
        // cek data di table akun apakah sudah ada email yang sama atau belum
        $queryAkun = mysqli_query($conn, "SELECT * FROM akun WHERE email='$email'");
        $cekAkun = mysqli_num_rows($queryAkun);
        $akun = mysqli_fetch_assoc($queryAkun);
        // jika email sudah ada yang mendaftarkan
        if($cekAkun>1){
            $txt = "Email sudah pernah teregister";
            header("location: signup.php?warning=$txt");
            exit;
        }else{
            // email belum pernah didaftarkan, maka daftarkan akun baru ke database
            $daftarkan = mysqli_query($conn, "INSERT INTO akun (nama, email, password) VALUES ('$nama','$email','$password')");
            $txt = "Sukses teregister, silakan login";
            header("location: login.php?warning=$txt");
            exit;
        }
    }
    $txt = "error";
    header("location: signup.php?warning=$txt");
    exit;
}
?>