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


// codes postaux d'expédition et de destination depuis le formulaire
if(isset($_POST['submit'])){

    $code_postal_expedition =  test_input($_SESSION['postaluser']);

    // Vérifier si le postaldest est vide
    if(empty($_POST['postaldest'])) {
        $postaldestErr = "Le code postal est obligatoire";
    } 
    elseif(strlen($_POST['postaldest']) <= 5) {
        $postaldestErr = "Le code postal doit contenir au moins 6 charactères !";
    }else {
        $code_postal_destination = test_input($_POST['postaldest']);
        
    


        /************ Prix d'expedition en fonction des codes postaux et delai **************/

        //Zone d'expedition
        $zone = $database->prepare('SELECT `zone` FROM `zonage` WHERE `code` = :codeExp');
        $zone->execute(array('codeExp' => str_split($code_postal_expedition,3)[0] ));
        $zone_expedition = $zone->fetch() ['zone'];
        // $_SESSION['zone_expedition'] = $zone_expedition;
        // echo $zone_expedition."<br>";

        //Zone de Destination
        $zone = $database->prepare('SELECT `zone` FROM `zonage` WHERE `code` = :codeDest');
        $zone->execute(array('codeDest' => str_split($code_postal_destination,3)[0] ));
        $zone_destination = $zone->fetch() ['zone'];
        if(!$zone_destination){
            $postaldestErr = "Le code postal est erroné";
        }
        // $_SESSION['zone_destination'] = $zone_destination; 
        // echo $zone_destination."<br><br>";
    }

    //VERIFICATION DES AUTRES DONNEES DU FORMULAIRE DE DESTINATION
    // Vérifier si le nom est vide
    if(empty($_POST['destname'])) {
        $destnameErr = "Le nom est obligatoire";
    } else {
        $destname = test_input($_POST['destname']);
        // Vérifier si le destname ne contient que des lettres et des espaces
        if(!preg_match("/^[a-zA-Z ]*$/",$destname)) {
        $destnameErr = "Seules les lettres et les espaces sont autorisés";
        }
    }
    
    // Vérifier si l'e-maildest est vide
    if(empty($_POST['emaildest'])) {
        $emaildestErr = "L'e-mail est obligatoire";
    } else {
        $emaildest = test_input($_POST['emaildest']);
        // Vérifier si l'adresse e-mail est valide
        if(!filter_var($emaildest, FILTER_VALIDATE_EMAIL)) {
        $emaildestErr = "Adresse e-mail invalide";
        }
    }
    
    // Vérifier si le companydest est vide
    if(empty($_POST['companydest'])) {
        $companydestErr = "Le nom de l'entreprise est obligatoire";
    } else {
        $companydest = test_input($_POST['companydest']);
    }

    // Vérifier si le countrydest est vide
    if(empty($_POST['countrydest'])) {
        $countrydestErr = "Le pays ou territoire est obligatoire";
    } else {
        $countrydest = test_input($_POST['countrydest']);
    }


    // Vérifier si le houseAdressdest est vide
    if(empty($_POST['houseAdressdest'])) {
        $houseAdressdestErr = "L'adresse de destination est obligatoire";
    } else {
        $houseAdressdest = test_input($_POST['houseAdressdest']);
    }


    // Vérifier si le postaldest est vide
    if(empty($_POST['postaldest'])) {
        $postaldestErr = "Le code postal est obligatoire";
    } else {
        $postaldest = test_input($_POST['postaldest']);
    }

    // Vérifier si le citydest est vide
    if(empty($_POST['citydest'])) {
        $citydestErr = "La ville est obligatoire";
    } else {
        $citydest = test_input($_POST['citydest']);
    }

    // Vérifier si le phonedest est vide
    if(empty($_POST['phonedest'])) {
        $phonedestErr = "Le numéro de téléphone est obligatoire";
    } else {
        $phonedest = test_input($_POST['phonedest']);
    }

    // Vérifier si le provincedest est vide
    if(empty($_POST['provincedest'])) {
        $provincedestErr = "La province de destination est obligatoire";
    } else {
        $provincedest = test_input($_POST['provincedest']);
    }
    
    // Vérifier si le postnumberdest est vide
    if(!empty($_POST['postnumberdest'])) {
        $postnumberdest = test_input($_POST['postnumberdest']);
    } else {
        $postnumberdest = '';
    }

    // Vérifier si le apartmentdest est vide
    if(!empty($_POST['apartmentdest'])) {
        $apartmentdest = test_input($_POST['apartmentdest']);
    } else {
        $apartmentdest = '';
    }

    // Vérifier si le phoneuser est vide
    if(empty($_POST['phoneuser'])) {
        $phoneuserErr = "Le numéro de téléphone est obligatoire";
    } else {
        $phoneuser = test_input($_POST['phoneuser']);
    }

    // Vérifier si le houseAdressuser est vide
    if(empty($_POST['houseAdressuser'])) {
        $houseAdressuserErr = "L'adresse d'expédition est obligatoire";
    } else {
        $houseAdressuser = test_input($_POST['houseAdressuser']);
    }
    
    // Vérifier si le postnumberuser est vide
    if(!empty($_POST['postnumberuser'])) {
        $postnumberuser = test_input($_POST['postnumberuser']);
    } else {
        $postnumberuser = '';
    }


    /******** REQUETE D'OBTENTION DU PRIX ******************/
    if( isset($zone_expedition) && isset($zone_destination) ) {
        $cout_total_zone[] = [];
        $allCosts = $database->prepare('SELECT * FROM `price_direct` WHERE `departZone` = :zoneDep');
        $allCosts->execute(array('zoneDep' => $zone_expedition));
        array_push($cout_total_zone, $allCosts->fetch() ['arrZone'.$zone_destination]);
            
        $allCosts = $database->prepare('SELECT * FROM `price_2hours` WHERE `departZone` = :zoneDep');
        $allCosts->execute(array('zoneDep' => $zone_expedition));
        array_push($cout_total_zone, $allCosts->fetch() ['arrZone'.$zone_destination]);
            
        $allCosts = $database->prepare('SELECT * FROM `price_midday` WHERE `departZone` = :zoneDep');
        $allCosts->execute(array('zoneDep' => $zone_expedition));
        array_push($cout_total_zone, $allCosts->fetch() ['arrZone'.$zone_destination]);
            
        $allCosts = $database->prepare('SELECT * FROM `price_nextday` WHERE `departZone` = :zoneDep');
        $allCosts->execute(array('zoneDep' => $zone_expedition));
        array_push($cout_total_zone, $allCosts->fetch() ['arrZone'.$zone_destination]);

        $_SESSION['cout_total_zone'] = $cout_total_zone;

    }


    /********* REQUETE D'ENREGISTREMENT DE L'EXPEDITION DANS LA BASE DE DONNEES */
    if (isset($destname) && isset($companydest) && isset($countrydest) && isset($houseAdressdest) && isset($postaldest) && isset($citydest) && isset($emailDest)) {
        $query = $database->prepare('INSERT INTO `shipment` (userid, houseAdressuser, phoneuser, postnumberuser, destname, companydest, countrydest, houseAdressdest, apartmentdest, postaldest, provincedest, citydest, emaildest, phonedest, postnumberdest) VALUES(
          :userid, :houseAdressuser, :phoneuser, :postnumberuser, :destname, :companydest, :countrydest, :houseAdressdest, :apartmentdest, :postaldest, :provincedest, :citydest, :emaildest, :phonedest, :postnumberdest)');
          $query->execute(array(
            'userid' => $_SESSION['userid'],
            'houseAdressuser' => $houseAdressuser,
            'phoneuser' => $phoneuser,
            'postnumberuser' => $postnumberuser,
            'destname' => $destname,
            'companydest' => $companydest,
            'countrydest' => $countrydest,
            'houseAdressdest' => $houseAdressdest,
            'apartmentdest' => $apartmentdest,
            'postaldest' => $postaldest,
            'provincedest' => $provincedest,
            'citydest' => $citydest,
            'emaildest' => $emaildest,
            'phonedest' => $phonedest,
            'postnumberdest' => $postnumberdest
          ));
        
          
          //Obtaining shipment's number in Database
          $queryNumber = $database->query('SELECT id FROM `shipment` ORDER BY id DESC LIMIT 1');
          $lastNumber = $queryNumber->fetch();
    
          $_SESSION['shipment_id'] = (int)$lastNumber['id'];

          if($query){
            header('Location: shipment-detailsPage.php');
          }
    
        
    }
    

}

?>