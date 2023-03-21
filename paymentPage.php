<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style2.css">
    <?php
          include 'includes/head.php';
          include 'payment-backend.php';
    ?>
</head>
<body>
 <div class="container">
  <div class="row mt-3">
    <div class="col-12 col-md-6"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">home_pin</span><span style="color:#613818;font-weight:bold">Expédition</span></div>
    <div class="col-12 col-md-3"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">person</span> <span style="color:#613818;font-weight:bold"><?= $_SESSION['username'] ?></span></div>
    <div class="col-12 col-md-3"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">support_agent</span> <span style="color:#613818;font-weight:bold">+1 514 969 2223</span></div>
  </div>
  <div class="title">
      <h5>1. Renseignements sur l'adresse</h5>
  </div>
  <div class="title">
      <h5>2. Détail sur l'envoi</h5>
  </div>
  <div class="title">
      <h5>3. Paiement</h5>
  </div>
  <div class="row">
    <div class="col-12 ">
        <br><br>
    <h5 style="color: #613818;">Voici les détails de votre commande</h5> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <p>Livraison <?= $_SESSION['chosen_delay'] ?> $<?= $_SESSION['delayCost'] ?> </p>
        <p>Option de signature ajouté $<?= $_SESSION['protection_cost'] ?></p>
        <p>TPS (9.25%) $<?= $_SESSION['excessWeightCost'] ?></p>
        <p>TVQ ($5%) $<?= $_SESSION['excessLengthCost'] ?></p>
    </div>
    <div class="col-12 col-md-6">
  </div><br>
  <div class="section1">
    <br><br>
  </div>
   <span>Montant total de votre commande</span>
   <div class="row">
        <div class="col-6 col-md-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="161" height="114" viewBox="0 0 131 114">
                <g id="Groupe_1" data-name="Groupe 1" transform="translate(-342 -540)">
                <text id="_15" data-name="$15" transform="translate(349 594)" fill="#613818" font-size="50" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">$<?= $_SESSION['final_cost'] ?></tspan></text>
                </g>
            </svg>
        </div>
   
   </div>
   </div>
   <input type="button" class="submit" name="panier" value="Mettre au Panier" style="float: none; width: 10%; font-size: 10px; margin: 0;"/><br><br>
    <input type="checkbox" id="facture" name="facture" value="YES">
    <label for="facture"> Je souhaite recevoir une copie de ma facture par courriel </label><br>
   
   <br>
   <p>Choisir votre mode de payement</p>
   <p>
   <span>
   <input type="radio" id="carte" name="modePayement" value="carte">
    <label for="carte"> Carte Bancaire </label>
    <input type="radio" id="paypal" name="modePayement" value="paypal">
    <label for="paypal"> PayPal </label><br>
   <input type="submit" class="submit" name="submit" value="Poursuivre"/><br><br>
   </span>
   </p>
  </form>
    <div class="title1 mt-3">
      <h5>4. Confirmation</h5>
    </div>
</div>
  

   <?php require_once 'includes/footer.php' ?>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>