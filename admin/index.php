<?php
include ('config.php');
session_start();

if(isset($_SESSION['login_user'])){

	$cltM = new ClientManager($ikra);
	$Nbf = $cltM ->count("WHERE sexe = 'Femme'");
	$Nbhomme = $cltM ->count("WHERE sexe = 'Homme'");
	$NbClientMar = $cltM ->count("WHERE ville = 'Marrakech'");
	$NbClientCas= $cltM ->count("WHERE ville = 'casa'");
	$NbClientRaba = $cltM ->count("WHERE ville = 'Rabat'");
	$NbClientfas = $cltM ->count("WHERE ville = 'Fase'");
	$smarty->assign("Nbhomme", $Nbhomme);
	$smarty->assign("NoFemme", $Nbf);
	$smarty->assign("NbClientMar", $NbClientMar);
	$smarty->assign("NbClientCas", $NbClientCas);
	$smarty->assign("NbClientRaba", $NbClientRaba);
	$smarty->assign("NbClientfas", $NbClientfas);
	$comM=new CommandeManager($ikra);
	$NbComEat = $comM ->count("WHERE etat = 'en attente'");
	$NbComVen = $comM ->count("WHERE etat = 'vendue'");
	$smarty->assign("NbComEat", $NbComEat);
	$smarty->assign("NbComVen", $NbComVen);
	$contactManager =new contactManager($ikra);
	$messages=$contactManager->selectUnread();
	$nbreMessage=$contactManager->count("WHERE statut = 0");

	$smarty->assign("user",$_SESSION['login_user']);
	$smarty->assign("messages",$messages);
	$smarty->assign("nbreMessage",$nbreMessage);
	$smarty->display('acceuil.html');
}
else{
	if( isset($_POST) && (!empty($_POST['username'])) && (!empty($_POST['password']))) {		
		$myusername=$_POST['username']; 
		$mypassword=$_POST['password'];
		$utilisateurM=new UtilisateurManager($ikra);
		//$utilisateur =new Utilisateur($myusername);
		$utilisateur=$utilisateurM->getByLogin($myusername);
		/*debug($utilisateur);
		die();*/

		if ($myusername == $utilisateur->getLogin() && md5($mypassword)==$utilisateur->getPass()){
			$_SESSION['login_user']=$myusername;
			//session_start();
			
			$cltM = new ClientManager($ikra);
			$Nbf = $cltM ->count("WHERE sexe = 'Femme'");
			$Nbhomme = $cltM ->count("WHERE sexe = 'Homme'");
			$NbClientMar = $cltM ->count("WHERE ville = 'Marrakech'");
			$NbClientCas= $cltM ->count("WHERE ville = 'casa'");
			$NbClientRaba = $cltM ->count("WHERE ville = 'Rabat'");
			$NbClientfas = $cltM ->count("WHERE ville = 'Fase'");
			$smarty->assign("Nbhomme", $Nbhomme);
			$smarty->assign("NoFemme", $Nbf);
			$smarty->assign("NbClientMar", $NbClientMar);
			$smarty->assign("NbClientCas", $NbClientCas);
			$smarty->assign("NbClientRaba", $NbClientRaba);
			$smarty->assign("NbClientfas", $NbClientfas);
			$comM=new CommandeManager($ikra);
			$NbComEat = $comM ->count("WHERE etat = 'en attente'");
			$NbComVen = $comM ->count("WHERE etat = 'vendue'");
			$smarty->assign("NbComEat", $NbComEat);
			$smarty->assign("NbComVen", $NbComVen);
			$contactManager =new contactManager($ikra);
			$messages=$contactManager->selectUnread();
			$nbreMessage=$contactManager->count("WHERE statut = 0");

			$smarty->assign("user",$myusername);
			$smarty->assign("messages",$messages);
			$smarty->assign("nbreMessage",$nbreMessage);
			$smarty->display('acceuil.html');
		}
	else 
		$smarty->display('me-login.html');  
	}
	else{
		$smarty->display('me-login.html');
	}
}