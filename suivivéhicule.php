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

// Requête pour récupérer les valeurs de matricule_v existantes
$query_matricules = "SELECT DISTINCT matricule_v FROM véhicule";
$result_matricules = mysqli_query($con, $query_matricules);
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
    <link rel="stylesheet" href="suivivéhicule.css">
</head>
<body>
    <div class="grid-container">
        <!-- Entete -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left"></div>
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
            <div class="table-container">
                <table>
                    <thead><!-- Entête du tableau -->
                        <tr>
                            <th>Matricule de véhicule</th>
                            <th>Kilométrage 1</th>
                            <th>Kilométrage 2</th>
                            <th>Kilométrage actuel</th>
                            <th>Seuil</th>
                            <th>Date</th> 
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                                <td>
                                <select id="mat" name="matricule_v">
                                <option value="">Matricule</option>
                                <?php while($row_matricule = mysqli_fetch_assoc($result_matricules)) { ?>
                                <option value="<?php echo $row_matricule['matricule_v']; ?>"><?php echo $row_matricule['matricule_v']; ?></option>
                                <?php } ?>
                                </select>
                                </td>
                                <td><input class="km"></td>
                                <td><input class="km"></td>
                                <td></td>
                                <td></td>   
                                <td><input type="date"></td>                       
                                <td><button class="button-style" ><i class='bx bx-wrench icon'></i></button></td>
                            </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">Nombre de demandes:</td>
                        </tr>
                    </tfoot>
                </table>
            </div>   
        </main>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
        <script src="demandeGest.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </div>
</body>
</html>

<?php mysqli_close($con); ?>
