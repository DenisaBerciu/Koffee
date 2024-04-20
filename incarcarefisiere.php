<?php
session_start();
define("UPLOAD_DIR", "assets/img/");
if (isset($_POST['upload'])) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['image']['name'];
        $tempFilePath = $_FILES['image']['tmp_name'];
        $destinationPath = UPLOAD_DIR . basename($fileName);
        if (move_uploaded_file($tempFilePath, $destinationPath)) {
            $xml = file_exists('images.xml') ? simplexml_load_file('images.xml') : new SimpleXMLElement('<content><images></images></content>');
            $imageEntry = $xml->images->addChild('image');
            $imageEntry->addChild('src', UPLOAD_DIR . basename($fileName));
            $imageEntry->addChild('name', $fileName);
            $mathML = $imageEntry->addChild('math');
            $mathML->addChild('mrow');
            $mathML->mrow->addChild('mi', 'a');
            $mathML->mrow->addChild('mo', '+');
            $mathML->mrow->addChild('mi', 'b');
            $mathML->mrow->addChild('mo', '=');
            $mathML->mrow->addChild('mi', 'c');
            $svgData = $imageEntry->addChild('svg');
            $svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"><circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow"/></svg>';
            $svgData[0] = $svgContent;
            $xml->asXML('images.xml');
            echo '<script>alert("Imaginea a fost încărcată și salvată în XML.")</script>';
        } else {
            echo "Eroare la mutarea fișierului în folderul de destinație.";
        }
    } else {
        echo "Nu a fost selectată nicio imagine sau a apărut o eroare la încărcare.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Koffee - Încărcare fișiere</title>
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
                    <?php if (isset($_SESSION['nume'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION["nume"]; ?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if ($_SESSION['role'] == 'admin'): ?>
                                    <li><a class="dropdown-item" href="administrareconturi.php">Administrare conturi</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="login.php">Cont</a></li>
                    <?php endif; ?>
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
                        <span class="section-heading-lower">Încărcare fișiere</span>
                    </h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" id="image">
                        <button type="submit" name="upload">Încarcă imaginea</button>
                    </form>
                    <?php
                    $xml = new DOMDocument();
                    $xml->load('images.xml');
                    $xsl = new DOMDocument();
                    $xsl->load('images.xsl');
                    $proc = new XSLTProcessor();
                    $proc->importStyleSheet($xsl);
                    echo $proc->transformToXML($xml);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; Koffee 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
