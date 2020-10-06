Dossier pour la partie web Scraping :

- geneanetScraping.php : programme principal qui permet de récupérer les données d'un profil Geneanet dont on donne l'url.
- dictionnaire.php : liste de constantes contenant les balises html nécessaires au web Scraping, inclues dans geneanetScraping.php
- resultat.ged : le fichier dans lequel on écrit les informations récupérées 
- simple_html_dom.php : la bibliothèque php inclue pour pouvoir scraper les données sur un site

Notes sur l'utilisation :

On lance geneanetScraping.php dans wamp ou sur un serveur pour l'executer sur un navigateur web
 (il faut que dictionnaire.php et simple_html_dom soient dans le même dossier pour que le programme fonctionne).