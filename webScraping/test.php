<?php
include 'fonctionsScrap.php';

//$html='https://gw.geneanet.org/scalpa49?n=lemoine&oc=&p=nicolas';
$url = 'https://gw.geneanet.org/micolon1?n=lemoine&oc=&p=paul+emile+prosper';
$html = file_get_html($url);

// test fonctions de scrapping individuelles
fopen('resultat.ged', 'w');
echo "\nNom : ";
$test = scrapNom($html);
echo $test;
echo "\nPrenom : ";
$test = scrapPrenom($html);
echo $test;
echo "\nSosa : ";
$test = scrapSosa($html);
echo $test;

echo "\nDates : ";
echo (scrapDates($html));
echo "\nDescription :";
echo (scrapDescrip($html));
echo "\nParents :";
echo (scrapParents($html));
//écriture d'un résultat de scraping
writeResult("Résultat du scrapping du nom : ",scrapPrenom($html));

// test de scrapping total d'une page
var_dump($argv); //récupération d'un tableau d'arguments
$url = 'https://gw.geneanet.org/gstutz?n=le+conquerant&oc=&p=guillaume';
if(!empty($argv[1])) {
$url = $argv[1];
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