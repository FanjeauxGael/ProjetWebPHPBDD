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
				<div class="panel-heading">Connexion Adhérent Majeur</div>
				<div class="panel-body">
					<?php
					// Détermine si on a cliqué sur le bouton submit
					$submit = isset($_POST['submit']);
					$erreur = "";

					// Formulaire soumi
					if ($submit) {
						
						// Toutes les données sont saisies
						if (!empty($_POST['mail_inscrit']) and !empty($_POST['mdp_inscrit'])) {
							
							// Récupère les données du formulaire
							$mail_inscrit = isset($_POST['mail_inscrit']) ? $_POST['mail_inscrit'] : '';
							$mdp_inscrit = isset($_POST['mdp_inscrit']) ? $_POST['mdp_inscrit'] : '';

							//-- On instencie le DAO de Adhérent --//
							$adherent = new AdherentDAO;

							//On vérifie que le mail et mdp soient correct
							if ($adherent->est_inscrit($mail_inscrit, $mdp_inscrit)) {
								
								// Si le mail corresmond avec le mot de passe, on récupère les infos à stocker en session

								//Si c'est bon on lance le processus de session
								session_start();
								
								// On stocke l'email et on redirige l'utilisteur
								$_SESSION['mail_inscrit'] = $mail_inscrit;

								header('Location: ../espace_majeur/espace_adh.php');
								exit;
								
								//Si l'email et le mdp ne correspondent pas
							} else {
								$erreur = "<p align='center'><strong>Vous avez saisi un mauvais mot de passe ou email, veuillez réessayer svp.</strong></p>";
							}
							//Si tout n'est pas remplis --> erreur
						} else {    
							$erreur = "<p align='center'><strong>Vous n'avez pas saisis toutes les informations ! Veuillez remplir tous les champs svp.</strong></p>";
						}
					}

					// Formulaire
					include('../forms/ADH_Connexion_Form.php') ;
					echo '<p align="center"><a href="../index.php" class="btn btn-info">Accueil</a> <a href="../register/register_adh.php" class="btn btn-primary"> Inscirption</a></p>';
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
