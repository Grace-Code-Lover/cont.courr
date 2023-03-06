<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <link rel="stylesheet" href="css/style2.css">
    <?php 
        include 'includes/head.php';
        session_start();
        if(isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
        }
        $_SESSION = array();
        session_destroy();
    ?>
</head>
<body>
 <div class="container">
  <div class="row  mt-3">
    <div class="col-12 col-md-10"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">person</span> <span style="color:#613818;font-weight:bold">Nouveau utilisateur</span></div>
    <div class="col-12 col-md-2"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">support_agent</span> <span style="color:#613818;font-weight:bold">+1 514 969 2223</span></div>
  </div>
  <div class="title mb-3">
      <h5>3. Bienvenu</h5>
  </div><br>
  
  <svg xmlns="http://www.w3.org/2000/svg" width="759" height="468" viewBox="0 0 759 468">
  <g id="Groupe_7" data-name="Groupe 7" transform="translate(-251 -188)">
    <text id="Bienvenu_chez_continental_Courrier_" data-name="Bienvenu chez continental Courrier!" transform="translate(252 231)" fill="#613818" font-size="40" font-family="Segoe UI Variable Text"><tspan x="0" y="0">Bienvenu chez </tspan><tspan x="0" y="53">continental Courrier!</tspan></text>
    <text id="Votre_compte_a_bien_été_créer._" data-name="Votre compte a bien été créer. " transform="translate(252 514)" fill="#613818" font-size="17" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">Votre compte a bien été créer. </tspan></text>
    <text id="Votre_ID_Utilisateur_est_lawajoel_gmail.com_." data-name="Votre ID Utilisateur est lawajoel@gmail.com ." transform="translate(252 545)" fill="#5c5d5e" font-size="17" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">Votre ID Utilisateur est</tspan><tspan y="0" xml:space="preserve" fill="#613818"> <?php echo isset($userId) ? $userId : ''; ?> </tspan><tspan y="0">.</tspan></text>
    <text id="Cliquez_ici_pour_vous_connecter." data-name="Cliquez ici pour vous connecter." transform="translate(252 580)" fill="#5c5d5e" font-size="17" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0" xml:space="preserve" fill="#613818"> <a href="loginPage.php">Cliquez ici</a></tspan><tspan y="0"><tspan y="0"> pour vous connecter.</tspan></text>
    <text id="Un_courriel_contenant_toutes_vos_informations_vous_a_été_envoyer_a_l_adresse_que_vous_avez_fourni." data-name="Un courriel contenant toutes vos informations vous a été envoyer a l&apos;adresse que vous avez fourni." transform="translate(252 614)" fill="#5c5d5e" font-size="17" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">Un courriel contenant toutes vos informations vous a été envoyer a l&apos;adresse que vous avez fourni.</tspan></text>
    <text id="Nous_souhaitons_un_excellent_séjour_chez_Nous" data-name="Nous souhaitons un excellent séjour chez Nous" transform="translate(253 682)" fill="#613818" font-size="17" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">Nous souhaitons un excellent séjour chez Nous</tspan></text>
    <text id="Validez_votre_Adresse_courriel_pour_acceder_a_votre_compte." data-name="Validez votre Adresse courriel pour acceder a votre compte." transform="translate(252 651)" fill="#5c5d5e" font-size="17" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">Validez votre Adresse courriel pour acceder a votre compte.</tspan></text>
    <path id="done_outline_FILL0_wght400_GRAD0_opsz48" d="M60.082,137.706l77.48-102.027-7.355-9.685L60.082,118.336,23.993,70.814,16.638,80.5Zm0,19.144L2.1,80.5,23.993,51.67,60.082,99.192,130.207,6.85,152.1,35.679Z" transform="translate(248.9 309.15)" fill="#613818"/>
  </g>
</svg>
 </div>
  

   <?php require_once 'includes/footer.php' ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>