<?php
session_start();  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $_POST['nume'];
    $parola = $_POST['password'];
    $xml = new DOMDocument();
    $xml->load('utilizatori.xml');
    $xpath = new DOMXPath($xml);
    $query = sprintf("/utilizatori/utilizator[nume/text()='%s' and parola/text()='%s']", $nume, $parola);
    $result = $xpath->query($query);
    if ($result->length > 0) {
        $utilizator = $result->item(0);
        $rol = $utilizator->getElementsByTagName('rol')->item(0)->nodeValue;
        $_SESSION['nume'] = $nume;
        $_SESSION['rol'] = $rol;
        if(isset($_POST['remind-me'])) {
            setcookie('nume', $nume, time()+3600);  
            setcookie('password', $parola, time()+3600);  
        }
        header('Location: index.php');  
        exit;
    } else {
        $msg = "Nume sau parolă invalide.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Koffee - Cont</title>
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
    <section>
        <div class="container">
            <div class="row block-9">
                <div class="col-md-3"></div>
                <div class="col-md-6 ftco-animate">
                    <form method="POST"  class="contact-form">
                        <?php if (isset($msg)): ?>
                        <div class="alert alert-danger" style="border-radius: 0;" role="alert">
                            <?php echo $msg; ?>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <input name="nume" type="text" class="form-control" placeholder="Nume*" style="border-radius: 0;" required>
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Parola*" style="border-radius: 0;" required>
                        </div>
                        <div class="form-check mb-4">
                            <input name="remind-me" type="checkbox" class="form-check-input" id="remind-me">
                            <label class="form-check-label" style="color: white;" for="remind-me">Ține-mă minte</label>
                        </div>
                        <div class="form-group">
                            <input name="login" type="submit" style="border-radius: 0; width: 100%;"  value="Autentificare" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                    <a href="register.php">Nu ai cont? Înregistrează-te acum!</a>
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
