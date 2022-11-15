<? 
function affich_texte($champ) {    //a modifier - affiche un champ texte
	print(stripslashes(nl2br($champ)));
}



//parametres
//include("modif.inc.php");
$email_destinataire="amandari.chambredhote@gmail.com";

foreach($_GET as $key => $value) $$key = $value;
foreach($_POST as $key => $value) $$key = $value;
//foreach($_POST as $key => $value) echo ("$key = $value <br>\n");
if (isset($button) && ($button=="→ envoyer" || $button=="→ send")) {
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
	if (!empty($date)) $corps.="Date d'Arrivée : $date\r\n";	if (!empty($chambresdhotes)) $corps.="Chambres d'hôtes : $chambresdhotes\r\n";
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
			  $txt="<p style=\"color:#0a69ab;text-align:center\">";
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
<link href="_styles2020.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/png" href="photos/favicon.ico"/>
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
	
	<link href="https://www.provence-holidays.com/contact.php" rel="alternate" hreflang="fr" />
	<? include ("_analytics.html") ?>
</head>


<body>
	  <? include ("_menu-fr2021.htm") ?>
<header>
  <div id="background"></div>
  <div id="logo"></div>
  <div id="titre">
    <h1>l'Amandari<span>></span><span>Informations et réservations</span></h1>
    <h2>Maison d'hôtes de charme, Gîtes et Roulotte dans le golfe de St Tropez (Le Plan de la Tour)</h2>
  </div>
</header>


<main>
    <section>
	<p class="center">Ce formulaire ne constitue pas un formulaire de r&eacute;servation en ligne. En le remplissant le plus compl&eacute;tement possible, vous faciliterez le traitement rapide de votre demande d'informations.</p>
<? //echo 'Version PHP courante : ' . phpversion().'<br>'; ?>
<p class="center">
        <? if (!empty($txt)) print($txt);?>
      </p> 
    <form  method="post" action="<? echo $_SERVER[PHP_SELF] ?>#contact" id="reservation">
      <fieldset>
        <input type="text" name="nom_prenom" value="<? if (isset($nom_prenom)) print($nom_prenom)?>"  placeholder="Nom Prénom*" required/>
        <input type="email" name="email" value="<? if (isset($email)) print($email)?>" placeholder="Email*" required/>
        <input name="adresse" type="text"   value="<? if (isset($adresse)) print($adresse)?>"  placeholder="Adresse" />
        <input name="codepostal" type="text"   value="<? if (isset($codepostal)) print($codepostal)?>" placeholder="Code Postal" />
        <input type="text" name="ville" value="<? if (isset($ville)) print($ville) ?>"  placeholder="Ville" />
        <input type="text" name="pays" value="<? if (isset($pays)) print($pays)?>" placeholder="Pays" />
        <input type="tel" name="telephone" value="<? if (isset($telephone)) print($telephone)?>"  placeholder="Téléphone*" required/>
        <input type="text" id="datepicker" name="date" value="<? if (isset($date)) print($date)?>" placeholder="Arrivée"/>
        <input type="number" min="0" maxlength="2" name="nuits"  value="<?  if (isset($nuits)) print($nuits) ?>" placeholder="Nb de nuits"/>
        <input name="adultes" type="number" id="jour"  value="<?print($adultes)?>" min="0" placeholder="Nb d'adultes">
        <input name="enfants" type="number"  value="<?print($enfants)?>" min="0" placeholder="Nb d'enfants">
        <input name="age_enfants" type="text"  value="<?print($age_enfants)?>" min="0" placeholder="Age des enfants">
     </fieldset>
     <fieldset>
        <textarea name="message"  wrap="physical" rows="3" placeholder="Message" ><? if (isset($message)) print($message) ?></textarea>
        <input type="submit" name="button" id="button" value="&rarr; envoyer" />
     </fieldset>
	</form>
	<p class="center">Votre vie privée ainsi que la sécurité de vos données à caractère personnel demeurent l’une de nos priorités et nous ne les vendrons ni ne transmettrons jamais !</p>

</section>
	<section class="mediation">
		<h3>Médiation</h3>
		<p>Conformément à la loi, nous avons désigné un médiateur indépendant en vue de la résolution amiable de tout litige qui pourrait survenir entre un client et notre maison.</p>
		<p>Le médiateur désigné est « MTV – La médiation Tourisme et Voyage », BP80303 - 75823 Paris cedex 17.</p>
		<p>Pour plus de détails, veuillez consulter son site internet à l’adresse suivante : <a href="https://www.mtv.travel" target="_blank">https://www.mtv.travel</a></p>
  </section>

</main>
   <?php include ("_footer.htm") ?>
</body>
</html>