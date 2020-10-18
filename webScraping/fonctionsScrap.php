<?php

include('advanced_html_dom.php');	

function scrapPrenom($html){
    $data=$html->find('#person-title > div > h1 > a:nth-child(2)','0')->innertext;
    return $data ;
}

function scrapNom($html){
    $data=$html->find('#person-title > div > h1 > a:nth-child(3)','0')->innertext;
    return $data ;
}

function scrapSosa($html){
    $data=$html->find('.sosa > a','0');
    if(!empty($data)){
        return $data->innertext;
    }
    else{
        return $data;
    }
    return $data;
}
