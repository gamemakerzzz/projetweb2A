<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../Controller/ProduitP.php';
$produitC = new ProduitC();
$list = $produitC->listProduits();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylev.css">
</head>
<body>
    <center>
        <h1>Liste Des Produits</h1>
    </center>

    <div class="product-container">
        <?php
        foreach ($list as $produit) {
            $nomImage = $produitC->getImageByIdProduit($produit['IdProd']);
            $myArray = explode('/', $nomImage);
            $name = $myArray[sizeof($myArray) - 1];
            $imageSrc = !empty($nomImage) ? "http://localhost/gestion_produits/view/image_bdd/" . $name : null;
        ?>
            <div class="product-item">
                <div class="product-image">
                    <img src="<?php echo $imageSrc; ?>" alt="Image du produit" style="width: 50px; height: 50px;">
                </div>
                <div class="product-details">
                    <h2><?php echo $produit['Description']; ?></h2>
                    <p>Quantité: <?php echo $produit['Quantite']; ?></p>
                    <p>Prix: <?php echo $produit['Prix']; ?></p>
                </div>
                <div class="product-actions">
                    <button class="order-btn">Order</button>
                    <a href="updateProduit.php?IdProd=<?php echo $produit['IdProd']; ?>">Update</a>
                    <a href="deleteProduit.php?IdProd=<?php echo $produit['IdProd']; ?>">Delete</a>
                    <button><a href="addProduit.php">Ajouter</a></button>

                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>
