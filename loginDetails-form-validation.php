<?php

    session_start();
    $id = $_SESSION['id'];
    $code_confirmation = $_SESSION['code_confirmation'];

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


    if(isset($_POST['submit'])) {
        //verifier l'identifiant utilisateur
        if(empty($_POST['userId'])) {
            $userIdErr = "L'Identifiant est obligatoire";
        } else {
            $userId = test_input($_POST['userId']);
            //verifier que l'identifiant demande n'est pas deja prit {
            $checkID = $database->prepare('SELECT * FROM user WHERE userId = :userId');
            $cID = $checkID->execute(array('userId' => $userId));
            $idFound = $checkID->fetch();
            if($idFound){
                $userIdErr = "Cet identifiant est déjà prit, veuillez entrer un autre !";
            }
        
        }

        if(empty($_POST['emailVerifCode'])) {
            $emailVerifCodeErr = "Veuillez entrer votre code de confirmation";
        } else{
            $emailVerifCode = test_input($_POST['emailVerifCode']);
        }

        if(isset($_POST['renvoyerEmailConfirmation'])) {
            // Renvoyer l'e-mail de confirmation
            require_once 'mailDetails.php';
            mail($email, $sujet, $message, $headers);
            $_SESSION['code_confirmation'] = $code_confirmation;
        }

        $password = test_input($_POST["pw"]);
        $cpassword = test_input($_POST["cpw"]);
        if (strlen($password) <= 8) {
            $passwordErr = "Le mot de passe doit contenir au moins 8 charactères !";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordErr = "Le mot de passe doit contenir au moins 1 Nombre !";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordErr = "Le mot de passe doit contenir au moins 1 Lettre Majuscule !";
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $passwordErr = "Le mot de passe doit contenir au moins 1 Lowercase Letter !";
        } elseif($password != $cpassword) {
            $cpasswordErr = "Mot de passe ne correspond pas";
        }elseif(empty($cpassword)){
            $cpasswordErr = "Veuillez confirmer votre mot de passe";
        }else{
            
            if(isset($password) && isset($cpassword) && isset($userId) && ($emailVerifCode == $code_confirmation)) {
                $query = $database->prepare('UPDATE user SET userId = :userId, pw = :pw, emailVerifCode = :emailVerifCode WHERE id = :id');
                $query->execute(array(
                'userId' => $userId,
                'pw' => sha1($password),
                'emailVerifCode' => $emailVerifCode,
                'id' => $id));
                $_SESSION['userId'] = $userId;
                header('Location: signUpSuccessfulPage.php');
            }
        }

        

        
    }    
?>