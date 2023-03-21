<?php
    $code_confirmation = rand(100000, 999999);
    $sujet = "Confirmation d'ouverture de compte sur Continental Courrier";
    $message = "Bonjour $username ,\n\n";
    $message .= "Votre compte a été créé avec succès.\n\n";
    $message .= "Pour confirmer votre adresse e-mail, veuillez saisir le code de confirmation suivant dans le formulaire de confirmation :\n\n";
    $message .= "$code_confirmation\n\n";
    $message .= "Cordialement,\n";
    $message .= "L'équipe de Continental Courrier";
    $headers = "From: gracenyegue@gmail.com\r\n";
    $headers .= "Reply-To: gracenyegue@gmail.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    echo $code_confirmation;

?>