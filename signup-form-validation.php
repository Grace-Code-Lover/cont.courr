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
  // Vérifier si le nom est vide
  if(empty($_POST['username'])) {
    $usernameErr = "Le nom est obligatoire";
  } else {
    $username = test_input($_POST['username']);
    // Vérifier si le username ne contient que des lettres et des espaces
    if(!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $usernameErr = "Seules les lettres et les espaces sont autorisés";
    }
  }
  
  // Vérifier si l'e-mail est vide
  if(empty($_POST['email'])) {
    $emailErr = "L'e-mail est obligatoire";
  } else {
    $email = test_input($_POST['email']);
    // Vérifier si l'adresse e-mail est valide
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Adresse e-mail invalide";
    }
  }
  
  // Vérifier si le companyuser est vide
  if(empty($_POST['companyuser'])) {
    $companyuserErr = "Le nom de l'entreprise est obligatoire";
  } else {
    $companyuser = test_input($_POST['companyuser']);
  }

  // Vérifier si le countryuser est vide
  if(empty($_POST['countryuser'])) {
    $countryuserErr = "Le pays ou territoire est obligatoire";
  } else {
    $countryuser = test_input($_POST['countryuser']);
  }


  // Vérifier si le houseAdressuser est vide
  if(empty($_POST['houseAdressuser'])) {
    $houseAdressuserErr = "L'adresse est obligatoire";
  } else {
    $houseAdressuser = test_input($_POST['houseAdressuser']);
  }


  // Vérifier si le postaluser est vide
  if(empty($_POST['postaluser'])) {
    $postaluserErr = "Le code postal est obligatoire";
  }
  else {
    if(strlen($_POST['postaluser']) <= 5) {
      $postaluserErr = "Le code postal doit contenir au moins 6 charactères !";
    }
    else{
        $postaluser = test_input($_POST['postaluser']);
        //verifier que le code postal demande se ttrouve dans la zone attainte {
        $checkP = $database->prepare('SELECT `zone` FROM `zonage` WHERE `code` = :postaluser');
        $checkP->execute(array('postaluser' => str_split($postaluser,3)[0] ));
        $pFound = $checkP->fetch();
        if(!$pFound){
            $postaluserErr = "Nous n'atteignons pas encore cette zone";
        }
      }
  }

    // Vérifier si le cityuser est vide
    if(empty($_POST['cityuser'])) {
      $cityuserErr = "La ville est obligatoire";
    } else {
      $cityuser = test_input($_POST['cityuser']);
    }


    if (isset($username) && isset($companyuser) && isset($countryuser) && isset($houseAdressuser) && isset($postaluser) && isset($cityuser) && isset($email)) {
      $query = $database->prepare('INSERT INTO user(username, companyuser, countryuser, houseAdressuser, apartmentuser, postaluser, provinceuser, cityuser, email) VALUES(
        :username, :companyuser, :countryuser, :houseAdressuser, :apartmentuser, :postaluser, :provinceuser, :cityuser, :email)');
        $done = $query->execute(array(
        'username' => $username,
        'companyuser' => $companyuser,
        'countryuser' => $countryuser,
        'houseAdressuser' => $houseAdressuser,
        'apartmentuser' => test_input($_POST['apartmentuser']),
        'postaluser' => $postaluser,
        'provinceuser' => test_input($_POST['provinceuser']),
        'cityuser' => $cityuser,
        'email' => $email));
      
        //echo 'Values : '.$_POST['username'].' - '.$_POST['companyuser'].' - '.$_POST['countryuser'].' - '.$_POST['houseAdressuser'].' - '.$_POST['apartmentuser'].' - '.$_POST['postaluser'].' - '.$_POST['provinceuser'].' - '.$_POST['cityuser'].' - '.$_POST['email'];
        
        //Obtaining user's number in Database
        $queryNumber = $database->query('SELECT id,username FROM user ORDER BY id DESC LIMIT 1');
        $lastNumber = $queryNumber->fetch();

        // Envoyer l'e-mail de confirmation
        require_once 'mailDetails.php';
        mail($email, $sujet, $message, $headers);
        $_SESSION['code_confirmation'] = $code_confirmation;
        
        $_SESSION['id'] = (int)$lastNumber['id'];
        //$username = $_SESSION['username'];
      if($done && $lastNumber) {
        header('Location: loginDetailsPage.php');
      }
    }  
}





  

?>

<!-- Affichage du formulaire avec les erreurs -->
<!-- <form method="post" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Nom : <input type="text" name="nom" value="<?php //echo isset($nom) ? $nom : ''; ?>">
  <span class="error"><?php //echo isset($nomErr) ? $nomErr : ''; ?></span>
  <br><br>
  E-mail : <input type="text" name="email" value="<?php //echo isset($email) ? $email : ''; ?>">
  <span class="error"><?php //echo isset($emailErr) ? $emailErr : ''; ?></span>
  <br><br>
  Message : <textarea name="message" rows="5" cols="40"><?php //echo isset($message) ? $message : ''; ?></textarea>
  <span class="error"><?php //echo isset($messageErr) ? $messageErr : ''; ?></span>
  <br><br>
  <input type="submit" name="submit" value="Envoyer">
</form> -->