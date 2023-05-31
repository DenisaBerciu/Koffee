<?php
session_start();
include('connection.php');

// Verifică dacă utilizatorul este autentificat și este admin
if (!isset($_SESSION['ADMIN'])) {
    header('location: index.php'); // Redirecționează utilizatorul către pagina de autentificare sau altă pagină potrivită
    exit;
}

// Verifică dacă a fost trimis un formular pentru ștergerea unui cont
if (isset($_POST['delete_account'])) {
    $id = $_POST['id'];

    // Execută interogarea pentru ștergerea contului
    $delete_query = mysqli_query($con, "DELETE FROM koffee WHERE id = '$id'");

    if ($delete_query) {
        // Contul a fost șters cu succes
        header('location: administrareconturi.php'); // Redirecționează utilizatorul înapoi la pagina de administrare a conturilor
        exit;
    } else {
        // Eroare la ștergerea contului
        echo "Eroare la ștergerea contului.";
    }
}

// Obține toate conturile din baza de date
$select_query = mysqli_query($con, "SELECT * FROM koffee");
$accounts = mysqli_fetch_all($select_query, MYSQLI_ASSOC);
?>
<?php
include('connectionimg.php');

// Verifică dacă formularul a fost trimis
if(isset($_POST['upload'])){
    // Verifică dacă un fișier a fost selectat pentru încărcare
    if(isset($_FILES['fisier']) && $_FILES['fisier']['error'] === UPLOAD_ERR_OK){
        // Obține informațiile despre fișier
        $numeFisier = $_FILES['fisier']['name'];
        $caleTemporara = $_FILES['fisier']['tmp_name'];

        // Definește calea de destinație pentru fișier
        $destFolder = "assets/destinatie/";
        $caleDestinatie = $destFolder . $numeFisier;

        // Mută fișierul încărcat în folderul de destinație
        if(move_uploaded_file($caleTemporara, $caleDestinatie)){
            // Inserare calea imaginii în baza de date
            $sql = "INSERT INTO imagini (cale_imagine) VALUES ('$caleDestinatie')";
            if ($con->query($sql) === TRUE) {
                ?>
                <script>
                    alert("Imaginea a fost încărcată și salvată în baza de date.");
                </script>
                <?php
            } else {
                echo "Eroare la încărcarea imaginii în baza de date: " . $con->error;
            }
        } else {
            echo "Eroare la mutarea fișierului în folderul de destinație.";
        }
    } else {
        echo "Nu a fost selectat niciun fișier sau a apărut o eroare la încărcare.";
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
                        <?php 
                        if(isset($_SESSION['nume'])){
                        echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" >'.$_SESSION["nume"].'</a>';
                            echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                
                                 if(isset($_SESSION['nume'])){
                                    $pos = "";
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
        
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h2 class="section-heading mb-5">
                                <span class="section-heading-lower">Încărcare fișiere</span>
                            </h2>
                                <?php
                                $result = mysqli_query($con,"SELECT * FROM imagini");
                                $row = mysqli_fetch_array($result);
                                echo "<table border='1' style='height: 100px; width: 720px;'>
                                    <tr>
                                    <th style='border: 1px solid black;'>ID</th>
                                    <th style='border: 1px solid black;'>Imagine</th>
                                    <a href=\"upload.php?id=".$row['id']."\">Încărcare</a></td>
                                    <br><br>
                                    </tr>";
                                while($row = mysqli_fetch_array($result))
                                {
                                    echo "<tr>";
                                    echo "<td style='border: 1px solid black;'>" . $row['id'] . "</td>";
                                    echo "<td style='border: 1px solid black;'> <img style='width:50px; height:50px;' src=".$row['cale_imagine']."></td>";
                                    echo "<td style='border: 1px solid black;'><a href=\"edit-image.php?id=".$row['id']."\">Editare</a>
                                    <a href=\"delete-image.php?id=".$row['id']."\">Ștergere</a>";
                                    
                                    echo "</tr>";
                                }
                                echo "</table>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; Koffee 2023</p></div><br>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>



