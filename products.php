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
        <title>Koffee - Produse</title>
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
                        <?php 
                        if(isset($_SESSION['nume'])){
                        echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" >'.$_SESSION["nume"].'</a>';
                            echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                
                                 if(isset($_SESSION['nume'])){
                                    if($pos == 'admin' ){
                                       echo '<li><a class="dropdown-item" href="administrareconturi.php">Administrare conturi</a></li>';
                                       echo '<li><hr class="dropdown-divider" /></li>';
                                        }
                                        
                                    }
                                    echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
                                    echo '</ul>';
                                    echo '</li>';
                                    }
                                    else{
                                        echo '<li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="login.php">Cont</a></li>';
                                    }
                                    ?>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="page-section clearfix">
            <div class="container" style="margin-left: 100px">
                <div class="intro">
                    <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">Amestecate cu perfecțiune</span>
                            <span class="section-heading-lower">Cafea & Ceaiuri</span>
                        </h2>
                        <p align="left">Ne mândrim cu munca noastră și acest lucru se reflectă în fiecare aspect al experienței pe care o oferim. De fiecare dată când alegeți să savurați o băutură la cafeneaua noastră, vă garantăm că veți trăi o experiență remarcabilă. Fie că optați pentru celebrul nostru cappuccino de origine etiopiană, un ceai de plante servit cu gheață sau chiar o simplă ceașcă de cafea neagră de specialitate, vă asigurăm că veți dori să reveniți mereu pentru mai mult.</p>
                    </div>
                    <video width="600" height="465" autoplay loop muted style="margin-top: 50px; margin-left: 45%;">
                        <source src="multimedia/cappucino.mp4" type="video/mp4">
                    </video>
                    <audio controls autoplay loop style="margin-top: 50px; margin-left: 59%;">
                        <source src="multimedia/coffee.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>
        </section>
        <br><br>
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="text-center bg-faded rounded p-5">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">Gustări delicioase, bucate apetisante</span>
                                <span class="section-heading-lower">Patiserie & Bucătărie</span>
                            </h2>
                            <p align="left">Indiferent dacă doriți să începeți ziua cu o gustare sănătoasă, să vă răsfățați cu un desert delicios sau să savurați o masă completă, meniul nostru sezonier vă va încânta simțurile și vă va oferi o experiență gastronomică de neuitat.Ne pasă de proveniența ingredientelor noastre și ne străduim să sprijinim comunitatea locală, de aceea suntem mândri să susținem fermele locale și să promovăm produsele organice și sustenabile.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section clearfix">
            <div class="container" style="margin-left: 100px">
                <div class="intro">
                    <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">Din jurul lumii</span>
                            <span class="section-heading-lower">Amestecuri de specialitate</span>
                        </h2>
                        <p align="left">Explorarea lumii în căutarea celor mai bune cafele de calitate este o misiune pe care o îmbrățișăm cu mândrie. Când ne veți vizita, veți descoperi mereu noi amestecuri din diferite colțuri ale lumii, cu accent pe regiunile din Columbia, Brazilia și Etiopia. Cafeaua etiopiană vă va încânta cu note florale și fructate, oferind o experiență aromată și vibrantă. Amestecurile din Brazilia aduc în ceașca dumneavoastră arome bogate de ciocolată, alune și note de caramel, oferind o experiență dulce și catifelată. Cafeaua columbiană se remarcă prin echilibrul său perfect, cu arome de nuci și cacao, oferind o experiență bogată și robustă.</p>
                    </div>
                    <img src="assets/img/products-03.jpg" alt="..." width="400" height="600" style="margin-top: 50px; margin-left: 53%;">
                </div>
                
            </div>
        </section>
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

