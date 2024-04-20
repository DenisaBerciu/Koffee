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
        <title>Koffee - Meniu</title>
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
                                <span class="section-heading-lower">Meniu</span>
                            </h2>
                            <?php
                                class MeniuBauturiCalde {
                                    private $produse = [];
                                    public function adaugaProdus($denumire, $cantitate, $pret) {
                                        $produs = [
                                            'denumire' => $denumire,
                                            'cantitate' => $cantitate,
                                            'pret' => $pret
                                        ];
                                        $this->produse[] = $produs;
                                    }
                                    public function stergeProdus($denumire) {
                                        foreach ($this->produse as $key => $produs) {
                                            if ($produs['denumire'] === $denumire) {
                                                unset($this->produse[$key]);
                                                break;
                                            }
                                        }
                                    }
                                    public function sorteazaProduseDupaPret() {
                                        usort($this->produse, function ($produs1, $produs2) {
                                            if ($produs1['pret'] == $produs2['pret']) {
                                                return 0;
                                            }
                                            return ($produs1['pret'] < $produs2['pret']) ? -1 : 1;
                                        });
                                    }

                                    public function afiseazaMeniu() {
                                        $html = '<h3 class="title">BĂUTURI CALDE</h3>';
                                        $html .= '<hr>';
                                        $html .= '<ul class="list-unstyled list-hours mb-5 text-left mx-auto">';
                                        foreach ($this->produse as $produs) {
                                            $html .= '<li class="list-unstyled-item list-hours-item d-flex">';
                                            $html .= $produs['denumire'] . ' - ' . $produs['cantitate'];
                                            $html .= '<span class="ms-auto">' . $produs['pret'] . ' lei</span>';
                                            $html .= '</li>';
                                        }
                                        $html .= '</ul>';
                                        echo $html;
                                    }
                                }
                                $meniuBauturiCalde = new MeniuBauturiCalde();
                                $meniuBauturiCalde->adaugaProdus('Espresso', '30ml', 5);
                                $meniuBauturiCalde->adaugaProdus('Espresso macchiato', '50ml', 6);
                                $meniuBauturiCalde->adaugaProdus('Americano', '190ml', 6);
                                $meniuBauturiCalde->adaugaProdus('Cappuccino', '250ml', 7);
                                $meniuBauturiCalde->adaugaProdus('Latte', '350ml', 8);
                                $meniuBauturiCalde->adaugaProdus('Caramel latte', '450ml', 10);
                                $meniuBauturiCalde->adaugaProdus('Specialitatea casei', '450ml', 10);
                                $meniuBauturiCalde->adaugaProdus('Ceai verde', '450ml', 7);
                                $meniuBauturiCalde->adaugaProdus('Ceai de mentă', '450ml', 7);
                                $meniuBauturiCalde->adaugaProdus('Ceai de fructe de pădure', '450ml', 8);
                                $meniuBauturiCalde->adaugaProdus('Ceai de fructe exotice', '450ml', 10);
                                
                                $meniuBauturiCalde->stergeProdus('Espresso macchiato');
                                $meniuBauturiCalde->sorteazaProduseDupaPret();
                                
                                $meniuBauturiCalde->afiseazaMeniu();
                                ?>
                                <?php
                                class MeniuBauturiReci {
                                    private $produse = [];
                                    public function adaugaProdus($denumire, $cantitate, $pret) {
                                        $produs = [
                                            'denumire' => $denumire,
                                            'cantitate' => $cantitate,
                                            'pret' => $pret
                                        ];
                                        $this->produse[] = $produs;
                                    }
                                    public function stergeProdus($denumire) {
                                        foreach ($this->produse as $key => $produs) {
                                            if ($produs['denumire'] === $denumire) {
                                                unset($this->produse[$key]);
                                                break;
                                            }
                                        }
                                    }
                                    public function sorteazaProduseDupaPret() {
                                        usort($this->produse, function ($produs1, $produs2) {
                                            if ($produs1['pret'] == $produs2['pret']) {
                                                return 0;
                                            }
                                            return ($produs1['pret'] < $produs2['pret']) ? -1 : 1;
                                        });
                                    }
                                    public function afiseazaMeniu() {
                                        $html = '<h3 class="title">BĂUTURI RECI</h3>';
                                        $html .= '<hr>';
                                        $html .= '<ul class="list-unstyled list-hours mb-5 text-left mx-auto">';
                                        foreach ($this->produse as $produs) {
                                            $html .= '<li class="list-unstyled-item list-hours-item d-flex">';
                                            $html .= $produs['denumire'] . ' - ' . $produs['cantitate'];
                                            $html .= '<span class="ms-auto">' . $produs['pret'] . ' lei</span>';
                                            $html .= '</li>';
                                        }
                                        $html .= '</ul>';
                                        echo $html;
                                    }
                                }
                                $meniuBauturiReci = new MeniuBauturiReci();
                                $meniuBauturiReci->adaugaProdus('Frappe', '450ml', 12);
                                $meniuBauturiReci->adaugaProdus('Frappuccino', '450ml', 13);
                                $meniuBauturiReci->adaugaProdus('Iced Coffee', '300ml', 7);
                                $meniuBauturiReci->adaugaProdus('Iced Latte', '350ml', 9);
                                $meniuBauturiReci->adaugaProdus('Affogato', '400ml', 10);
                                $meniuBauturiReci->adaugaProdus('Iced Tea', '450ml', 8);
                                
                                //$meniuBauturiReci->stergeProdus('Frappe');
                                $meniuBauturiReci->sorteazaProduseDupaPret();
                                
                                $meniuBauturiReci->afiseazaMeniu();
                                ?>    
                            <?php
                                class MeniuMicDejun {
                                    private $produse = [];
                                    public function adaugaProdus($denumire, $cantitate, $pret) {
                                        $produs = [
                                            'denumire' => $denumire,
                                            'cantitate' => $cantitate,
                                            'pret' => $pret
                                        ];
                                        $this->produse[] = $produs;
                                    }
                                    public function stergeProdus($denumire) {
                                        foreach ($this->produse as $key => $produs) {
                                            if ($produs['denumire'] === $denumire) {
                                                unset($this->produse[$key]);
                                                break;
                                            }
                                        }
                                    }
                                    public function sorteazaProduseDupaPret() {
                                        usort($this->produse, function ($produs1, $produs2) {
                                            if ($produs1['pret'] == $produs2['pret']) {
                                                return 0;
                                            }
                                            return ($produs1['pret'] < $produs2['pret']) ? -1 : 1;
                                        });
                                    }
                                    public function afiseazaMeniu() {
                                        $html = '<h3 class="title">MIC DEJUN </h3>';
                                        $html .= '<hr>';
                                        $html .= '<ul class="list-unstyled list-hours mb-5 text-left mx-auto">';
                                        foreach ($this->produse as $produs) {
                                            $html .= '<li class="list-unstyled-item list-hours-item d-flex">';
                                            $html .= $produs['denumire'] . ' - ' . $produs['cantitate'];
                                            $html .= '<span class="ms-auto">' . $produs['pret'] . ' lei</span>';
                                            $html .= '</li>';
                                        }
                                        $html .= '</ul>';
                                        echo $html;
                                    }
                                }
                                $meniuMicDejun = new MeniuMicDejun();
                                $meniuMicDejun->adaugaProdus('Sandwich cu ouă și bacon', '300g', 12);
                                $meniuMicDejun->adaugaProdus('Sandwich cu șuncă și brânză', '300g', 12);
                                $meniuMicDejun->adaugaProdus('Sandwich cu avocado și ou', '300g', 12);
                                $meniuMicDejun->adaugaProdus('Bowl cu iaurt și fructe', '300g', 14);
                                $meniuMicDejun->adaugaProdus('Bowl cu fulgi de ovăz și semințe', '300g', 14);
                                $meniuMicDejun->adaugaProdus('Omeletă cu legume', '250g', 12);
                                
                                //$meniuMicDejun->stergeProdus('Sandwich cu ouă și bacon');
                                $meniuMicDejun->sorteazaProduseDupaPret();

                                $meniuMicDejun->afiseazaMeniu();
                                ?>    
                            <?php
                                class MeniuPranz {
                                    private $produse = [];
                                    public function adaugaProdus($denumire, $cantitate, $pret) {
                                        $produs = [
                                            'denumire' => $denumire,
                                            'cantitate' => $cantitate,
                                            'pret' => $pret
                                        ];
                                        $this->produse[] = $produs;
                                    }
                                    public function stergeProdus($denumire) {
                                        foreach ($this->produse as $key => $produs) {
                                            if ($produs['denumire'] === $denumire) {
                                                unset($this->produse[$key]);
                                                break;
                                            }
                                        }
                                    }
                                    public function sorteazaProduseDupaPret() {
                                        usort($this->produse, function ($produs1, $produs2) {
                                            if ($produs1['pret'] == $produs2['pret']) {
                                                return 0;
                                            }
                                            return ($produs1['pret'] < $produs2['pret']) ? -1 : 1;
                                        });
                                    }
                                    public function afiseazaMeniu() {
                                        $html = '<h3 class="title">PRÂNZ</h3>';
                                        $html .= '<hr>';
                                        $html .= '<ul class="list-unstyled list-hours mb-5 text-left mx-auto">';
                                        foreach ($this->produse as $produs) {
                                            $html .= '<li class="list-unstyled-item list-hours-item d-flex">';
                                            $html .= $produs['denumire'] . ' - ' . $produs['cantitate'];
                                            $html .= '<span class="ms-auto">' . $produs['pret'] . ' lei</span>';
                                            $html .= '</li>';
                                        }
                                        $html .= '</ul>';
                                        echo $html;
                                    }
                                }
                                $meniuPranz = new MeniuPranz();
                                $meniuPranz->adaugaProdus('Sandwich gourmet cu pui', '330g', 15);
                                $meniuPranz->adaugaProdus('Sandwich gourmet vegetarian', '330g', 16);
                                $meniuPranz->adaugaProdus('Salată Caesar', '300g', 13);
                                $meniuPranz->adaugaProdus('Salată mediteraneană', '300g', 12);
                                
                                //$meniuPranz->stergeProdus('Sandwich gourmet cu pui');
                                $meniuPranz->sorteazaProduseDupaPret();
                                
                                $meniuPranz->afiseazaMeniu();
                                ?>    
                            <?php
                                class MeniuDeserturi {
                                    private $produse = [];
                                    public function adaugaProdus($denumire, $cantitate, $pret) {
                                        $produs = [
                                            'denumire' => $denumire,
                                            'cantitate' => $cantitate,
                                            'pret' => $pret
                                        ];
                                        $this->produse[] = $produs;
                                    }
                                    public function stergeProdus($denumire) {
                                        foreach ($this->produse as $key => $produs) {
                                            if ($produs['denumire'] === $denumire) {
                                                unset($this->produse[$key]);
                                                break;
                                            }
                                        }
                                    }
                                    public function sorteazaProduseDupaPret() {
                                        usort($this->produse, function ($produs1, $produs2) {
                                            if ($produs1['pret'] == $produs2['pret']) {
                                                return 0;
                                            }
                                            return ($produs1['pret'] < $produs2['pret']) ? -1 : 1;
                                        });
                                    }
                                    public function afiseazaMeniu() {
                                        $html = '<h3 class="title">DESERTURI</h3>';
                                        $html .= '<hr>';
                                        $html .= '<ul class="list-unstyled list-hours mb-5 text-left mx-auto">';
                                        foreach ($this->produse as $produs) {
                                            $html .= '<li class="list-unstyled-item list-hours-item d-flex">';
                                            $html .= $produs['denumire'] . ' - ' . $produs['cantitate'];
                                            $html .= '<span class="ms-auto">' . $produs['pret'] . ' lei</span>';
                                            $html .= '</li>';
                                        }
                                        $html .= '</ul>';
                                        echo $html;
                                    }
                                }
                                $meniuDeserturi = new MeniuDeserturi();
                                $meniuDeserturi->adaugaProdus('Croissant cu ciocolată', '130g', 10);
                                $meniuDeserturi->adaugaProdus('Croissant cu fistic', '130g', 10);
                                $meniuDeserturi->adaugaProdus('Cheesecake', '110g', 10);
                                $meniuDeserturi->adaugaProdus('Tartă cu fructe', '120g', 9);
                                $meniuDeserturi->adaugaProdus('Ecler', '80g', 10);
                                $meniuDeserturi->adaugaProdus('Brownie', '100g', 10);
                                
                                //$meniuDeserturi->stergeProdus('Croissant cu ciocolată');
                                $meniuDeserturi->sorteazaProduseDupaPret();
                                
                                $meniuDeserturi->afiseazaMeniu();
                                ?>    
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


