<?php
include '../Controller/ProduitP.php';
$articleC = new ProduitC();
$articleC->deleteProduit($_GET["IdProd"]);
header('Location:listProduit.php');