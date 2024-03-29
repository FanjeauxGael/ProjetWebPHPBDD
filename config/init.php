<?php
//
// Initialisations dans chaque page
//

/**
 * Paramétrage pour certains serveurs qui n'affichent pas les erreurs PHP par défaut
 */
ini_set('display_errors', '1');
ini_set('html_errors', '1');

/**
 * Autoload
 * @param string $classe
 */
function my_autoloader($classe) {
  include '../classes/' . $classe . '.php';
}

spl_autoload_register('my_autoloader');

/**
 * Vide le cache du navigateur
 */
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

/**
 * Titre du site
 */
define('APPLINAME','fredi');

/**
 * Paramètre de la base de données
 */
 define('DB_USER','root');
 define('DB_PASSWORD','');
 define('DB_HOST','localhost');
 define('DB_NAME','fredi');

 //Fonction permettant de rediriger plus facilement en cas d'erreur (a la place d'un header)
 function rediriger($url){
   die('<meta http-equiv="refresh" content="0;URL='.$url.'">');
 }