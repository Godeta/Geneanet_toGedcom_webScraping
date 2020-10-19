<?php
include 'fonctionsScrap.php';

function recupURL(){
    $monfichier = fopen('../url.txt', 'r');
    $first_line = fgets($monfichier); 
    return $first_line ;
}

// scrapping total d'une page appelé par l'interface graphique et gestion des exceptions
var_dump($argv); //récupération d'un tableau d'arguments
$url = recupURL();
$choice = "";
if(!empty($argv[1])) {
$choice = $argv[1];
}
if(empty($url)) {
    $url = 'https://gw.geneanet.org/gstutz?n=le+conquerant&oc=&p=guillaume';
}
echo ("\n Full scrapping :\n");
try {
echo ("\n L'URL : ".$url);
$html = @file_get_html($url);
}
catch (Exception $e) {
    $html = "error";
    // ajout d'un lancé d'exception dans advanced html dom
    // echo ("Exception attrapée !");
}
if ($html != "error") {
//récupère toutes les données de la page
echo(scrapAll($html)); 
//récupère et écrit toutes les données de la page dans resultat.ged 
writeAllResult($html);
}
// execution en ligne de commande : php arg1 + nom du fichier