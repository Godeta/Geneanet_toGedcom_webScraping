<?php

include('advanced_html_dom.php');

//on met toutes les balises pour le web scraping comme constantes dans dictionnaire
include("dictionnaire.php");	

function scrapTitle($html){
    $title = $html->find('title', '0'); //trouve le titre retourne un array, 0 pour préciser qu'on ne prend que la première case
    return $title->innertext ;
}

function scrapPrenom($html){
    $data=$html->find(PRENOM,'0');
    if(!empty($data)){
        return $data->innertext;
    }
    else {
        $prenom = explode(" ", scrapTitle($html));
        return $prenom[1];
    }
    return $data ;
}

function scrapNom($html){
    $data=$html->find(NOM,'0');
    if(!empty($data)){
        return $data->innertext;
    }
    else {
        $nom = explode(" ", scrapTitle($html));
        return $nom[0];
    }
    return $data ;
}

function scrapSosa($html){
    $data=$html->find('.sosa > a','0');
    if(!empty($data)){
        return $data->innertext;
    }
    return " Sosa vide";
}

function scrapDescrip($html) {
    $text = $html->find(DESCRIPTION, '0');
    if(!empty($text)){
    return $text->outertext;
    }
    return " Description vide";
}

function scrapDates($html) {
    $all = "";
    // Date naissance, mort...
    foreach ($html->find(DATES) as $d) {
        $all = $all."$d->outertext \n";
    }
    if(!empty($all)) {
        return $all;
    }
    return " Dates vides";
}

function scrapParents($html) {
        $par = $html->find(FAMILLE_TEXTE, '0');
        $par2 = $html->find(FAMILLE_TEXTE, '1');
        $par1 = "\n - " . $par->innertext . "\n - " . $par2->innertext ;
    return $par1;
}

function scrapEvent($html) {
    $event ="";
    foreach ($html->find(EVENEMENTS) as $even) {
        $event = $event."$even->outertext";
    }
    if(!empty($event)) {
        return $event;
    }
    return "Evenements vides";
}

function scrapUnions($html) {
    $union = "";
    foreach ($html->find(UNIONS) as $uni) {
        $union = $union."$uni->innertext \n";
    }
    if(!empty($union)) {
        return $union;
    }
    return "Unions vides";
}

function scrapAll($html) {
    return "\nNom : ".
    scrapNom($html) ." Prenom : ".
    scrapPrenom($html) . "\nParents : ".
    scrapParents($html). "\nDates : ".
    scrapDates($html). "\nDescription : ".
    scrapDescrip($html). "\nEvenements : ".
    scrapEvent($html) . "\nUnions : ". 
    scrapUnions($html) . "\nSosa : " .
    scrapSosa($html);
}

function scrapLienPere($html) {

}

function scrapLienMere($html) {
    
}

function writeResult ($intro,$content) {
     // partie écritures infos dans un fichier
    // 1 : on ouvre le fichier en mode append
    $monfichier = fopen('resultat.ged', 'a');
    fseek($monfichier, 0); // On remet le curseur au début du fichier
    $resulttext = "$intro $content";
    fputs($monfichier, $resulttext); // On écrit notre texte dans le fichier
    $monfichier = fopen('resultat.ged', 'r');
    $first_line = "\n".fgets($monfichier) ."\n".fgets($monfichier)."\n".fgets($monfichier).fgets($monfichier); // On lit les 4 premières lignes (nombre de pages vues)
    // On récupère et affiche les 4 premières lignes du fichier
    echo "\nIl existe à présent un fichier 'resultat.ged' dans votre dossier, les 4 premières lignes sont :
     $first_line"; 
    
    fclose($monfichier);
}

function writeAllResult ($html) {
    //on efface le contenu du fichier
    fopen('resultat.ged', 'w');
    writeResult("Résultats du webscrapping de ".scrapTitle($html)." \n",scrapAll($html));
}