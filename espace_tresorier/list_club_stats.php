<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

//On récupère le mail de l'adhérent (pour trouver ses details personnels)
if (isset($_SESSION['mail_tresorier'])) {
    $mail_tresorier = $_SESSION['mail_tresorier'];
  }else{
  header('Location: ../index.php?private=1');
  }
  $clubDAO = new ClubDAO();
  $clubs= $clubDAO->findAllClubs();
  



                            echo "<table class='table'>";
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Nom du Club</th>';
                            echo '</tr>';
                            
                            foreach ($clubs as $club) {
                            echo '<tr>';
                            echo '<td>'.$club->getId_club().'</td>';
                            echo '<td>'.$club->getLibelle_club().'</td>';
                            echo '<td><a href="statistiques.php?id_club='.$club->getId_club().'">Selectionner</a></td>';

                            echo '</tr>';
                            
                            }
                            echo '</table>';
                        
                    ?>