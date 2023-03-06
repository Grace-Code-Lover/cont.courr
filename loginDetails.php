<?php

    session_start();
    $id = $_SESSION['id'];
    $password = sha1($_POST['pw']);

    try {
        $database = new PDO('mysql:host=localhost;dbname=continentalcourrier', 'root', '');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $query = $database->prepare('UPDATE user SET userId = :userId, pw = :pw WHERE id = :id');
    $query->execute(array(
    'userId' => $_POST['userId'],
    'pw' => $password,
    'id' => $id));
    $_SESSION['userId'] = $_POST['userId'];

    header('Location: signUpSuccessfulPage.php');

?>