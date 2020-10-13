<?php
include 'fonctionsScrap.php';

$html='https://gw.geneanet.org/gbernard6?n=goduet&oc=&p=marie';
$html=file_get_html($html);
$test=scrapNom($html);
echo $test->innertext;
echo "</br>";
$test=scrapPrenom($html);
echo $test->innertext;