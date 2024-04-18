<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parc_auto";

// Connexion à la base de données
$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$con) {
    die("La connexion a échoué: " . mysqli_connect_error());
}

// Requête pour récupérer toutes les données des véhicules par défaut
$query_vehicules = "SELECT * FROM véhicule";
$result_vehicules = mysqli_query($con, $query_vehicules);

// Si le formulaire de recherche est soumis
if(isset($_POST["search"])) {
    $matricule_v = $_POST["search"];
    // Requête de recherche des véhicules par matricule
    $query_search = "SELECT * FROM véhicule WHERE matricule_v LIKE '%$matricule_v%'";
    $result_vehicules = mysqli_query($con, $query_search);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Gestionnaire - Bon de commande</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="suiviv.css">
</head>
<body>
    <div class="grid-container">
        <!-- Entete -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
            </div>
            <div class="header-right">
                <span><i class='bx bx-bell'></i></span>
                <span><i class='bx bx-envelope'></i></span>
                <span><i class='bx bx-user'></i></span>
            </div>
        </header>
        <!-- Fin d'Entete -->

        <!-- menu -->
        <aside id="sidebar"> 
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <img src="logo-naftal.png" alt="">
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="dashboardGest.html" target="_blank">
                        <i class='bx bxs-dashboard icon'></i>
                        <span class="text nav-text">Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
            <a href="DV" target="_blank">
              <i class='bx bx-git-pull-request icon'></i>
                  <span class="text nav-text">Demande de véhicule</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#BC" target="_blank">
              <i class='bx bx-receipt icon'></i>
                    <span class="text nav-text">Bon de Commande</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="OM" target="_blank">
              <i class='bx bx-list-check icon'></i>
                    <span class="text nav-text">Ordres de Mission</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="SV" target="_blank">
              <i class='bx bxs-car-mechanic icon'></i>
                    <span class="text nav-text">Suivi de Véhicule</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="DI" target="_blank">
              <i class='bx bx-wrench icon'></i>
                    <span class="text nav-text">Demande d'interventions</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="RA" target="_blank">
              <i class='bx bxs-car-crash icon'></i>
                    <span class="text nav-text">Rapport d'Accident</span>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="parametre" target="_blank">
              <i class='bx bx-cog icon' ></i>
                <span class="text nav-text">Paramétres</span>
            </a>
          </li>
                <!-- Autres éléments du menu ici -->
            </ul>
        </aside>
        <!-- Fin du menu -->

        <!-- Main -->
        <main class="main-container">    
            <!-- Formulaire de recherche -->
            <form method="post" action="">
                <div class="search">
                    <input type="text" name="search" id="search" placeholder="Recherche par Matricule....">
                    <button type="submit"><i class='bx bx-search-alt'></i></button>
                </div>
            </form>  
            
            <!-- Tableau des véhicules -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Active</th>
                            <th>Puissance</th>
                            <th>Année</th> 
                            <th>Couleur</th> 
                            <th>Seuil_km</th> 
                            <th>km_actuel</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result_vehicules)) { ?>
                            <tr>
                                <td><?php echo $row['matricule_v']; ?></td>
                                <td><?php echo $row['marque']; ?></td>
                                <td><?php echo $row['modele']; ?></td>
                                <td><?php if ($row['flag'] == 1) { ?>
                                        <span> Active </span>
                                    <?php } else { ?>
                                        <span>Non active</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['puissance']; ?></td>   
                                <td><?php echo $row['anne_v']; ?></td>                       
                                <td><?php echo $row['couleur']; ?></td>
                                <td><?php echo $row['seuil_km']; ?></td>
                                <td><?php echo $row['km_actuel']; ?></td>
                                <td>
                                    <button class="button-style" id="di"><i class='bx bx-wrench icon' ></i></button>
                                    <button class="suivi" title="Suivi"><i class='bx bx-receipt'></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="11">Nombre de véhicules:</td>
                    </tr>
                    </tfoot>
                </table>
            </div>  
            <div id="myModal" class="modal">
            <div class="modal-content" id="modal-content">
            <div class="close"><i class='bx bx-x-circle'></i></div>    
            <div class="formulaire">
            <form method="post" action="">
                <header><h2>Suivi de véhicule</h2></header>
                <div class="input"><label>Kilométrage de depart:</label><input type="number" name="km_dep"></div>
                <div class="input"><label>Kilométrage de Retour:</label><input type="number" name="km_dep"></label></div>
                <div class="input"><label>Consommation carburants:</label><input type="number"></label></div>
                <div class="input"><label>Date</label><input type="date"></div>
                <footer>
                <button name="Terminer">Terminer</button>
                </footer>
            </form>   
            </div>
            </div>
            </div>
            </main>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
        <script src="suiviv.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </div>
</body>
</html>

<?php mysqli_close($con); ?>
