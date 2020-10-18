<?php

include('advanced_html_dom.php');

//on met toutes les balises pour le web scraping comme constantes dans dictionnaire
include("dictionnaire.php");	

function scrapPrenom($html){
    $data=$html->find(PRENOM,'0')->innertext;
    return $data ;
}

function scrapNom($html){
    $data=$html->find(NOM,'0')->innertext;
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
        $union = $union."$uni->innertext </a> <br/>";
    }
    if(!empty($union)) {
        return $union;
    }
    return "Unions vides";
}

function scrapAll($html) {
    return "\nNom : ".
    scrapNom($html) ." Prenom :".
    scrapPrenom($html) . "\nParents : ".
    scrapParents($html). "\nDates : ".
    scrapDates($html). "\nDescription : ".
    scrapDescrip($html). "\nEvenements : ".
    scrapEvent($html) . "\nUnions : ". 
    scrapUnions($html) . "\nSosa : " .
    scrapSosa($html);
}
