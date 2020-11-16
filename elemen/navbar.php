<div class='navbar'>
            <ul>
                <li><a href='./index.php'>Home</a></li>
                <?php if(isset($_SESSION['pembeli'])){ ?>
                <li><a href='./cart.php'>Cart</a></li>
                <li><a href='pembelian.php'>Pembelian</a></li>
                <li><a href='./logout.php'>Logout</a></li>
                <?php } else{ ?>
                    <li><a href='./login.php'>Login</a></li>
                    <li><a href='./signup.php'>Sign Up</a></li>
                <?php } ?>

            </ul>
        </div>