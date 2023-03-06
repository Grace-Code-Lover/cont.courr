<?php

    session_start();

    try {
        $database = new PDO('mysql:host=localhost;dbname=continentalcourrier', 'root', '');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Fonction pour nettoyer les données de formulaire
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //verifier les donnees de connexion
    if(isset($_POST['submit'])) {

        if(empty($_POST['userId'])) {
            $userIdErr = "Veuillez saisir votre identifiant";
        } else {
            $userId = test_input($_POST['userId']);
        }

        $password='';
        if(empty($_POST['pw'])) {
            $passwordErr = "Veuillez saisir votre mot de passe";
        } else {
            $password = test_input($_POST['pw']);
            $password = sha1($password);
        }

        $checkUser = $database->prepare('SELECT * FROM user WHERE userId = :userId');
        $cUser = $checkUser->execute(array('userId' => $userId));
        $userFound = $checkUser->fetch();
        if(!$userFound){
            $userIdErr = "Identifiant incorrecte !";     
        } else{
            if($userFound['pw'] != $password){
                $passwordErr = "Mot de passe Incorrecte !";
            }else{
                session_start();
                $_SESSION['userId'] = $userFound['userId'];
                $_SESSION['username'] = $userFound['username'];
                $_SESSION['companyuser'] = $userFound['companyuser'];
                $_SESSION['countryuser'] = $userFound['countryuser'];
                $_SESSION['houseAdressuser'] = $userFound['houseAdressuser'];
                $_SESSION['apartmentuser'] = $userFound['apartmentuser'];
                $_SESSION['postaluser'] = $userFound['postaluser'];
                $_SESSION['provinceuser'] = $userFound['provinceuser'];
                $_SESSION['cityuser'] = $userFound['cityuser'];
                $_SESSION['email'] = $userFound['email'];
                header('Location: shipmentPage.php');
            }
        }

    }

?>