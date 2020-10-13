<?php
include 'fonctionsScrap.php';

//$html='https://gw.geneanet.org/scalpa49?n=lemoine&oc=&p=nicolas';
$html = 'https://gw.geneanet.org/micolon1?n=lemoine&oc=&p=paul+emile+prosper';
$html = file_get_html($html);
$test = scrapNom($html);
echo $test;
echo "</br>";
$test = scrapPrenom($html);
echo $test;
echo "</br>";
$test = scrapSosa($html);
echo $test;
