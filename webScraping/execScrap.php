<?php
include 'fonctionsScrap.php';

// scrapping total d'une page appelé par l'interface graphique et gestion des exceptions
var_dump($argv); //récupération d'un tableau d'arguments
$url = 'https://gw.geneanet.org/gstutz?n=le+conquerant&oc=&p=guillaume';
if(!empty($argv[1])) {
    $url = "";
    for ($i =1; $i<count($argv);$i++) {
$url = $url.$argv[$i];
    }
    $url = str_replace(' ', '', $url);
    echo "\nL'url : ".$url;
}
echo ("\n Full scrapping :\n");
try {
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