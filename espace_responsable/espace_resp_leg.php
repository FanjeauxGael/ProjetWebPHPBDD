<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

//On récupère l'email et l'ID du responsable legal stocké en session, si il n'y est pas, on a pas accès à la page
if (isset($_SESSION['mail_resp_leg'])) {
    $mail_resp_leg = $_SESSION['mail_resp_leg'];
    $id_resp_leg = $_SESSION['id_resp_leg'];
}else{
  header('Location: ../index.php?private=1');
}

// On récupère les infos du reponsable par son email dans $responsable_legal (tableau objet)
$responsable_legalDAO = new Responsable_legalDAO();
$responsable_legal= $responsable_legalDAO->findByMail($mail_resp_leg);

// On récupère la liste des bordereau de ses mineurs
$notefraisDAO = new NotefraisDAO();
$notes= $notefraisDAO->findBordereauBy($id_resp_leg);

// On vérifie si toutes les notes de frais des adherents mineurs sont validées (return Array)
$notes_mineurs=$notefraisDAO->findAllNoteFraisOfMineur($id_resp_leg);

// On vérifie si toutes les notes de frais des adherents mineurs sont validées (return true / false)
$bordereau_is_validate=$notefraisDAO->findIfAllNoteFraisIsValidate($id_resp_leg);
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
				<li class="active">Mon espace</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Mon espace</h1>
			</div>
		</div>
		
		<!--====== INFORMATIONS PERSONNELLES =====-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Mes informations</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Accéder à vos informations personnelles
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<thead class="thead-dark">
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Nom </th>
									<th scope="col">Prenom</th>
									<th scope="col">Adresse Mail</th>
									<th scope="col">Adresse</th>
									<th scope="col">Ville</th>
									<th scope="col">Code Postal</th>
								</tr>
							</thead>
							<tbody>
							<?php
								echo '<tr>';
								echo '<td>'.$responsable_legal->getId_resp_leg().'</td>';
								echo '<td>'.$responsable_legal->getNom_resp_leg().'</td>';
								echo '<td>'.$responsable_legal->getPrenom_resp_leg().'</td>';
								echo '<td>'.$responsable_legal->getMail_resp_leg().'</td>';
								echo '<td>'.$responsable_legal->getRue_resp_leg().'</td>';
								echo '<td>'.$responsable_legal->getVille_resp_leg().'</td>';
								echo '<td>'.$responsable_legal->getCp_resp_leg().'</td>';
								echo '</tr>';
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== FIN INFORMATIONS PERSONNELLES =====-->


		<!--====== ADHERENTS MINEURS =====-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Adhérent(s) mineur(s) à votre charge</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Gérez les adhérents mineurs et les frais qui leurs sont associés
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
					<?php
						if(isset($_GET["inscrit"])){
							echo '<p align"center"><strong>Le licencié mineur à votre charge à bien été enregistré.</strong></p>';
						}

						//On prépare les mathodes DAO de Adhérent (car on doit retourner la liste des adhérents mineur inscrits par le responsable legal)
						$adherentDAO = new AdherentDAO();

						//On récupère la liste des ADHERENTS mineurs inscrits par le responsable legal
						$adherents_resp_leg = $adherentDAO->findAllByIdRespLeg($id_resp_leg);

						//Si des adhérents ont été ajoutés par le responsable légal, on les affichent
							if ($adherents_resp_leg ==!null) {
								?>
						
						<!-- Affichage des adhérents mineurs ---------------------------------- -->
						<table class="table table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Licence</th>
									<th>Nom</th>
									<th>Prenom</th>
									<th>Frais</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($adherents_resp_leg as $adherent) {
								$licence = $adherent->getLicence_adh();
								echo '<tr>';
								echo '<td>'.$adherent->getLicence_adh().'</td>';
								echo '<td>'.$adherent->getNom_adh().'</td>';
								echo '<td>'.$adherent->getPrenom_adh().'</td>';

								// Si la note de frais de l'adhérent mineur est validée, on ne peut plus gérer ses frais
								foreach($notes_mineurs as $note_mineur){
									if($note_mineur->getlicence_adh() == $adherent->getLicence_adh() && $note_mineur->getis_validate() == false){
											echo '<td><p><a class="btn btn-primary" href="list_borderaux_mineur.php?id_resp_leg='. $id_resp_leg .'&licence_adh='. $adherent->getLicence_adh() .'" role="button">Accéder aux frais</a></p></td>';
										} elseif($note_mineur->getlicence_adh() == $adherent->getLicence_adh() && $note_mineur->getis_validate() == true) {
											echo '<td><p>Les gestion des frais pour cet adhérent mineur a été validée.</p></td>';
										}
									}
								}
								echo '<tr>';
							?>
							</tbody>
						</table>

						<?php
							}else{
							echo '<p>Vous n\'avez pas encore inscrit d\'adhérents mineurs.</p>';
							}
						?>
					<!-- Fin d'affichage des adhérents mineurs ------------------------------ -->

					<br />
					<p class="text-danger">Pour inscrire un nouvel adhérent mineur à votre charge, cliquez sur "Ajouter un adhérent mineur".</p>
					<p><a class="btn btn-primary" href="register_adh_mineur.php" role="button">Ajouter un adhérent mineur</a></p>
		  
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== FIN ADHERENTS MINEURS =====-->


		<!--====== BORDEREAUX =====-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Mes bordereaux</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">Gérez vos borderaux
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
					<?php
					$annee = date('Y');
					if ($bordereau_is_validate == true){
						var_dump($bordereau_is_validate);
                        echo "<table class='table table-hover'";
                        echo '<tr>';
                        echo '<th>Année</th>';
                        echo '<th>Validé</th>';
                        echo '<th>Exemplaire en PDF</th>';
                        echo '</tr>';
                    
                        echo '<tr>';
                    	echo '<td>'.$annee.'</td>';
						echo '<td>Oui</td>';
                    	echo '<td><a href="pdf_resp.php?id_resp_leg='. $id_resp_leg .'&annee='.$annee.'">Lien en PDF</a></td>';
                        echo '</tr>';
                        echo '</table>';
                    } else {
                        echo 'Tous les frais n\'ont pas encore été validés.';
                        echo'</br>';echo'</br>';
                        echo '<p>Veuillez ajouter des frais ou attendre la validation du trésorier.</p>';
                    }
					?>

					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== FIN BORDEREAUX =====-->

	</div><!--/.main-->
	
	<?php 
include('../inc/script_niveau2.php') ; 
?>
		
</body>
</html>