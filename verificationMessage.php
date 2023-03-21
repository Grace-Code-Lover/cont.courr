<?php
session_start();
$code_confirmation = $_SESSION['code_confirmation'];
    if (isset($_GET['emailVerifCode'])){
        $verifC= htmlspecialchars($_GET['emailVerifCode']);
        if($verifC != $code_confirmation){
            echo '<p style="color: red;">Code de confirmation invalide !</p>';
        }
        else {
            echo '<p style="color: green;">Code de confirmation valide !</p>'
        }
    }
?>