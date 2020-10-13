<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<!-- Pour accéder à cette page, localhost + nom du fichier (on peut ajouter des virtualhost dans wamp)-->
<!-- pour utiliser goutte ajouter " composer require fabpot/goutte " dans le fichier composer.json -->

<p>
        <h1> <b> Geneanet web scraping : </b> </h1>
    </p>
    <!-- Formulaire pour choisir l'url -->
    <form id="monFormulaire" name="monFormulaire" action= "<?php $_SERVER['PHP_SELF'] ?>" method="post"
		enctype="application/x-www-form-urlencoded">
		<fieldset>
			<legend>Informations transmises</legend>
			<label for="url">Url : </label><input type="text" id="url" name="url" placeholder= "Entrez l'url">
            <br />
		<input type="submit" name="BtSub" value="Envoyer"> 
		<br /> <br/>
        </fieldset>
    </form>
    <fieldset>
			<legend>Profil :</legend>
    <?php
    //on met toutes les balises pour le web scraping comme constantes dans dictionnaire
    include("dictionnaire.php");

    function webScrapProfile($url) {
        $html = file_get_html($url);

        // Titre
    $title = $html->find('title', '0'); //find title retourne un array, 0 pour préciser qu'on ne prend que la première case
    echo "<b>Titre du site : </b>" . $title->innertext . '<br/>';

    // Description
    $text = $html->find(DESCRIPTION, '0');
    if(!empty($text)){
    echo '<b>Description : </b>' . $text->outertext . '<br/><br/>';
    }
	
	// Date naissance, mort...
	echo '<b>Dates importantes :</b><br/>' ;
    foreach ($html->find(DATES) as $d) {
        echo "$d->innertext </a> <br/>";
    }
	$par1 ="";
	// Parents --> Fonctionne pas	
    echo '<br/><b>Parents :</b><br/>' ;
        $par = $html->find(FAMILLE_TEXTE, '0');
        $par2 = $html->find(FAMILLE_TEXTE, '1');
        echo "$par->innertext </a> <br/> $par2->innertext </a> <br/>";
        $par1 = "\n - " . $par->innertext . "\n - " . $par2->innertext ;

	// Enfants
	echo '<br/><b>Enfant(s) :</b><br/>' ;
    foreach ($html->find(ENFANTS) as $enf) {
		//$link = '"https://gw.geneanet.org/'.$enf->href.'"' ;
        //echo "<a href=$link>";
        echo "$enf->innertext </a> <br/>";
    }	
	
	// Unions
	echo '<br/><b>Union(s) :</b><br/>' ;
    foreach ($html->find(UNIONS) as $uni) {
        echo "$uni->innertext </a> <br/>";
    }
	
	// Frères et soeurs
	echo '<br/><b>Frère(s) et soeur(s) :</b><br/>' ;
    foreach ($html->find(FRATRIE) as $fs) {
        echo "$fs->innertext </a> <br/>";
    }
	
	// Evenements
	echo '<br/><b>Evènement(s) :</b><br/>' ;
    foreach ($html->find(EVENEMENTS) as $even) {
        echo "$even->innertext </a> <br/>";
    }
	
	//Grands-parents maternels
	echo '<br/><b>Grands-parents maternels :</b><br/>' ;
    foreach ($html->find(G_PARENTS_M) as $gpm) {
        echo "$gpm->innertext </a> <br/>";
    }
	
	//Grand-parents paternels
	echo '<br/><b>Grands-parents paternels :</b><br/>' ;
    foreach ($html->find(G_PARENTS_P) as $gpp) {
        echo "$gpp->innertext </a> <br/>";
    }
	
	//Oncles&Tantes maternels
	echo '<br/><b>Oncles et Tantes maternels :</b><br/>' ;
    foreach ($html->find(ONCLES_TANTES_M) as $otm) {
        echo "$otm->innertext </a> <br/>";
    }
    $otp1 = "";
	//Oncles&Tantes paternels
	echo '<br/><b>Oncles et Tantes paternels :</b><br/>' ;
    foreach ($html->find(ONCLES_TANTES_P) as $otp) {
        echo "$otp->innertext </a> <br/>";
        $otp1 = $otp1 . "\n - " . $otp->innertext ;
    }

      // partie écritures infos dans un fichier
    // 1 : on ouvre le fichier
    $monfichier = fopen('resultat.ged', 'w');
    fseek($monfichier, 0); // On remet le curseur au début du fichier
    $resulttext = "Résultat du web scraping : \n Le titre du profil : $title->innertext \n Les parents : $par1 \n Les oncles et tantes paternels : $otp1";
    fputs($monfichier, $resulttext); // On écrit notre texte dans le fichier
    $monfichier = fopen('resultat.ged', 'r');
    $first_line = "<br/>".fgets($monfichier) ."<br/>".fgets($monfichier)."<br/>".fgets($monfichier).fgets($monfichier); // On lit les 4 premières lignes (nombre de pages vues)
    // On récupère et affiche les 4 premières lignes du fichier
    echo "Il existe à présent un fichier <b>resultat.ged</b> dans votre dossier, les 4 premières lignes sont :<b> $first_line  </b><br/>"; 
    
    fclose($monfichier);
    }

    //si on a envoyé une url
    if ( !empty($_POST["url"]) )
    {
        echo "Récupération  des infos grâce à l'url <br />";
        $url = $_POST['url'];  
        echo "url transmise : <a href=\"$url\">$url</a> <br/> <br/>";
		
    // inclu la bibliothèque/le fichier php
    include('advanced_html_dom.php');
	
	//on prend le temps actuel
    $t=time();

    webScrapProfile($url);
    
	 //soustraction et affichage du temps
    $t2=time();
    echo("<br> <b>Temps pour effectuer la requête : </b><br>" );
    echo ($t2-$t . " secondes <br>");

    
    //décoration, fin du profil que l'on a affiché
    echo "</fieldset> <br/> <br/> ";

    //test napoleon
    echo "<fieldset>
    <legend>Exemple avec Napoleon</legend>";
    echo "<h2> Page napoleon : </h2>";
    // récupère le code html de la page donnée en url
    $url = 'https://gw.geneanet.org/szcandre?n=bonaparte&oc=&p=napoleon';
    //récupération des infos
    webScrapProfile($url);
    echo "</fieldset>";
		
	// test Guillaume
	echo "<fieldset>
    <legend>Test Guillaume (page complète)</legend>";
    echo "<h2> Page Guillaume : </h2>";
    // récupère le code html de la page donnée en url
	$url = 'https://gw.geneanet.org/gstutz?n=le+conquerant&oc=&p=guillaume';
    webScrapProfile($url);
	echo "</fieldset>";
	/*// Image profil --> Ne fonctionne pas
	echo '<b>Image du profil :</b>';
	$photo = $html->find('img principal');
	echo $photo->innertext;*/

    /* possibilitées
    // trouve tous les liens
    foreach ($html->find('a') as $e)
        echo $e->href . '<br>';

    // trouve toutes les images
    foreach ($html->find('img') as $e)
        echo $e->src . '<br>';

    // find all image with full tag
    foreach ($html->find('img') as $e)
        echo $e->outertext . '<br>';

    // trouve tous les div avec id=gbar
    foreach ($html->find('div#gbar') as $e)
        echo $e->innertext . '<br>';

    // trouve tous les span avec class=gb1
    foreach ($html->find('span.gb1') as $e)
        echo $e->outertext . '<br>';

    // trouve tous les tags td avec align=center
    foreach ($html->find('td[align=center]') as $e)
        echo $e->innertext . '<br>';

    // extrait le texte de la page
    echo $html->plaintext;
	*/
    }	
	
    ?>

</body>

</html>