<?

/********************************************************************************/

/********************************* Fonctions ************************************/

/********************************************************************************/

function affich_annonce($champ) {    //a modifier - affiche un champ texte
	if (!empty($champ)) print("<marquee scrolldelay=\"150\" class=\"annonce\" width=\"99%\" align=\"center\">".(html_entity_decode(stripslashes(utf8_encode($champ))))."</marquee>\n");
}
function affich_avertissement($champ) {    //a modifier - affiche un champ texte
	if (!empty($champ)) print("<section class=\"avertissement\">
    <div>".(html_entity_decode(stripslashes(utf8_encode($champ))))."</div></section>\n");

}
function affich_texte($champ) {    //a modifier - affiche un champ texte
	print(html_entity_decode(stripslashes($champ)));
}

/******************************FIN Fonctions***************************/


/**********************************************/
/*************** PARAMETRES *******************/
/**********************************************/

foreach($_GET as $key => $value) {$$key = $value; /*echo "$key = $value <br>\n";*/} 
//foreach($_POST as $key => $value) $$key = $value;

if (isset($page)) {
	$fichier_champs="modif.$page.inc.php";                //a modifier
	$fichier_formulaire="modif_form_$page.htm"; 
	$redirection="modif.php?page=$page";
	$action_form="modif.php?page=$page";
}

else{

    $fichier_champs="modif.accueil.inc.php";                //a modifier
	$fichier_formulaire="modif_form_accueil.htm"; 
	$redirection="modif.php?page=accueil";
	$action_form="modif.php?page=accueil";

	}          //a modifier

//print($PHP_SELF);
                //ne pas modifier

include($fichier_champs);

/************** FIN PARAMETRES ****************/






/*************************************************/

/** Affichage des champs de texte dans la page  **/

/*************************************************/

 if (isset($affich)) { 
 	affich_texte($$affich);
	exit;
}

 if (isset($annonce)) { 
 	affich_annonce($$annonce);
	exit;
}                                                   
if (isset($avertissement)) { 
	affich_avertissement($$avertissement);
   exit;
} 


/*****************************************************************************************/

/************************* Ecriture du nouveau fichier $fichier_champs ********************/

/******************************************************************************************/

foreach($_POST as $key => $value) $$key = $value;
//foreach($_POST as $key => $value) { print($key); print(" = ".$value."<br>"); };
if (isset($button) && $button=="modifier") {
	// sauvegarde des donnees precedentes
	include($fichier_champs);
	//chmod( $fichier_champs, 0777 );
	$fd=fopen($fichier_champs,"w") or die ("Impossible d'ouvrir \"$fichier_champs\"");
	$chaine="<?\n/* Ce fichier contient les parametres de la page a afficher */\n\n";
	$fout=fwrite($fd,$chaine);
	//remplacement des caracteres <,>,& et " par les codes html correspondants*/
	$compteur=1;      //ATTENTION SEULEMENT 10 champs possibles (à modifier ci-dessous)
	$field_new="champ_".$compteur."_new";
	while ($compteur<=12) {
		$$field_new = htmlentities(trim($$field_new));
		$field_new="champ_".++$compteur."_new";
		}
		$chaine="/*************************/\n";
		$chaine.="/* champs pour affichage */\n";
		$chaine.="/*************************/\n\n";
		$fout=fwrite($fd,$chaine);
		$compteur=1;
		$field="champ_".$compteur;
		$field_new="champ_".$compteur."_new";
		while (isset($$field_new)) {
		$chaine="$"."$field=\"".$$field_new."\";\n\n";
		$chaine=str_replace("\r","",$chaine);
		$fout=fwrite($fd,$chaine);
		++$compteur;
		$field="champ_".$compteur;
		$field_new="champ_".$compteur."_new";
		}
		$chaine="?>\n";
		$fout=fwrite($fd,$chaine);
		fclose($fd);
		unset($from);
		unset($button);
		sleep(3);
		//include($fichier_champs);
		header("Location:$redirection"); 
		exit;
}






/********************************************************************************************/

/************************** Affichage du haut de page et Titre ******************************/

/********************************************************************************************/

	

	include($fichier_formulaire);

?>