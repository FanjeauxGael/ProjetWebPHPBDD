<?php
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';


$notefraisDAO = new NotefraisDAO;
$notefrais = $notefraisDAO->findAll();
$id_note_frais = $_GET['id_note_frais'];

session_start();
$mail_tresorier = $_SESSION['mail_tresorier'];
$tresorierDAO = new TresorierDAO();
$tresorier= $tresorierDAO->findByMail($mail_tresorier);


$nb = $tresorierDAO->unvalidate($id_note_frais);





header ('Location: list_bordereau_tresorier.php');
exit;
?>