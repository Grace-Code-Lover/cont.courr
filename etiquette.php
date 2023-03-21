<!DOCTYPE html> 
<html> 
  <head> 
  <link rel="stylesheet" href="css/style2.css">
    <title>Shipment Label</title> 
    <?php   
        session_start();    
        include 'barcode.php';
    ?>
    <style> 

.shipment-label {
  width: 400px;
  border: 2px solid #ccc;
  padding: 20px;
  font-family: Arial, sans-serif;
  font-size: 14px;
}

.shipment-header {
  text-align: center;
  margin-bottom: 20px;
}

.shipment-body {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
  flex-direction: column;
}

.sender, .recipient, .package {
  width: 30%;
}

.sender h3, .recipient h3, .package h3 {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
}

.shipment-footer {
  text-align: right;
}
 
    </style> 
  </head> 
  <body> 
        <div class="shipment-label">
            <div class="shipment-header">
                <h2>Shipment Details</h2>
            </div>
            <div class="shipment-body">
                <div class="sender">
                    <h3>Expéditeur</h3>
                    <p><?= $_SESSION['username'] ?></p>
                    <p><?= $_SESSION['houseAdressuser'] ?></p>
                    <p><?= $_SESSION['postaluser'] ?></p>
                </div>
                <div class="recipient">
                    <h3>Destinataire</h3>
                    <p><?= $_SESSION['destname'] ?></p>
                    <p><?= $_SESSION['houseAdressdest'] ?></p>
                    <p><?= $_SESSION['postaldest'] ?></p>
                </div>
                <div class="package">
                    <h3>Colis</h3>
                    <p>Poids: <?= $_SESSION['weightlb'] ?> lb</p>
                    <p>Dimensions: <?= $_SESSION['dimension'] ?></p>
                </div>
                <div class="package">
                    <h3>Cout Total</h3>
                    <h2>$<?= $_SESSION['final_cost'] ?></h2>
                </div>
            </div>
            <div class="shipment-footer">
                <p>N° Tracking : <?= $_SESSION['trackingNumber'] ?></p>
            </div>
        </div>
        <a class="submit" href="test_etiquette.php">imprimer l'etiquette</a>
        <?php //if(isset($_POST['imprimer'])) {header('Location:test_etiquette.php');} ?>
  </body>
</html>
