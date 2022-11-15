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
		if (@mail($email_destinataire, "formulaire Amandari EN", $corps,$en_tete_supp)) {
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
<title>Reservation B&amp;B Amandari in Provence</title>
<meta name="description" content="Reservation form for the B&amp;B  Amandari in Provence">
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
	//$.datepicker.setDefaults($.datepicker.regional['fr']);
	$( "#datepicker" ).datepicker({
  dateFormat: "dd/mm/yy"
});
	$( "#datepicker" ).datepicker({ minDate: 0,maxDate: "+12M" });
	$( "#datepicker" ).datepicker();
	$( "#datepicker2" ).datepicker();
	$( "#format" ).change(function() {
		$( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
	});
});
	</script>
	<link href="https://www.provence-holidays.com/contact-en.php" rel="alternate" hreflang="en" />
	<? include ("_analytics.html") ?>
</head>


<body>
	<? include ("_menu-en2.html") ?>
<header>
<div id="drapeaux"> 
	  <? include ("_drapeaux2-en.html") ?>
</div>
<a href="index-english.html"><img src="photos/amandari-titre5.jpg" alt="l'Amandari chambres d'h&ocirc;tes Saint Tropez" border="0"></a>
    <h1> Reservation</h1>
</header>


<? //echo 'Version PHP courante : ' . phpversion().'<br>'; ?>
  <div class="main" style="background-color:none">  
      <p class="center" style="margin-bottom: 4px">This form is not a book online form.<br>
By completing the most completely possible, you will ease the quick processing of your request for information.</p>

    <form  method="post" action="<? echo $_SERVER[PHP_SELF] ?>#contact" id="reservation">
      <strong><a name="contact"></a></strong>
      
        <? if (!empty($txt)) print($txt);?>
       
      <table>
        <tr>
          <td><label for="nom_prenom">Name Surname*</label></td>
          <td border-top-right-radius: 4px;><input type="text" name="nom_prenom" value="<? if (isset($nom_prenom)) print($nom_prenom)?>"  placeholder="compulsory" required/></td>
        </tr>
        <tr>
          <td><label for="email">Your e-mail*</label></td>
          <td><input type="email" name="email" value="<? if (isset($email)) print($email)?>" placeholder="compulsory" required/></td>
        </tr>
        <tr >
          <td><label for="adresse">Address</label></td>
          <td><input name="adresse" type="text"   value="<? if (isset($adresse)) print($adresse)?>" /></td>
        </tr>
        <tr>
          <td><label for="codepostal"> Postcode</label></td>
          <td><input name="codepostal" type="text"   value="<? if (isset($codepostal)) print($codepostal)?>"/></td>
        </tr>
        <tr>
          <td><label for="ville">City</label></td>
          <td><input type="text" name="ville" value="<? if (isset($ville)) print($ville) ?>" /></td>
        </tr>
        <tr>
          <td><label for="pays">Country</label></td>
          <td style="text-align:left"><input type="text" name="pays" value="<? if (isset($pays)) print($pays)?>"/></td>
        </tr>
        <tr>
          <td><label for="telephone">Telephone*</label></td>
          <td><input type="tel" name="telephone" value="<? if (isset($telephone)) print($telephone)?>"  placeholder="compulsory" required/></td>
        </tr>
        <tr>
          <td><label for="date">Date of Arrival</label></td>
          <td><input type="text" id="datepicker" name="date" value="<? if (isset($date)) print($date)?>"/></td>
        </tr>
        <tr>
          <td><label for="nuits">Nb of nights</label></td>
          <td><input type="number" min="0" maxlength="2" name="nuits" size="2" value="<?  if (isset($nuits)) print($nuits) ?>"/>
          &nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td><label for="adultes">Nb of adults</label></td>
          <td><input name="adultes" type="number" id="jour" size="4" value="<?print($adultes)?>" min="0" ></td>
        </tr>
        <tr>
          <td><label for="enfants">Nb of children</label></td>
          <td><input name="enfants" type="number" size="5" value="<?print($enfants)?>" min="0"></td>
        </tr>
        <tr>
          <td><label for="age_enfants">Age of the children</label></td>
          <td><input name="age_enfants" type="text"  size="10" value="<?print($age_enfants)?>" min="0"></td>
        </tr>
        <tr>
          <td><label for="message">Message</label></td>
          <td><textarea name="message"  wrap="physical" rows="3"><? if (isset($message)) print($message) ?>
          </textarea></td>
        </tr>
        <tr>
          <td><span style="font-size:smaller">*compulsory</span></td>
          <td><input type="submit" name="button" id="button" value="send" /></td>
        </tr>
      </table>
      <p class="center">Your privacy and the security of your personal data remains one of our priorities and we will never sell or rent them!</p>
    </form>
  </div>
    
          <? include ("_cartedevisite-en.html") ?>
  <? include ("_copyright-fr.html") ?>
</body>

</html><br>