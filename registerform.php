<?php
include 'connection.php';
session_start();
if(isset($_COOKIE['nume']) && !isset($_SESSION['nume']))
{
	$_SESSION['nume'] = $_COOKIE['nume'];
}
if(isset($_SESSION['nume'])){
    $sql="SELECT * FROM koffee WHERE nume='{$_SESSION['nume']}'";
    $query=mysqli_query($con,$sql) or die(mysqli_query($con));
    $record=mysqli_fetch_array($query);
    $pos=$record['utilizator'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Koffee - Acasă</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <span class="site-heading-lower">Koffee</span>
            </h1>
        </header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">KOFFEE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Acasă</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about.php">Despre</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.php">Produse</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="galerie.php">Galerie</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="menu.php">Meniu</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="store.php">Cafenea</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="login.php">Cont</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>
        <div class="row block-9">
	            <div class="col-md-3"></div>
                    <div id="main-column" class="col-md-6 ftco-animate">
                        <svg width="593" height="100">
                        <rect width="593" height="100" style="fill:rgba(230, 167, 86, 0.9);" />
                        <foreignObject x="90" y="20" width="400" height="90">
                        <canvas id="myCanvas" width="400" height="90">
                            Your browser does not support the HTML canvas tag.
                        </canvas>
                        </foreignObject>
                        </svg>
                        
                        <script>
                            var c = document.getElementById("myCanvas");
                            var ctx = c.getContext("2d");
                            ctx.font = "lighter 50px Courier New";
                            ctx.fillStyle = "#000";
                            ctx.textAlign = "center";
                            ctx.imageSmoothingEnabled = true;
                            ctx.fillText("ÎNREGISTRARE", c.width/2, c.height/2);
                        </script>
                        <form id="register-form" method="POST" action="register.php" name="form1" onsubmit="return checkCaptcha();" class="contact-form">
                        	<script>
                                var captcha, cahrs;

                                function getNewCaptcha(){
                                    chars="1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                                    captcha = chars[Math.floor(Math.random()*chars.length)];
                                    for(var i=0;i<5;i++){
                                        captcha=captcha+chars[Math.floor(Math.random()*chars.length)];
                                    }
                                    form1.ct.value=captcha;
                                }

                                function checkCaptcha(){
                                    var check=document.getElementById("ci").value;
                                    if(captcha==check){
                                        return true;
                                    }
                                    else{
                                        alert("Invalid captcha");
                                        return false;
                                    }
                                }

                                getNewCaptcha();
                            </script>
                            <div class="form-group">
                                <input name="nume"  type="text" class="form-control" style="border-radius: 0;" placeholder="Nume*" required>
                            </div>
                           
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" style="border-radius: 0;" placeholder="Parola*" required>
                            <input class="notlong" type="text" id="cta" name="ct" value="####" readonly>
                           
                            <div style="display: flex; align-items: center;">
                                <input class="notlong" type="text" id="ci" placeholder="Captcha" style="width:297px;">
                                <input class="rfr" type="button" value="Refresh" id="refreshbtn" style="width: 297px; height: 50px; margin-left: 10px;" onclick="getNewCaptcha()">
                            </div>

                                
                            <div class="form-group">
                            <button name="register-button"  class="btn btn-primary py-3 px-5" style="border-radius: 0;" onclick="OnRegister();">Înregistrare</button>
                        </div>
                        </form>
                        
                        <a href="login.php">Ai deja un cont?</a>
                    </div>
                </div>
            </div>
        <br><br>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; Koffee 2023</p></div><br>
        
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
