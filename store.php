<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Koffee - Cafenea</title>
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
                            $pos = $_SESSION['rol'] ?? ''; // Presupunem că rolul este stocat în sesiune cu cheia 'rol'
                            if($pos == 'admin' ){
                               echo '<li><a class="dropdown-item" href="administrareconturi.php">Administrare conturi</a></li>';
                               echo '<li><a class="dropdown-item" href="incarcarefisiere.php">Încărcare fișiere</a></li>';
                               echo '<li><hr class="dropdown-divider" /></li>';
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
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h2 class="section-heading mb-5">
                                <span class="section-heading-lower">Program</span>
                            </h2>
                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    Luni
                                    <span class="ms-auto">7:00 - 20:00</span>
                                </li>
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    Marți
                                    <span class="ms-auto">7:00 - 20:00</span>
                                </li>
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    Miercuri
                                    <span class="ms-auto">7:00 - 20:00</span>
                                </li>
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    Joi
                                    <span class="ms-auto">7:00 - 20:00</span>
                                </li>
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    Vineri
                                    <span class="ms-auto">7:00 - 20:00</span>
                                </li>
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    Sâmbătă
                                    <span class="ms-auto">9:00 - 17:00</span>
                                </li>
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    Duminică
                                    <span class="ms-auto">Închis</span>
                                </li>
                            </ul>
                            

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(47.1748064085288, 27.571600990967628),
  zoom:15,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({
        position: new google.maps.LatLng(47.1748064085288, 27.571600990967628),
        map: map,
        title: 'Universitatea Alexandru Ioan Cuza'
      });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvLbvn6QaPXKNHIHfuw6MIX2QtqeMQFUw&callback=myMap"></script>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        
        <section class="page-section about-heading">
            <div class="container">
                <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="assets/img/about.jpg" alt="..." />
                <div class="about-heading-content">
                    <div class="row">
                        <div class="col-xl-9 col-lg-10 mx-auto">
                            <div class="bg-faded rounded p-5">
                                <h2 class="section-heading mb-4">
                                    <span class="section-heading-lower">Despre cafeneaua noastră</span>
                                </h2>
                                <p>Amplasată într-o locație privilegiată, într-una dintre cele mai frumoase zone ale Iașului, cafeneaua noastră vă așteaptă să vă bucurați de momente de pură plăcere și delicii culinare. Veți fi întâmpinați de o atmosferă primitoare și sofisticată, cu un design elegant și atenție la detalii. Interiorul nostru modern, combinat cu accentele calde și confortabile, creează un cadru perfect pentru a vă relaxa și a savura cea mai bună cafea din oraș. Suntem mândri să vă oferim o gamă variată de băuturi calde și reci, pregătite cu măiestrie de barista noștri pasionați. Indiferent dacă sunteți un iubitor al cafelei sau preferați ceaiurile aromate, veți găsi cu siguranță ceva pe placul dumneavoastră în meniul nostru select.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; Koffee 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>


