<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

if (isset($_SESSION['mail_inscrit'])) {
    // Si l'adhérent MAJEUR est connecté, on récupère son mail stocké en SESSION lors de la connexion
    $mail_inscrit = $_SESSION['mail_inscrit'];

    // Et les infos de l'adherent majeur dans $adherent (tableau objet) et notamment sa licence
    $adherentDAO = new AdherentDAO();
    $adherent= $adherentDAO->findByMail($mail_inscrit);
    $licence_adh = $adherent->getLicence_adh();

}elseif(isset($_SESSION['mail_resp_leg'])){
    // Si le responsable est connecté, on récupère son ID stocké en SESSION lors de la connexion
    $id_resp_leg = $_SESSION['id_resp_leg'];
    $mail_resp_leg = $_SESSION['mail_resp_leg'];

    // Et les infos de l'adherent mineur dans $adherent (tableau objet) et notamment sa licence (via le lien => GET)
    $adherentDAO = new AdherentDAO();
    $licence_adh = isset($_GET['licence_adh']) ? $_GET['licence_adh'] : "";
    $adherent= $adherentDAO->find($licence_adh);
}else{
    // Sinon on redirige vers la page d'accueil avec un message d'erreur
    header('Location: ../index.php?private=1');
}

//Préparation des méthodes DAO  des lignes de frais
$lignefraisDAO = new LignefraisDAO;

//Récupération des motifs de frais
$motifDAO = new MotifDAO();
$motifs = $motifDAO->findAll();

// On récupère les infos du reponsable par son email dans $responsable_legal (tableau objet)
$responsable_legalDAO = new Responsable_legalDAO();
$responsable_legal= $responsable_legalDAO->findByMail($mail_resp_leg);
?>

<body>

<?php
// Barre verticale avec logo
include('../inc/header.php') ; 

// Barre horizontale de navigation
include('../inc/navbar.php') ;
?>
	<!-- PAGE -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<!-- BREADCRUMB -->
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
                </a></li>
                <li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
					Frais
				</a></li>
				<li class="active">Ajout frais</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Ajouter des frais</h1>
			</div>
		</div>
		
		<!--====== AJOUT FRAIS =====-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Licencié : <?php echo $adherent->getPrenom_adh() . ' ' . $adherent->getNom_adh() ;?>
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
                    <?php
                        $submit = isset($_POST['submit']);

                        if($submit){
                            $date_frais = isset($_POST['date_frais']) ? $_POST['date_frais'] : "";
                            $km_parcourus = isset($_POST['km_parcourus']) ? $_POST['km_parcourus'] : "";
                            $trajet_frais = isset($_POST['trajet_frais']) ? $_POST['trajet_frais'] : "";
                            $cout_peage = isset($_POST['cout_peage']) ? $_POST['cout_peage'] : "";
                            $cout_repas = isset($_POST['cout_repas']) ? $_POST['cout_repas'] : "";
                            $cout_hebergement = isset($_POST['cout_hebergement']) ? $_POST['cout_hebergement'] : "";
                            $id_motif = isset($_POST['Id_motif']) ? $_POST['Id_motif'] : "";
                            $id_note_frais = $_GET['id_note_frais'] ? $_GET['id_note_frais'] : "";

                            if (is_numeric($km_parcourus) && is_numeric($cout_peage) && is_numeric($cout_repas) && is_numeric($cout_hebergement)) {
                                $lignefrais =  new lignefrais(array(
                                ":date_frais" => $date_frais,
                                ":trajet_frais" => $trajet_frais,
                                ":km_parcourus" =>  $km_parcourus,
                                ":cout_peage" => $cout_peage,
                                ":cout_repas" => $cout_repas,
                                ":cout_hebergement" => $cout_hebergement,
                                ":Id_motif" => $id_motif,
                                ":id_note_frais" => $id_note_frais
                            ));
                                // Ajoute l'enregistrement dans la BDD
                                $licence_adh = $adherent->getLicence_adh();

                                $nb = $lignefraisDAO->insert($date_frais, $trajet_frais, $km_parcourus, $cout_peage, $cout_repas, $cout_hebergement, $id_motif, $id_note_frais);

                                rediriger('lire_ligne.php?ligne_ajoutee=1&id_note_frais='.$id_note_frais.'&licence_adh='. $adherent->getLicence_adh() .'');
                                // Obligatoire sinon PHP continue à exécuter le script
                                exit;
                            }else{
                                echo '<p align="center">Vous devez saisir les <strong>bonnes valeurs</strong> (nombres/textes)</p>';
                            }
                        } else {
                            //$erreur = "<p align='center'><strong>Vous n'avez pas saisis toutes les informations ! Veuillez remplir tous les champs svp.</strong></p>";
                        }

                            // Ajout du formulaire d'inscription
                            include '../forms/ADH_insertion_ligne_Form.php';
                    ?>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== GESTION FRAIS =====-->
	</div><!--/.main-->
	
	<?php 
include('../inc/script_niveau2.php') ; 
?>
		
</body>
</html>