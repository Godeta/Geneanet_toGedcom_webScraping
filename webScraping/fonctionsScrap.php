<?php

include('advanced_html_dom.php');	

function scrapPrenom($html){
    $data=$html->find('#person-title > div > h1 > a:nth-child(2)','0');
    return $data ;
}

function scrapNom($html){
    $data=$html->find('#person-title > div > h1 > a:nth-child(3)','0');
    return $data ;
}