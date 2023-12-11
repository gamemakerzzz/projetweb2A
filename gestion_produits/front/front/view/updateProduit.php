<?php
include '../Controller/ProduitP.php';

$produitC = new ProduitC();

// Check if IdProd is set in the URL
if (!isset($_GET["IdProd"])) {
    // If IdProd is not set in the URL, redirect to the product list
    header('Location: listProduit.php');
    exit();
}

// Attempt to retrieve the product details
$produit = $produitC->showProduit($_GET["IdProd"]);

// Check if the product was found
if (!$produit) {
    // If the product was not found, redirect to the product list
    header('Location: listProduit.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["Description"]) &&
        isset($_POST["Quantite"]) &&
        isset($_POST["Prix"])
    ) {
        if (
            !empty($_POST['Description']) &&
            !empty($_POST["Quantite"]) &&
            !empty($_POST["Prix"])
        ) {
            $produit = new Produit(
                $_GET['IdProd'],
                $_POST['Description'],
                $_POST['Quantite'],
                $_POST['Prix']
            );

            $produitC->updateProduit($produit, $_GET["IdProd"]);

            header('Location: listProduit.php');
            exit();
        } else {
            $error = "Missing information";
        }
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit Display</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>

</head>
<body>
    <button><a href="listProduit.php">Back to list</a></button>
    <hr>
    <div id="error">
        <?php echo isset($error) ? $error : ''; ?>
    </div>

    <form action="updateProduit.php?IdProd=<?php echo $_GET['IdProd']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" novalidate>
        <label for="Description">Description:</label>
        <input type="text" name="Description" id="Description" value="<?php echo $produit['Description']; ?>" maxlength="255" required>

        <label for="Quantite">Quantité:</label>
        <input type="text" name="Quantite" id="Quantite" value="<?php echo $produit['Quantite']; ?>" maxlength="50" required>

        <label for="Prix">Prix:</label>
        <input type="text" name="Prix" id="Prix" value="<?php echo $produit['Prix']; ?>" required>

        <input type="submit" value="Modifier">
    </form>
</body>
</html>
