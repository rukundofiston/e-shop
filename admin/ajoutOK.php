<?php
include ('config.php');
$produitM = new ProduitManager($ikra);
debug($_post);
$dossier = 'img/produit/';
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 1048576;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['avatar']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
	 echo "<script>alert(\"Vous devez uploader un fichier de type png, gif, jpg, jpeg\")</script>"; 
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
	 	 echo "<script>alert(\"Le fichier est trop gros...\")</script>"; 

}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
		$_POST['photos']=$dossier.basename($_FILES['avatar']['name']);
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
		 
     }
}
else
{
     echo $erreur;
}
$produit = new Produit($_POST);

$produits = $produitM ->add($produit);
header('location:index.php'); 
