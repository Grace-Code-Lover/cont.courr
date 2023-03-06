<?php
    try {
        $database = new PDO('mysql:host=localhost;dbname=continentalcourrier', 'root', '');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $query = $database->prepare('INSERT INTO user(username, companyuser, countryuser, houseAdressuser, apartmentuser, postaluser, provinceuser, cityuser, email) VALUES(
    :username, :companyuser, :countryuser, :houseAdressuser, :apartmentuser, :postaluser, :provinceuser, :cityuser, :email)');
    $query->execute(array(
    'username' => $_POST['username'],
    'companyuser' => $_POST['companyuser'],
    'countryuser' => $_POST['countryuser'],
    'houseAdressuser' => $_POST['houseAdressuser'],
    'apartmentuser' => $_POST['apartmentuser'],
    'postaluser' => $_POST['postaluser'],
    'provinceuser' => $_POST['provinceuser'],
    'cityuser' => $_POST['cityuser'],
    'email' => $_POST['email']));

    //echo 'Values : '.$_POST['username'].' - '.$_POST['companyuser'].' - '.$_POST['countryuser'].' - '.$_POST['houseAdressuser'].' - '.$_POST['apartmentuser'].' - '.$_POST['postaluser'].' - '.$_POST['provinceuser'].' - '.$_POST['cityuser'].' - '.$_POST['email'];
    
    //Obtaining user's number in Database
    $queryNumber = $database->query('SELECT id FROM user ORDER BY id DESC LIMIT 1');
    $lastNumber = $queryNumber->fetch();

    session_start();
    $_SESSION['id'] = (int)$lastNumber['id'];
    // header('Location: loginDetailsPage.php');

    //  PAGE 170
    
?>