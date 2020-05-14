<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

// Restriction liée à la page
include '../inc/user_restriction.php';

// On prépare les methodes DAO de la calsse Responsable Legal
$responsable_legalDAO = new Responsable_legalDAO;
$responsables_legal = $responsable_legalDAO->findAll();
?>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Inscription Responsable</div>
				<div class="panel-body">

                    <?php
                    // Détermine si on a cliqué sur le bouton submit
                    $submit = isset($_POST['submit']);
                    $erreur = "";

                    // Formulaire soumi
                    if ($submit) {
                        if (!empty($_POST['nom_resp_leg']) AND ! empty($_POST['prenom_resp_leg']) AND ! empty($_POST['rue_resp_leg']) AND ! empty($_POST['cp_resp_leg']) AND ! empty($_POST['ville_resp_leg']) AND ! empty($_POST['mail_resp_leg']) AND ! empty($_POST['mdp_resp_leg'])) { 
                        
                        // Récupère les données du formulaire
                        $nom_resp_leg = isset($_POST['nom_resp_leg']) ? $_POST['nom_resp_leg'] : '';
                        $prenom_resp_leg = isset($_POST['prenom_resp_leg']) ? $_POST['prenom_resp_leg'] : '';
                        $rue_resp_leg = isset($_POST['rue_resp_leg']) ? $_POST['rue_resp_leg'] : '';
                        $cp_resp_leg = isset($_POST['cp_resp_leg']) ? $_POST['cp_resp_leg'] : '';
                        $ville_resp_leg = isset($_POST['ville_resp_leg']) ? $_POST['ville_resp_leg'] : '';
                        $mail_resp_leg = isset($_POST['mail_resp_leg']) ? $_POST['mail_resp_leg'] : '';
                        $mdp_resp_leg = isset($_POST['mdp_resp_leg']) ? $_POST['mdp_resp_leg'] : '';
                        
                        //-- On hache le mdp donné pour l'insérer dans la BDD --//
                        $mdp_hash = password_hash($mdp_resp_leg, PASSWORD_BCRYPT);

                        $responsable_legal = new Responsable_legal(array(
                            'nom_resp_leg'=>$nom_resp_leg,
                            'prenom_resp_leg'=>$prenom_resp_leg,
                            'rue_resp_leg'=>$rue_resp_leg,
                            'cp_resp_leg'=>$cp_resp_leg,
                            'ville_resp_leg'=>$ville_resp_leg,
                            'mail_resp_leg'=>$mail_resp_leg,
                            'mdp_resp_leg'=>$mdp_hash
                        ));

                        // Ajoute l'enregistrement dans la BDD
                        $nb = $responsable_legalDAO->insert($responsable_legal);
                        
                        // Redirection
                        header('Location: ../login/connexion_resp_leg.php?inscrit=1&mail='.$mail_resp_leg.'');

                        // Obligatoire sinon PHP continue à exécuter le script
                        exit;

                    // Si tout n'est pas remplis > erreur
                    } else {    
                        $erreur = "<p align='center'><strong>Vous n'avez pas saisis toutes les informations ! Veuillez remplir tous les champs svp.</strong></p>";
                    }
                    }

                    // Ajout du formulaire
                    include('../forms/RL_inscription_form.php') ; 
                    echo '<p align="center"><a href="../index.php" class="btn btn-info">Accueil</a> <a href="../login/connexion_resp_leg.php" class="btn btn-primary"> Connexion</a></p>';
					?>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
<?php 
include('../inc/script_niveau2.php') ; 
?>

</body>
</html>
