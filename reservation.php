<? 

function affich_annonce($champ) {    //a modifier - affiche un champ texte
	if (!empty($champ)) { 
          print("<br />");
		print("<table width=\"500\" border=\"0\" cellpadding=\"4\" cellspacing=\"0\"  align=\"center\" class=\"annonce\">");
          print("<tr>");
            print("<td align=\"center\">".stripslashes(nl2br($champ))."</td>");
          print("</tr>");
        print("</table>");
		}
}
function affich_texte($champ) {    //a modifier - affiche un champ texte
	print(stripslashes(nl2br($champ)));
}
function checkEmail($email)
/*
- le motif commence par une lettre ou un chiffre
- ensuite il peut y avoir 0,1 ou plusieurs caract&egrave;res alphanum&eacute;riques, point,
  tiret ou soulignement
- un alphanum&eacute;rique
- un arobase (@)
- un alphanum&eacute;rique
- ensuite il peut y avoir 0,1 ou plusieurs caract&egrave;res alphanum&eacute;riques, point,
  tiret ou soulignement
- un point (.)
- le motif fini par au moins deux lettres
- il ne peut pas y avoir 2 points contigus
*/
{
    $motif1  = "^[[:alnum:]]([[:alnum:]\._-]{0,})[[:alnum:]]";
    $motif1 .= "@";
    $motif1 .= "[[:alnum:]]([[:alnum:]\._-]{0,})[\.]{1}([[:alpha:]]{2,})$";

    $motif2 = "[\.]{2,}";

    return (mb_ereg($motif1, $email) && !mb_ereg($motif2, $email));
}

//parametres
//include("modif.inc.php");
$email_destinataire="amandari-chambredhote@wanadoo.fr";

foreach($_GET as $key => $value) $$key = $value;
foreach($_POST as $key => $value) $$key = $value;
if (isset($button) && ($button=="envoyer" || $button=="send")) {
	$langage="fr";
	if ($button=="send") $langage="en";
	//Mise en forme des variables
	$email=trim($email);
	$message=stripslashes($message);
	
	//corps du message
	$corps="Email : $email\r\n\r\n";
	if ($langage=="en") $corps.="Langue : anglais\r\n\r\n";
	if (!empty($message)) $corps.="Message :\r\n $message\r\n\r\n";
	if (!empty($nom_prenom)) $corps.="Nom Prenom : $nom_prenom\r\n";
	if (!empty($adresse)) $corps.="Adresse : $adresse\r\n";
	if (!empty($codepostal)) $corps.="Code postal : $codepostal\r\n";
	if (!empty($ville)) $corps.="Ville : $ville\r\n";
	if (!empty($pays)) $corps.="Pays : $pays\r\n";
	if (!empty($telephone)) $corps.="Telephone : $telephone\r\n";
	if (!empty($fax)) $corps.="mobile : $fax\r\n";
	if (!empty($date)) $corps.="Date d'Arrivée : $date\r\n";
	if (!empty($gites)) $corps.="Gîtes : $gites\r\n";
	if (!empty($chambresdhotes)) $corps.="Chambres d'hôtes : $chambresdhotes\r\n";
	if (!empty($nuits)) $corps.="nombre de nuits : $nuits\r\n";
	if (!empty($personnes)) $corps.="Nombre de personnes : $personnes\r\n\r\n";
	if (!empty($adultes)) $corps.="Nombre d'adultes : $adultes\r\n\r\n";
	if (!empty($enfants)) $corps.="Nombre d'enfants : $enfants\r\n\r\n";
	if (!empty($age_enfants)) $corps.="Age des enfants : $age_enfants\r\n\r\n";
	
	//Vérifications
	$msg=""; $txt="";
	if (empty($email))
		if ($langage=="en") $msg.="Your e-mail is mandatory.<br>";
		else $msg.="Votre e-mail est obligatoire.<br>";
	else if (!(checkEmail($email)))
	   if ($langage=="en") $msg.="The spelling of your e-mail is not correct, please check and correct it.<br>";
	   else $msg.="L'orthographe de votre e-mail est incorrecte, merci de la corriger.<br>";
	if (empty($telephone))
	   if ($langage=="en") $msg.="Please indicate your telephone number.<br>";
	   else $msg.="Merci d'indiquer votre numéro de telephone<br>";
	if (empty($nom_prenom))
	   if ($langage=="en") $msg.="Please indicate your Name.<br>";
	   else $msg.="Merci d'indiquer votre nom<br>";
	if(mb_eregi("(\r|\n)",$email) || mb_eregi("(cc:|bcc:|from:)",$message))
		if ($langage=="en") $msg.="Message not send :  Spam attempt ?...";
		else $msg.="Message non envoyé:  Tentative de Spam ?...";
	if(mb_eregi("(http://)",$corps))
		if ($langage=="en") $msg.="Message not send :  URL are not allowed in message";
		else $msg.="Message non envoyé:  les URL ne sont pas autorisées dans les messages.";
	
	//renvoi
	if (empty($msg)) {
		//$en_tete_supp="From: \"$email\"<$email>\r\n";
		$en_tete_supp="Reply-To: $email\r\n";
		$en_tete_supp.="MIME-Version: 1.0\r\n";
		$en_tete_supp.="Content-type: text/plain; charset=\"utf-8\"\r\n";
		$en_tete_supp.="Content-Transfer-Encoding: 8bit\r\n";
		if (@mail($email_destinataire, "formulaire Amandari FR", $corps,$en_tete_supp)) {
			  $txt="<p style=\"color:GreenYellow;text-align:center\">";
			 if ($langage=="en") $txt.="Thanks. Your message has been sent.<br>We will reply as soon as possible</p>\r\n";
			 else $txt.="Merci. Votre message a &eacute;t&eacute; transmis.<br>Nous r&eacute;pondrons le plus rapidement possible</p>\r\n";
			  unset($corps);
			  unset($message);
			  unset($nom_prenom);

			  unset($email);
			  unset($ville);
			  unset($pays);
			  unset($telephone);
			  unset($date);
			  unset($codepostal);
			  unset($adresse);
			  unset($nuits);
			  unset($personnes);
			  unset($adultes);
			  unset($enfants);
			  unset($age_enfants);
			  unset($tabledhotes);
		}
		unset($email);
		unset($sujet);
		unset($message);
	}
}
if (!empty($msg)) {
	  $txt.="<p style=\"color:DarkOrange;text-align:center;font-weight:strong\">$msg</p>\r\n";
}

include ("modif.inc.php"); ?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>R&eacute;servation chambres d'hotes Amandari en Provence</title>
<meta name="description" content="Formulaire de réservation  des chambres d'hôtes / Roulotte / Gîtes  Amandari en Provence">
<meta name="keywords" content="chambres,hotes, gites, gite, charme,Provence">
<link href="_styles2.css" rel="stylesheet" type="text/css">
<link href="_styles-mob.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
$(function() {
	$.datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: 'Précédent',
		nextText: 'Suivant',
		currentText: 'Aujourd\'hui',
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
		dayNamesMin: ['D','L','M','M','J','V','S'],
		weekHeader: 'Sem.',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$( "#datepicker" ).datepicker({ minDate: 0,maxDate: "+12M" });
	$( "#datepicker" ).datepicker();
	$( "#datepicker2" ).datepicker();
	$( "#format" ).change(function() {
		$( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
	});
});
    </script>
	<? include ("_analytics.html") ?>
</head>


<body>
	  <? include ("_menu-fr2.html") ?>
<header>
<div id="drapeaux"> 
	  <? include ("_drapeaux2.html") ?>
</div>
<a href="/"><img src="photos/amandari-titre5.jpg" alt="l'Amandari chambres d'h&ocirc;tes Saint Tropez" border="0"></a>
    <h1> R&eacute;servation</h1>
</header>


<? //echo 'Version PHP courante : ' . phpversion().'<br>'; ?>
  <div class="main" style="background-color:none">  

    <form  method="post" action="<? echo $_SERVER[PHP_SELF] ?>#contact" id="reservation">
      <strong><a name="contact"></a></strong>
      <p class="center">Ce formulaire
          ne constitue pas un formulaire de r&eacute;servation
          en ligne. <br>
        En le remplissant le plus compl&eacute;tement possible, vous
          faciliterez le traitement rapide de votre demande d'informations.</p>
      <p style="margin:4px;color:white">
        <? if (!empty($txt)) print($txt);?>
      </p> 
      <table>
        <tr>
          <td><label for="nom_prenom">Nom Pr&eacute;nom*</label></td>
          <td><input type="text" name="nom_prenom" value="<? if (isset($nom_prenom)) print($nom_prenom)?>"  placeholder="indispensable" required/></td>
        </tr>
        <tr>
          <td><label for="email">Votre e-mail*</label></td>
          <td><input type="email" name="email" value="<? if (isset($email)) print($email)?>" placeholder="indispensable" required/></td>
        </tr>
        <tr >
          <td><label for="adresse">Adresse</label></td>
          <td><input name="adresse" type="text"   value="<? if (isset($adresse)) print($adresse)?>" /></td>
        </tr>
        <tr>
          <td><label for="codepostal">Code Postal</label></td>
          <td><input name="codepostal" type="text"   value="<? if (isset($codepostal)) print($codepostal)?>"/></td>
        </tr>
        <tr>
          <td><label for="ville">Ville</label></td>
          <td><input type="text" name="ville" value="<? if (isset($ville)) print($ville) ?>" /></td>
        </tr>
        <tr>
          <td><label for="pays">Pays</label></td>
          <td style="text-align:left"><input type="text" name="pays" value="<? if (isset($pays)) print($pays)?>"/></td>
        </tr>
        <tr>
          <td><label for="telephone">T&eacute;l&eacute;phone*</label></td>
          <td><input type="tel" name="telephone" value="<? if (isset($telephone)) print($telephone)?>"  placeholder="indispensable" required/></td>
        </tr>
        <tr>
          <td><label for="date">Date d'arriv&eacute;e</label></td>
          <td><input type="text" id="datepicker" name="date" value="<? if (isset($date)) print($date)?>"/></td>
        </tr>
        <tr>
          <td><label for="nuits">Nb de nuits</label></td>
          <td><input type="number" min="0" maxlength="2" name="nuits" size="2" value="<?  if (isset($nuits)) print($nuits) ?>"/>
          &nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td><label for="adultes">Nb d'adultes</label></td>
          <td><input name="adultes" type="number" id="jour" size="4" value="<?print($adultes)?>" min="0" ></td>
        </tr>
        <tr>
          <td><label for="enfants">Nb d'enfants</label></td>
          <td><input name="enfants" type="number" size="5" value="<?print($enfants)?>" min="0"></td>
        </tr>
        <tr>
          <td><label for="age_enfants">Age des enfants</label></td>
          <td><input name="age_enfants" type="text"  size="10" value="<?print($age_enfants)?>" min="0"></td>
        </tr>
        <tr>
          <td><label for="message">Message</label></td>
          <td><textarea name="message"  wrap="physical" rows="3"><? if (isset($message)) print($message) ?>
          </textarea></td>
        </tr>
        <tr>
          <td><span style="font-size:smaller">*champ obligatoire</span></td>
          <td style="border-bottom-right-radius: 4px;"><input type="submit" name="button" id="button" value="envoyer" /></td>
        </tr>
      </table>
      <p class="center">Votre vie privée ainsi que la sécurité de vos données à caractère personnel demeurent l’une de nos priorités et nous ne les vendronsni ne transmettrons jamais !</p>
    </form>
  </div>
    
          <? include ("_cartedevisite.html") ?>
    <? include ("_copyright-fr.html") ?>

</div>
</body>

</html><br>