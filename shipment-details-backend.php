<?php

try {
  $database = new PDO('mysql:host=localhost;dbname=continentalcourrier', 'root', '');
}
catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}
session_start();
// Fonction pour nettoyer les données de formulaire
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Vérification des champs de formulaire
if(isset($_POST['submit'])) {
  // Vérifier si le pack_type est vide
  if(empty($_POST['pack_type'])) {
    $pack_typeErr = "Veuillez selectionner le type d'emballage";
  } else {
    $pack_type = test_input($_POST['pack_type']);
  }
  
  
  // Vérifier si le poids est vide
  if(empty($_POST['weight'])) {
    $weightErr = "Veuillez entrer le poids";
  } else {
    $weight = test_input($_POST['weight']);
    if(test_input($_POST['mesure']) == 'kg'){
        $weight = (float)$weight*2.20462;
    }
  }


  // Vérifier si le quantity est vide
  if(empty($_POST['quantity'])) {
    $quantityErr = "La quantité est obligatoire";
  } else {
    $quantity = test_input($_POST['quantity']);
  }


    // Vérifier si le value est vide
    if(empty($_POST['input'])) {
      $valueErr = "La ville est obligatoire";
    } else {
      $value = test_input($_POST['input']);
    }

    //verifier la couverture
    if(empty($_POST['covered'])) {
        $covered = "NO";
      } else {
        $covered = test_input($_POST['covered']);
      }

    //verifier les batteries lithium
    if(empty($_POST['lithiumBatt'])) {
        $lithiumBatt = 0;
    }
    else{
        $lithiumBatt = test_input($_POST['lithiumBatt']);
    }

    //verifier la signature
    if(empty($_POST['signature'])) {
        $signature = 0;
    }
    else {
        $signature = test_input($_POST['signature']);
    }

    // Vérifier si le longueur est vide
    if(empty($_POST['longueur'])) {
        $longueurErr = "La longueur est obligatoire";
    } else {
        $longueur = test_input($_POST['longueur']);
    }

    // Vérifier si le largeur est vide
    if(empty($_POST['largeur'])) {
        $largeurErr = "La largeur est obligatoire";
    } else {
        $largeur = test_input($_POST['largeur']);
    }

    // Vérifier si le hauteur est vide
    if(empty($_POST['hauteur'])) {
        $hauteurErr = "La hauteur est obligatoire";
    } else {
        $hauteur = test_input($_POST['hauteur']);
    }

    
    

    if(!isset($pack_typeErr) && !isset($weightErr) && !isset($valueErr) && !isset($longueurErr) && !isset($largeurErr) && !isset($hauteurErr)) {
        //definir la dimension
        $dimension=$longueur. " X ". $largeur. " X ". $hauteur." cm";
        

        $excessLength = 0.0;
        $excessLengthCost= 0.0;
        $excessLength =  (float)$longueur > 35 ? $excessLength + ((float)$longueur - 35) : $excessLength;
        $excessLength =  (float)$largeur > 15 ? $excessLength + ((float)$largeur - 15) : $excessLength;
        $excessLength =  (float)$hauteur > 20 ? $excessLength + ((float)$hauteur - 20) : $excessLength;
        $excessLengthCost = $excessLength*0.01;
        $_SESSION['excessLengthCost'] = $excessLengthCost;
    

        $excessWeightCost = (float)$weight > 10 ? 0.30*((float)$weight - 10) : $excessWeightCost;
        $_SESSION['excessWeightCost']=$excessWeightCost;
        
        $protection_cost = 0.0;
        if($covered == "YES") {
            $protection_cost = $protection_cost + 50.0;
        }
        if((float)$lithiumBatt > 0) {
            $protection_cost = $protection_cost + $lithiumBatt;
        }
        if((float)$signature > 0) {
            $protection_cost = $protection_cost + $signature;
        }
        $_SESSION['protection_cost'] = $protection_cost;

        //echo $protection_cost;

        $delay = explode("X",test_input($_POST['delai']));
        $delayCost=(float)$delay[1];
        $_SESSION['chosen_delay'] = $delay[0];
        $_SESSION['delayCost'] = $delayCost;

        $final_cost = $excessLengthCost + $excessWeightCost + $protection_cost + $delayCost;
        $_SESSION['final_cost'] =$final_cost;
        
        echo $final_cost;
        $_SESSION['weightlb'] =$weight;
          $_SESSION['dimension'] =$dimension;

      $query = $database->prepare('UPDATE shipment SET pack_type= :pack_type, weightlb = :weightlb, itemvalue = :itemvalue, dimension = :dimension, covered = :covered, lithiumBatt = :lithiumBatt, signature = :signature, total = :total WHERE id= :id');
        $done = $query->execute(array(
        'id' => $_SESSION['shipment_id'],
        'pack_type' => $pack_type,
        'weightlb' => $weight,
        'itemvalue' => $value,
        'dimension' => $dimension,
        'covered' => $covered,
        'lithiumBatt' => $lithiumBatt,
        'signature' => $signature,
        'total' => $final_cost));
      
      if($done) {
        header('Location: paymentPage.php');
      }
    }  
}

  

?>