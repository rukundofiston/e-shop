<?php
include ('config.php');
//extract($_GET);

/*echo $id;*/
$panierM = new PanierManager($ikra);
$panier = new Panier($_GET);
$panierss = $panierM->add($panier);
unset($_GET['id']);
unset($_GET['id_produit']);

header('location:mobileIndex.php');