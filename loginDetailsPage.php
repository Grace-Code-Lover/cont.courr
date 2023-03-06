<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style2.css">
    <?php 
        include 'includes/head.php'; 
        include 'loginDetails-form-validation.php';
    ?>
</head>
<body>
 <div class="container">
  <div class="row  mt-3">
    <div class="col-12 col-md-10"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">person</span> <span style="color:#613818;font-weight:bold">Nouveau utilisateur</span></div>
    <div class="col-12 col-md-2"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">support_agent</span> <span style="color:#613818;font-weight:bold">+1 514 969 2223</span></div>
  </div>
  <div class="title mb-3">
      <h5>2. informations de connexion</h5>
  </div><br>
  
  <span style="color:#613818">ID Utilisateur</span>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="section1">
        <label>
          <span>ID Utilisateur<span class="required">*</span></span>
          <input type="text" name="userId" >
          <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($userIdErr) ? $userIdErr : ''; ?></span>
        </label>
        <label>
          <span>Mot de passe</span>
          <input type="password" name="pw">
          <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($passwordErr) ? $passwordErr : ''; ?></span>
        </label>
        <label>
          <span>Confirmation de mot de passe</span>
          <input type="password" name="cpw">
          <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($cpasswordErr) ? $cpasswordErr : ''; ?></span>
        </label><br><br>
        <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" required>
        <label for="vehicle2"> J'ai lu et compris les Conditions d'utilisation de Continentalcourrier.ca et j'accepte de m’y conformer. Je comprends en outre comment  Continental courrier entend utiliser les renseignements que je lui ai fournis, 
        en conformité avec la Politique de sécurité et de confidentialité. </label><br>
        <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat" required>
        <label for="vehicle3">M'envoyer les mises à jour de Continental Courrier sur les promotions 
        et les renseignements importants (vous pouvez vous désinscrire à tout moment).</label><br><br> 
        <br>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <span>Annuler</span>
        </div>
        <div class="col-12 col-md-6">
          <!-- <input type="submit" class="submit" name="submit" value="Poursuivre" onclick="javascript: form.action='compte2.php';"/><br><br> -->
          <input type="submit" class="submit" name="submit" value="Poursuivre"/><br><br>
        </div>
      </div>
  </div>
 </form>
  

   <?php 
        require_once 'includes/footer.php';
        // header('Location: ./authSuccessRegister') 
        
    ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>