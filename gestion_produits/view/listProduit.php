
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
        <h2>
            <a href="addProduit.php">Ajouter un produit</a>
        </h2>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>Id Produit</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Image</th> <!-- Add this column for the image -->
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($list as $produit) {
        ?>
            <tr>
                <td><?= $produit['IdProd']; ?></td>
                <td><?= $produit['Description']; ?></td>
                <td><?= $produit['Quantite']; ?></td>
                <td><?= $produit['Prix']; ?></td>
                
                <!-- Display the image if available -->
                <td align="center">
                    <?php
                    $nomImage = $produitC->getImageByIdProduit($produit['IdProd']);

                    $myArray = explode('/', $nomImage);
                    $name = $myArray[sizeof($myArray)-1];
                    if (!empty($nomImage)) {
                        $cheminImage = "http://localhost/gestion_produits/view/image_bdd/" . $name;
                        ?>
                        <img src="<?php echo $cheminImage; ?>" alt="Image du produit" style="width: 50px; height: 50px;">
                        <?php
                    } else {
                        // Handle the case where there is no image
                        echo "Aucune image disponible";
                    }
                    ?>
                </td>
                <td align="center">
                    <form method="POST" action="updateProduit.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $produit['IdProd']; ?> name="IdProd">
                    </form>
                </td>
                <td>
                    <a href="deleteProduit.php?IdProd=<?php echo $produit['IdProd']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
