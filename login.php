<?php
    try {
        $database = new PDO('mysql:host=localhost;dbname=continentalcourrier', 'root', '');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $pass_hache = sha1($_POST['pw']);
    $query = $database->prepare('SELECT userid, username FROM user WHERE userid = :userid AND pw = :pw');
    $query->execute(array(
    'userid' => $_POST['userId'],
    'pw' => $pass_hache));
    $result = $query->fetch();
    if (!$result)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }else
    {
        session_start();
        $_SESSION['userid'] = $result['userid'];
        $_SESSION['username'] = $result['username'];
        header('Location: shipmentPage.php');
    }
?>