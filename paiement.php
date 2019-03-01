<?php 
		require 'database.php'


		

	$NomPrenom = $eMail = $Telephone =  $CarteBancaire = $Montant = "" ;
	$NomPrenomError = $eMailError = $TelephoneError =  $CarteBancaireError = $MontantError = "" ;
	$isSuccess = false;
	if ($_SERVER["REQUEST_METHOD"]=="post") 
	{
		$NomPrenom       = verifyinput($_POST["NomPrenom"]);
		$eMail         	 = verifyinput($_POST["eMail"]);
		$Telephone       = verifyinput($_POST["Telephone"]);
		$CarteBancaire   = verifyinput($_POST["CarteBancaire"]);
		$Montant       	 = verifyinput($_POST["Montant"]);
		$isSuccess=true;

		if (empty($NomPrenom))
		{
			$NomPrenomError ="veuillez saisir votre nom et prenom";
			$isSuccess = false;
		}

		if (empty($eMail))
		{
			$eMailError ="veuillez saisir votre email";
			$isSuccess = false;
		}

		if (empty($Telephone))
		{
			$TelephoneError ="veuillez saisir votre numero de Telephone";
			$isSuccess = false;
		}
		if (empty($CarteBancaire))
		{
			$CarteBancaireError ="veuillez saisir le numero de la carte Bancaire";
			$isSuccess = false;
		}

		if (empty($Montant))
		{
			$MontantError ="veuillez saisir le Montant";
			$isSuccess = false;
		}
		if (!isEmail($eMail)) 
		{
			$eMailError ="veuillez saisir votre email";
			$isSuccess = false;
		}

	}
	function isEmail($var)
	{
		return filter_var($var, FILTER_VALIDATE_EMAIL);

	}

	function verifyinput($var)
	{
		$var = trim($var);
		$var = stripslashes($var);
		$var = htmlspecialchars($var);
		return $var;
	}

	if ( isset(($_POST["NomPrenom"]) && isset($_POST["CarteBancaire"]) && isset($_POST["eMail"]) )
	{
		$db = Database::connect();
		$statement= $connection->query("INSERT INTO client(NomPrenom,NumeroCarteBancaire,email,MontantTransaction) VALUES('$NomPrenom',$CarteBancaire,$eMail)");
		Database::disconnect();
		header("location: index.php")
	}
?>













<!DOCTYPE html>
<html>
	<head>
		<title>formulaire_paiement</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width ,initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
		<link rel="stylesheet" type="text/css" href="fontawesome/scss/_icons.scss">
		<link rel="stylesheet" type="text/css" href="styleF.css">
	</head>
	<body>
		<div class="container">
			<div class="heading">
				<h2>COMMANDER UN NAVIRE !!</h2>
			</div>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<form id="command_form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ; ?>" role="form">
						<div class="row">
							<div class="col-md-6">
								<label for="NomPrenom">Nom et Prenom</label>
								<input type="text" id="NomPrenom" name="NomPrenom" class="form-control" placeholder="Entrez Nom&Prenom" required="required"  value="<?php echo $NomPrenom ?>">
								<p class="comment"><?php echo $NomPrenomError ;?></p>


								<label for="eMail">eMail</label>
								<input type="email"id="eMail" name="eMail" class="form-control" placeholder="Entrez votre eMail" required="required" value="<?php echo $eMail ?>">
								<p class="comment"><?php echo $eMailError ;?></p>

								<label for="Telephone">Telephone</label>
								<input type="tel"id="Telephone" name="Telephone" class="form-control" placeholder="Entrez votre Telephone" required="required" value="<?php echo $Telephone ?>">
								<p class="comment"><?php echo $TelephoneError ;?></p>
							</div>
							<div class="col-md-6">
								<label for="CarteBancaire">Numero Carte Bancaire</label>
								<input type="text"id="CarteBancaire" name="CarteBancaire" class="form-control" placeholder="Entrez Numero CarteBancaire" required="" value="<?php echo $CarteBancaire?>">
								<p class="comment"><?php echo $CarteBancaire ;?></p>

								<label for="NomPrenom">Montant en €</label>
								<input type="text" id="Montant" name="Montant" class="form-control" placeholder="Entrez le Montant de la transaction"  value="<?php echo  $Montant ?>">
								<p class="comment"><?php echo $MontantError ;?></p>
							</div>
							<div class="col-md-12">
								<input type="submit" name="" class="button1" value="ENVOYER">
							</div>
						</div>
						
						
					</form>
				</div>
				
			</div>
			
		</div>

	</body>
</html>






