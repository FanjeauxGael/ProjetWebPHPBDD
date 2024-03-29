<?php
// Demarrage session
session_start();

require('../pdf/fpdf/fpdf.php');

// Configuration des classes / DAO / BDD
include '../config/init.php';

include "../fco.php";

//On récupère l'email et l'ID du responsable legal stocké en session, si il n'y est pas, on a pas accès à la page
if (isset($_SESSION['mail_resp_leg'])) {
  $mail_resp_leg = $_SESSION['mail_resp_leg'];
  $id_resp_leg = $_SESSION['id_resp_leg'];
}else{
header('Location: ../index.php?private=1');
}

$id_resp_leg=isset($_GET['id_resp_leg']) ? $_GET['id_resp_leg'] : '?';
$annee = isset($_GET['annee']) ? $_GET['annee'] : '?';

// On récupère les infos du reponsable par son email dans $responsable_legal (tableau objet) ainsi que les licenciés qui lui sont rattachés
$responsable_legalDAO = new Responsable_legalDAO();
// Info responsable
$responsable_legal= $responsable_legalDAO->findByMail($mail_resp_leg);
// Info Adhérents mineurs
$mineurs = $responsable_legalDAO->findAllMineurs($id_resp_leg);



$dsn = 'mysql:host=localhost;dbname=fredi';
$user = "root";
$pass = '';
$con = db_connect($dsn, $user, $pass);

$sql = "SELECT NF.annee, A.licence_adh, A.nom_adh, A.prenom_adh, A.adresse_adh, A.cp_adh, A.ville_adh,
LF.trajet_frais, LF.cout_peage, LF.cout_repas, LF.cout_hebergement, LF.date_frais, LF.km_parcourus,
I.tarif_kilometrique,
(I.tarif_kilometrique * km_parcourus) AS 'prix_km',
M.libelle_motif,
(I.tarif_kilometrique * km_parcourus + cout_peage + cout_repas + cout_hebergement) AS 'prix_total'
FROM
  adherent A,
  responsable_legal RL,
  note_frais NF,
  ligne_frais LF,
  motif M,
  indemnite I
WHERE RL.id_resp_leg = A.id_resp_leg
  AND A.licence_adh = NF.licence_adh
  AND LF.id_motif = M.id_motif
  AND NF.annee = I.annee
  AND NF.id_note_frais = LF.id_note_frais
  AND RL.id_resp_leg = $id_resp_leg
  AND NF.annee = $annee";
          
  try {
    $sth = $con->prepare($sql);
    $sth->execute();
    $formulaires = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    die("<p>Erreur lors de la requete SQL : " . $ex->getMessage() . "</p>");
  }


  class MON_PDF extends FPDF {

    function Header() {

      // Police Arial gras 15
      $this->SetFont('Arial','B',15);

      // Titre
      $this->Cell(0,10,'Tableau','B',0,'C');

      // Saut de ligne
      $this->Ln(20);
    }
  
    function Footer() {

      // Positionnement a 1 cm du bas
      $this->SetY(-10);

      // Police Arial italique 8
      $this->SetFont('Arial','I',8);
      $this->SetTextColor(0,0,0); // Noir

      // Numero de page
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}','T',0,'C');
    }
}

  $pdf = new MON_PDF();
  $pdf = new FPDF();
  
  foreach ($formulaires as $formulaire) {
    $licence = $formulaire['licence_adh'];
    $annee = $formulaire['annee'];
    $nom_adh = $formulaire['nom_adh'];
    $prenom_adh = $formulaire ['prenom_adh']; 
    $adresse_adh = $formulaire['adresse_adh'];
    $cp_adh = $formulaire['cp_adh'];
    $ville_adh = $formulaire['ville_adh'];    
    $frais_km = $formulaire['tarif_kilometrique'];
  }

  $pdf->AddPage();
  $pdf->SetFillColor(165, 212, 139);
  $pdf->Image("../pdf/img/image1.jpg", 5, 5, 0, 20);
  $pdf->SetY(35);
  $pdf->SetFont('Helvetica','B',16);
  $pdf->Cell(0,10,"Notes de frais des benevoles",0,0,'L');
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetX(140);
  $pdf->Cell(0,10,"Annee civile ". utf8_decode($annee),0,1,"C",1 );
  $pdf->SetY(50);
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(0,7,"Je soussigne(e)",0,1);
  $pdf->Cell(0,7,utf8_decode($responsable_legal->getPrenom_resp_leg())." ". utf8_decode($responsable_legal->getNom_resp_leg()),0,1, "C", 1);
  $pdf->Cell(0,7,"demeurant",0,1);
  $pdf->Cell(0,7,utf8_decode($responsable_legal->getRue_resp_leg())." ".utf8_decode($responsable_legal->getCp_resp_leg())." ".utf8_decode($responsable_legal->getVille_resp_leg()),0,1, "C", 1);
  $pdf->Cell(0,7,"certifie renoncer au remboursement des frais ci-dessous et les laisser a l association",0,1);
  $pdf->Cell(0,7,"Salle d Armes de Villers les Nancy, 1 rue Rodin - 54600 Villers les Nancy	",0,1, "C",1);
  $pdf->Cell(0,7,"en tant que don.",0,1);
  $pdf->Cell(70,7,"Frais de deplacement",0,0);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(0,7,"Tarif kilometrique applique pour le remboursement : ".utf8_decode($frais_km)." euros/km",0,1);

  // Entête de la liste
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(25, 10, "Date", 'B', 0, 'C');
  $pdf->Cell(30, 10, "Motif", 'B', 0, 'C');
  $pdf->Cell(20, 10, "Trajet", 'B', 0, 'C');
  $pdf->Cell(20, 10, "Kms", 'B', 0, 'C');
  $pdf->Cell(20, 10, "Cout Trajet", 'B', 0, 'C');
  $pdf->Cell(20, 10, "Peages", 'B', 0, 'C');
  $pdf->Cell(20, 10, "Repas", 'B', 0, 'C');
  $pdf->Cell(20, 10, "Hebergement", 'B', 0, 'C');
  $pdf->Cell(20, 10, "Total", 'B', 1, 'C');
  
  $montant_total = 0;
  foreach ($formulaires as $formulaire) {
    $trajet_frais = $formulaire['trajet_frais'];
    $date_frais = $formulaire['date_frais'];
    $km_parcourus = $formulaire['km_parcourus'];
    $prix_km = $formulaire['prix_km'];
    $cout_peage = $formulaire['cout_peage'];
    $cout_repas = $formulaire['cout_repas'];
    $cout_hebergement = $formulaire['cout_hebergement'];
    $libelle_motif = $formulaire['libelle_motif'];
    $prix_total = $formulaire['prix_total'];
    $montant_total= $montant_total + $prix_total;
    
    // Liste
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(25, 10, utf8_decode($date_frais),1, 0, 'C',1);
  $pdf->Cell(30, 10, utf8_decode($libelle_motif), 1, 0, 'C',1);
  $pdf->Cell(20, 10, utf8_decode($trajet_frais), 1, 0, 'C',1);
  $pdf->Cell(20, 10, utf8_decode($km_parcourus), 1, 0, 'C',1);
  $pdf->Cell(20, 10, utf8_decode($prix_km), 1, 0, 'C',1);
  $pdf->Cell(20, 10, utf8_decode($cout_peage), 1, 0, 'C',1);
  $pdf->Cell(20, 10, utf8_decode($cout_repas), 1, 0, 'C',1);
  $pdf->Cell(20, 10, utf8_decode($cout_hebergement), 1, 0, 'C',1);
  $pdf->Cell(20, 10, utf8_decode($prix_total), 1, 1, 'C',1);
  }
  
  $pdf->Cell(175, 10, "Montant des frais de deplacement", 1, 0, 'C');
  $pdf->Cell(20, 10, utf8_decode($montant_total), 1, 1, 'C',1);
  $pdf->Cell(0,7,"Je suis le représentant des adhérents suivants :",0,1);

  foreach($mineurs as $mineur){
    $pdf->Cell(0,7,utf8_decode($mineur->getprenom_adh())." ". utf8_decode($mineur->getnom_adh()).", licence numero ".utf8_decode($mineur->getlicence_adh()),0,1, "C", 1);
  }
  
  $pdf->Cell(50, 10, "Montant total des dons : ", 0, 0, 'L');
  $pdf->Cell(20, 10, utf8_decode($montant_total)." euros", 0, 1, 'C');
  $pdf->SetFont('Helvetica','I',10);
  $pdf->Cell(0, 10, "Pour beneficier du recu de dons, cette note de frais doit etre accompagnee de tous les justificatifs correspondants", 0, 1, 'C');
  
  $pdf->Cell(20, 15, " ", 0, 1, 'C');
  $pdf->SetFont('Helvetica','',10);
  $pdf->SetX(70);
  $pdf->Cell(20, 10, "A", 0, 0, 'C');
  $pdf->Cell(45, 10, "", 0, 0, 'C',1);
  $pdf->Cell(20, 10, "Le", 0, 0, 'C');
  $pdf->Cell(45, 10, "", 0, 1, 'C',1);
  $pdf->SetX(70);
  $pdf->Cell(20, 5, " ", 0, 1, 'C');
  $pdf->SetX(70);
  $pdf->Cell(60, 15, "Signature du benevole", 0, 0, 'C');
  $pdf->Cell(70, 15, "", 0, 1, 'C',1);
  $pdf->Cell(20, 5, " ", 0, 1, 'C');
  $pdf->SetFillColor(255, 179, 179);
  $pdf->SetFont('Helvetica','B',10);
  $pdf->Cell(100, 10, "Partie reservee a l association", 0, 1, 'C',1);
  $pdf->SetFont('Helvetica','',10);
  $pdf->Cell(100, 10, "Numero d ordre du Recu : 2009-007", 0, 1, 'L',1);
  $pdf->Cell(100, 10, "Remis le :	", 0, 1, 'L',1);
  $pdf->Cell(100, 10, "Signature du Tresorier :", 0, 1, 'L',1);
  $pdf->Output('projet.pdf','d');