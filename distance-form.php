<!DOCTYPE html>
<html lang="en">
<head>
    <?php
          include 'includes/head.php';
          include 'distance-form-validation.php'; 
    ?>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="code_postal_expedition">Code Postal de l'Expedition
            <input type="text" name="code_postal_expedition" id="code_postal_expedition">
        </label> <br>

        <label for="code_postal_destination">Code Postal de la Destination
            <input type="text" name="code_postal_destination" id="code_postal_destination">
        </label> <br>

        <label for="code_postal_destination">Delai de Livraison
            <select name="delai" id="delai">
                <option value="direct">Direct</option>
                <option value="2h">2 Heures</option>
                <option value="midday">Apres Midi</option>
                <option value="nextday">Lendemain</option>
            </select>
        </label> <br>
        <div class="row">
            <div class="col-12 col-md-6">
                <input type="submit" name="submit" value="Envoyer"><br>
            </div>
        </div>
    </form><br><br>
    <?php echo "La distance en Kilomètres du du code postal <b>".$code_postal_expedition."</b> (Zone ".$zone_expedition.") au code postal <b>".$code_postal_destination."</b> (Zone ".$zone_destination.") est : <b>".$distance_en_kilometres." KM.</b><br>Et le cout correspondant de cette distance vaut : ".$cout_total_dist." CA$ <br>";
          echo "Le cout d'expedition de ".$code_postal_expedition." (Zone ".$zone_expedition.") au code postal ".$code_postal_destination." (Zone ".$zone_destination.") pour un delai <b>"; echo isset($_POST['delai']) ? $_POST['delai'] : ''; echo "</b> est de <b>".$cout_total_zone." CA$.</b>"; ?>

</body>
</html>