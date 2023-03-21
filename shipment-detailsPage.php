<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style2.css">
    <?php
          include 'includes/head.php';
          include 'shipment-details-backend.php';
    ?>
    <style>
      input[type="radio"] + label {
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-sizing: border-box;
        display: block;
        height: 100%;
        width: 100%;
        padding: 10px 10px 30px 10px;
        cursor: pointer;
        opacity: 0.5;
        transition: all 0.5s ease-in-out;
      }

      input[type="radio"] {
        opacity: 0;
        width: 0;
        height: 0;
      }

      input[type="radio"]:active ~ label {
        opacity: 1;
      }

      input[type="radio"]:checked ~ label {
        opacity: 1;
        /* border: 1px solid #613818; */
      }

      span[id="echo1"], span[id="echo2"]{
        width: fit-content;
      }
    </style>
    <script>
        function echoInputValue(){
          var inputValue = document.querySelector("input[name=input]").value;
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("echo1").innerHTML = this.responseText;
                  document.getElementById("echo2").innerHTML = this.responseText;
              }
          };
          xhttp.open("GET", "echo.php?input="+inputValue, true);
          xhttp.send();
        }
    </script>
</head>
<body>
 <div class="container">
  <div class="row mt-3">
    <div class="col-12 col-md-6"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">home_pin</span><span style="color:#613818;font-weight:bold">Expédition</span></div>
    <div class="col-12 col-md-3"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">person</span> <span style="color:#613818;font-weight:bold"><?= $_SESSION['username'] ?></span></div>
    <div class="col-12 col-md-3"><span class="material-symbols-outlined"style="color:#613818;font-weight:bold">support_agent</span> <span style="color:#613818;font-weight:bold">+1 514 969 2223</span></div>
  </div>
  <div class="title">
      <h5>1. Renseignements sur l'adresse</h5>
  </div>
  <div class="title">
      <h5>2. Détail sur l'envoi</h5>
  </div>
  <div class="row">
    <div class="col-12 col-md-6">
    <h5 style="color: #613818;">Sélectionner vos options</h5> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label> 
      <span>Type d'emballage<span class="required">*</span></span>
      <select name="pack_type">
        <option value="envellope">Envellope</option>
        <option value="boite">Boite</option>
        <option value="palette">Palette</option>
        <option value="carton">Carton</option>
      </select>
    </label>
    <label>
      <span>Poids <span class="required">*</span></span>
      <input type="text" name="weight" style="width: 55px;" placeholder="0.0">
      <select name="mesure" style="width: 60px;">
        <option value="lb">lb</option>
        <option value="kg">kg</option>
      </select>
      <span class="error" style="color:red; font-style:italic; width: fit-content; font-size:12px"><?php echo isset($weightErr) ? $weightErr : ''; ?></span>
      <span>&nbsp</span>
      <span>Qté <span class="required">*</span>
      <input type="text" name="quantity" style="width: 30px;" placeholder="01">
    </label>
    <label>
      <span class="fname">Valeur</span>
      <input type="text" name="input"  placeholder="$0.00" oninput="echoInputValue()">
    </label> 
    </div>
    <div class="col-12 col-md-6">
        <h5 style="color: #613818;">Adresse du destinataire</h5> 
    <label>
      <span class="fname">Longueur <span class="required">*</span></span>
      <input type="text" name="longueur"  value="35"> cm
      <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($longueurErr) ? $longueurErr : ''; ?></span>
    </label>
    <label>
      <span class="lname">Largeur <span class="required">*</span></span>
      <input type="text" name="largeur"  value="15"> cm
      <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($largeurErr) ? $largeurErr : ''; ?></span>
    </label>
    <label>
      <span class="lname">Hauteur <span class="required">*</span></span>
      <input type="text" name="hauteur"  value="20"> cm
      <span class="error" style="color:red; font-style:italic; display:block; width: 500px; font-size:12px"><?php echo isset($hauteurErr) ? $hauteurErr : ''; ?></span>
    </label>
    </div>
  </div><br>
  <div class="section1">
  <input type="checkbox" id="covered" name="covered" value="YES">
  <label for="covered"> <h5 style="color: #613818;">Protection contre les pertes et les dommages (Valeur déclarée)</h5> 
  Nous pouvons vous couvrir à hauteur de 50 CAD sans frais supplémentaire. </label><br>
  <input type="checkbox" id="lithiumBatt" name="lithiumBatt" value="<?php echo isset($_POST['input']) ? (float)$_POST['input']*0.1 : ''; ?>">
  <label for="lithiumBatt"> Batteries au lithium incluses (+<span id="echo1"></span>$) Toutes les piles </label><br>
  <input type="checkbox" id="signature" name="signature" value="<?php echo isset($_POST['input']) ? (float)$_POST['input']*0.1 : ''; ?>">
  <label for="signature">Options de signature (+<span id="echo2"></span>$) Vérifier la livraison de cet envoi.</label><br><br>
  </div>
   <span>Sélectionner le type de livraison</span>
   <div class="row">
   <div class="col-6 col-md-3">
   <input type="radio" name="delai" id="delai_1" value="<?= "Le lendemainX".$_SESSION['cout_total_zone'][4] ?>">
    <label for="delai_1">
      <svg xmlns="http://www.w3.org/2000/svg" width="131" height="114" viewBox="0 0 131 114">
        <g id="Groupe_1" data-name="Groupe 1" transform="translate(-342 -540)">
          <text id="_15" data-name="$15" transform="translate(349 594)" fill="#613818" font-size="50" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">$<?= $_SESSION['cout_total_zone'][4] ?></tspan></text>
          <path id="early_on_FILL0_wght400_GRAD0_opsz48" d="M34.5,42a5.5,5.5,0,0,1-3.9-9.375,5.493,5.493,0,0,1,7.8,0A5.488,5.488,0,0,1,34.5,42Zm-1-13.5V25h2v3.5Zm0,19.5V44.5h2V48Zm7.3-16.4-1.4-1.45,2.5-2.5,1.45,1.4ZM27.05,45.35l-1.4-1.4,2.5-2.45,1.4,1.35ZM42.5,37.5v-2H46v2ZM23,37.5v-2h3.5v2Zm18.95,7.85-2.5-2.55,1.4-1.4,2.5,2.5ZM28.1,31.55,25.65,29.1l1.4-1.45,2.45,2.5ZM9,44a2.878,2.878,0,0,1-2.1-.9A2.878,2.878,0,0,1,6,41V10a2.878,2.878,0,0,1,.9-2.1A2.878,2.878,0,0,1,9,7h3.25V4H15.5V7h17V4h3.25V7H39a2.878,2.878,0,0,1,2.1.9A2.878,2.878,0,0,1,42,10v9.5H9V41h8.5v3ZM9,16.5H39V10H9Zm0,0v0Z" transform="translate(336 606)" fill="#613818"/>
          <text id="Le_lendemain" data-name="Le lendemain" transform="translate(387 624)" fill="#5c5d5e" font-size="18" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">Le</tspan><tspan x="0" y="24">lendemain</tspan></text>
        </g>
      </svg>
    </label>
   </div> 
   <div class="col-6 col-md-3">
   <input type="radio" name="delai" id="delai_2" value="<?= "En après-midiX".$_SESSION['cout_total_zone'][3] ?>">
    <label for="delai_2">
      <svg xmlns="http://www.w3.org/2000/svg" width="136" height="112" viewBox="0 0 136 112">
        <g id="Groupe_2" data-name="Groupe 2" transform="translate(-503 -541)">
          <text id="_22" data-name="$22" transform="translate(527 595)" fill="#613818" font-size="50" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">$<?= $_SESSION['cout_total_zone'][3] ?></tspan></text>
          <path id="clear_day_FILL0_wght400_GRAD0_opsz48" d="M22.5,9.5V2h3V9.5Zm12.8,5.3-2.1-2.1,5.3-5.35L40.6,9.5Zm3.2,10.7v-3H46v3ZM22.5,46V38.5h3V46ZM12.65,14.75,7.4,9.5,9.5,7.4l5.3,5.3ZM38.55,40.6,33.2,35.3l2.05-2.05,5.4,5.2ZM2,25.5v-3H9.5v3ZM9.55,40.6,7.4,38.5l5.25-5.25,1.1,1,1.1,1.05ZM24,36A11.95,11.95,0,0,1,12,24,11.95,11.95,0,0,1,24,12,11.95,11.95,0,0,1,36,24,11.95,11.95,0,0,1,24,36Zm0-3a8.963,8.963,0,0,0,9-9,8.963,8.963,0,0,0-9-9,8.963,8.963,0,0,0-9,9,8.963,8.963,0,0,0,9,9ZM24,24Z" transform="translate(501 607)" fill="#613818"/>
          <text id="En_apres-midi" data-name="En apres-midi" transform="translate(551 624)" fill="#5c5d5e" font-size="18" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">En</tspan><tspan x="0" y="24">apres-midi</tspan></text>
        </g>
      </svg>
    </label>
   </div>
   <div class="col-6 col-md-3">
   <input type="radio" name="delai" id="delai_3" value="<?= "En 2 heursX".$_SESSION['cout_total_zone'][2]?>">
    <label for="delai_3">
      <svg xmlns="http://www.w3.org/2000/svg" width="114" height="112" viewBox="0 0 114 112">
        <g id="Groupe_3" data-name="Groupe 3" transform="translate(-678 -542)">
          <text id="_36" data-name="$36" transform="translate(699 596)" fill="#613818" font-size="50" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">$<?= $_SESSION['cout_total_zone'][2]?></tspan></text>
          <path id="nest_clock_farsight_analog_FILL0_wght400_GRAD0_opsz48" d="M29.6,32.9l-7.1-7.1V16h3v8.55l6.2,6.2ZM22.5,11.5V7h3v4.5Zm14,14v-3H41v3ZM22.5,41V36.5h3V41ZM7,25.5v-3h4.5v3ZM24,44a19.352,19.352,0,0,1-7.75-1.575A20.15,20.15,0,0,1,5.575,31.75a19.978,19.978,0,0,1,0-15.55,19.988,19.988,0,0,1,4.3-6.35A20.5,20.5,0,0,1,16.25,5.575a19.978,19.978,0,0,1,15.55,0A19.969,19.969,0,0,1,42.425,16.2a19.978,19.978,0,0,1,0,15.55,20.5,20.5,0,0,1-4.275,6.375,19.988,19.988,0,0,1-6.35,4.3A19.475,19.475,0,0,1,24,44Zm.05-3a16.3,16.3,0,0,0,12-4.975A16.483,16.483,0,0,0,41,23.95a16.342,16.342,0,0,0-4.95-12A16.4,16.4,0,0,0,24,7a16.424,16.424,0,0,0-12.025,4.95A16.359,16.359,0,0,0,7,24a16.383,16.383,0,0,0,4.975,12.025A16.441,16.441,0,0,0,24.05,41ZM24,24Z" transform="translate(674 608)" fill="#613818"/>
          <text id="En_2_heures" data-name="En 2 heures" transform="translate(722 625)" fill="#5c5d5e" font-size="18" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">En</tspan><tspan x="0" y="24">2 heures</tspan></text>
        </g>
      </svg>
    </label>
   </div>
   <div class="col-6 col-md-3">
   <input type="radio" name="delai" id="delai_4" value="<?= "En DirectX".$_SESSION['cout_total_zone'][1] ?>" checked>
    <label for="delai_4">
      <svg xmlns="http://www.w3.org/2000/svg" width="101" height="114" viewBox="0 0 101 114">
        <g id="Groupe_4" data-name="Groupe 4" transform="translate(-854 -542)">
          <text id="_55" data-name="$55" transform="translate(865 596)" fill="#613818" font-size="50" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">$<?= $_SESSION['cout_total_zone'][1] ?></tspan></text>
          <path id="departure_board_FILL0_wght400_GRAD0_opsz48" d="M40,16.35l1.25-1.25-3.8-3.8V5.2H35.7v6.55ZM12.3,34.4a2.75,2.75,0,1,0-1.95-4.7,2.75,2.75,0,0,0,1.95,4.7Zm15.4,0a2.732,2.732,0,1,0-1.95-.8A2.654,2.654,0,0,0,27.7,34.4ZM8.45,44a1.865,1.865,0,0,1-1.15-.375,1.165,1.165,0,0,1-.5-.975v-4.2A5.092,5.092,0,0,1,4.675,36.1,7.591,7.591,0,0,1,4,32.95V13.1A5.412,5.412,0,0,1,5.225,9.525,8.106,8.106,0,0,1,9.025,7.2a26.152,26.152,0,0,1,6.6-1.075A88.851,88.851,0,0,1,25.2,6.2q-.3.75-.55,1.475a10.749,10.749,0,0,0-.4,1.525,54.839,54.839,0,0,0-11.95.225Q7.9,10.15,7,11.8H24.05a9.109,9.109,0,0,0,.125,1.5q.125.75.325,1.5H7v8.65H33.05a7.05,7.05,0,0,0,1.375.35A9.412,9.412,0,0,0,36,23.95v9a7.591,7.591,0,0,1-.675,3.15A5.092,5.092,0,0,1,33.2,38.45v4.2a1.165,1.165,0,0,1-.5.975A1.865,1.865,0,0,1,31.55,44H30.6a1.943,1.943,0,0,1-1.2-.375,1.165,1.165,0,0,1-.5-.975V39.9H11.1v2.75a1.165,1.165,0,0,1-.5.975A1.943,1.943,0,0,1,9.4,44ZM28.9,26.45h0ZM36.5,21a9.159,9.159,0,0,1-6.725-2.775A9.159,9.159,0,0,1,27,11.5a9.159,9.159,0,0,1,2.775-6.725,9.536,9.536,0,0,1,13.45,0A9.158,9.158,0,0,1,46,11.5a9.159,9.159,0,0,1-2.775,6.725A9.158,9.158,0,0,1,36.5,21ZM11.1,36.9H28.9a3.721,3.721,0,0,0,2.925-1.35A4.585,4.585,0,0,0,33,32.45v-6H7v6a4.585,4.585,0,0,0,1.175,3.1A3.721,3.721,0,0,0,11.1,36.9ZM24.05,11.8h0Z" transform="translate(850 610)" fill="#613818"/>
          <text id="En_Direct" data-name="En Direct" transform="translate(906 627)" fill="#5c5d5e" font-size="18" font-family="Segoe UI Variable Text" font-weight="600"><tspan x="0" y="0">En</tspan><tspan x="0" y="24">Direct</tspan></text>
        </g>
      </svg>
    </label>
   </div>
   </div><br>
   <input type="submit" class="submit" name="submit" value="Poursuivre"/><br><br>
  </form>
  <div class="title1 mt-3">
      <h5>3. Paiement</h5>
    </div>
    <div class="title1">
      <h5>4. Confirmation</h5>
    </div>
 </div>
  

   <?php require_once 'includes/footer.php' ?>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>