<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style2.css">
    <?php
          include 'includes/head.php';
          include 'login-form-validation.php'; 
    ?>
</head>
<body>
 <div class="container">
  <div class="row  mt-3">
    <div class="col-12 col-md-10"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">person</span> <span style="color:#613818;font-weight:bold">Nouveau utilisateur</span></div>
    <div class="col-12 col-md-2"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">support_agent</span> <span style="color:#613818;font-weight:bold">+1 514 969 2223</span></div>
  </div>
  <div class="title mb-3">
      <h5>1. S'enregistrer</h5>
  </div>
  <span>Connectez-vous en utilisant votre ID<span>
  <span>utilisateur et mot de passe.</span><br>
  
  <span style="color:#613818">Entrez vos coordonnées</span>
  <div class="section1">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="userId">Id utilisateur<span class="required">*</span>
      <input type="text" name="userId" id="userId">
      <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($userIdErr) ? $userIdErr : ''; ?></span>
    </label>
     <label for="pw">Mot de passe<span class="required">*</span>
      <input type="password" name="pw" id="pw">
      <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($passwordErr) ? $passwordErr : ''; ?></span>
    </label>
      <div class="row">
    <div class="col-12 col-md-6">
    </div>
    <div class="col-12 col-md-6">
      <input type="submit" name="submit" value="Connexion"><br>
    </div>
  </div>
  </form><br>
  </div>
 </div>
  

   <?php require_once 'includes/footer.php' ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>