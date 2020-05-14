<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

if(isset($_SESSION['mail_resp_leg'])){
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

$notefraisDAO = new NotefraisDAO();
$notes= $notefraisDAO->findbylicence($licence_adh);

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
				<li class="active">Gestion frais</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Gestion des frais</h1>
			</div>
		</div>
		
		<!--====== GESTION FRAIS =====-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Licencié : <?php echo $adherent->getPrenom_adh() . ' ' . $adherent->getNom_adh() ;?>
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
                    <?php
                        if (count($notes) !== 0){
                            echo "<table class='table table-hover'>";
                            echo '<tr>';
                            echo '<th>Année</th>';
                            echo '<th>Bordereau validé ?</th>';
                            echo '<th>Visualiser les frais</th>';
                            echo '<th>Ajouter des frais</th>';
                            echo '</tr>';

                            foreach ($notes as $note) {
                            echo '<tr>';
                            echo '<td>'.$note->getannee().'</td>';
                            $validate = $note->getis_validate();
                            if ($validate == 0)
                            {
                                echo '<td>Non</td>';
                                echo '<td><a href="lire_ligne.php?id_note_frais='.$note->getid_note_frais().'&licence_adh='. $adherent->getLicence_adh() .'">Visualiser</a></td>';
                                echo '<td><a href="insertion_ligne.php?id_note_frais='.$note->getid_note_frais().'&licence_adh='. $adherent->getLicence_adh() .'">Ajouter</a></td>';

                            } else {
                                echo '<td>Oui</td>';
                                echo '<td>validé</td>';
                                echo '<td><a href="lire_ligne.php?id_note_frais='.$note->getid_note_frais().'&licence_adh='. $adherent->getLicence_adh() .'">Visualiser</a></td>';
                            }

                            }
                            echo '</table>';
                        }
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