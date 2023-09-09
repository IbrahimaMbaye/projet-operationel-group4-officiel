<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantiteStock = intval($_POST["quantiteStock"]);
    $quantiteDemandee = intval($_POST["quantiteDemandee"]);

    if ($quantiteStock >= $quantiteDemandee) {
        $message = "Produit vendu avec succès.";
    } else {
        $message = "Le stock est inférieur à la quantité demandée.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alerte Quantité</title>
</head>
<body>
    <h1>Alerte Quantité</h1>
    <form method="post" action="">
        <label for="quantiteStock">Quantité en stock :</label>
        <input type="number" name="quantiteStock" required><br>

        <label for="quantiteDemandee">Quantité demandée :</label>
        <input type="number" name="quantiteDemandee" required><br>

        <input type="submit" value="Vendre">
    </form>
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
</body>
</html>