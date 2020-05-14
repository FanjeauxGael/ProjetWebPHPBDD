<?php
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ; 

// Configuration des classes / DAO / BDD
include '../config/init.php';

// Restriction liée à la page
include '../inc/user_restriction.php';

?>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Connexion Espace Responsable</div>
				<div class="panel-body">
					<?php
					// Détermine si on a cliqué sur le bouton submit
					$submit = isset($_POST['submit']);
					$erreur = "";

					// Formulaire soumi
					if ($submit) {

						// Toutes les données sont saisies
						if (!empty($_POST['mail_resp_leg']) and !empty($_POST['mdp_resp_leg'])) {

							// Récupère les données du formulaire
							$mail_resp_leg = isset($_POST['mail_resp_leg']) ? $_POST['mail_resp_leg'] : '';
							$mdp_resp_leg = isset($_POST['mdp_resp_leg']) ? $_POST['mdp_resp_leg'] : '';

							//-- On instencie le DAO de Responsable_legalDAO --//
							$responsable_legal = new Responsable_legalDAO;

							//On vérifie que le mail et mdp soient correct
							if ($responsable_legal->est_inscrit($mail_resp_leg, $mdp_resp_leg)) {
								
								// On récupère les données du responsable pour les mettre dans un tableau objet ($responsable_legal) afin de les stocker en session
								$responsable_legalDAO = new Responsable_legalDAO();
								$responsable_legal= $responsable_legalDAO->findByMail($mail_resp_leg);

								//Si c'est bon on lance le processus de session
								session_start();
								
								// On stocke l'email et l'ID et on redirige l'utilisteur
								$_SESSION['mail_resp_leg'] = $mail_resp_leg ;
								$_SESSION['id_resp_leg'] = $responsable_legal->getId_resp_leg();
								
								header('Location: ../espace_responsable/espace_resp_leg.php');
								
								exit;
								
								//Si l'email et le mdp ne correspondent pas
							} else {
								//$responsable_legal->is_bug($mail_resp_leg, $mdp_resp_leg);
								$erreur = "<p align='center'><strong>Vous avez saisi un mauvais mot de passe ou email, veuillez réessayer svp.</strong></p>";
							}
							//Si tout n'est pas remplis --> erreur
						} else {    
							$erreur = "<p align='center'><strong>Vous n'avez pas saisis toutes les informations ! Veuillez remplir tous les champs svp.</strong></p>";
						}
					}

					// Formulaire
					include('../forms/RL_connexion_form.php') ;
					echo '<p align="center"><a href="../index.php" class="btn btn-info">Accueil</a> <a href="../register/register_resp_leg.php" class="btn btn-primary"> Inscirption</a></p>';
					?>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
	<div class="col-lg-2">
		<!-- -->
	</div>

	<!-- Message d'information en cas d'inscription réussie -->
	<div class="col-lg-8">
		<?php
		if (isset($_GET['inscrit']) ? $_GET['inscrit'] : NULL) {
			$mail = $_GET["mail"]; 
		?>

		<div class="alert alert-info">
			<a href="mailto:<?php echo $mail ; ?>" class="btn btn-xs btn-primary pull-right">Vérifier ma boîte mail</a>
			<strong>Un mail de validation a été envoyé à votre adresse : <a href="mailto:<?php echo $mail ; ?>"><?php echo $mail ; ?></a></strong>.<br />
			<strong>Pensez à consulter votre boîte mail afin de confirmer votre compte.</strong>
		</div>

		<?php
			} //On ferme l'accolade
		?>
	</div>

	<div class="col-lg-2">
		<!-- -->
	</div>

<?php 
include('../inc/script_niveau2.php') ; 
?>

</body>
</html>
