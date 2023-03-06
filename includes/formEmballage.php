<!DOCTYPE html>
<html lang="fr">

<?php require_once 'includes/head.php' ?>
<title>Formulaires</title>
<body>
 <div class="container">
  <div class="title">
      <h2>Product Order Form</h2>
  </div>
  <div class="title">
      <h3>1.Renseignements sur l'adresse</h3>
  </div>
   <div class="title">
      <h3>2.Informations sur le colis</h3>
  </div>
  <div class="d-flex">
  <form action="" method="">
    <label> 
      <span>Type d'emballage <span class="required">*</span></span>
    <select name="selection">
        <option value="select">Mon emballage</option>
        <option value="AFG">Enveloppe</option> 
        <option value="AFG">Boite</option> 
        <option value="AFG">Palette</option>
      </select>
    </label>
    <label>
      <span>Poids <span class="required">*</span></span>
      <input type="number" name="poid"  required>
    </label>
    <label> 
      <span>Unités <span class="required">*</span></span>
    <select name="selection">
        <option value="select">lb</option>
        <option value="AFG">kg</option> 
      </select>
    </label>
    <label>
      <span>Longuer <span class="required">*</span></span>
      <input type="number" name="city"> cm
    </label>
    <label>
      <span>Largeur <span class="required">*</span></span>
      <input type="number" name="city"> 
    </label>
    <label>
      <span>Hauteur <span class="required">*</span></span>
      <input type="number" name="city"> 
    </label>
  </form>
  </div>
    <button type="button">Place Order</button>
  <div class="title">
      <h3>3.Procéder a l'expédition</h3>
  </div>
   <div class="title">
      <h3>4.Mode de paiement</h3>
  </div>
</div>
   <?php require_once 'includes/footer.php' ?>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>