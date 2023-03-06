<?php

try {
    $database = new PDO('mysql:host=localhost;dbname=continentalcourrier', 'root', '');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


    // clé d'API Google Maps
$api_key = 'AIzaSyBgWS9dEahHNfQU8f7ZSZSAt9_L3gEaUp8';
$cout_par_kilometre = 1.05;

// codes postaux d'expédition et de destination depuis le formulaire
if(isset($_POST['submit'])){
    $code_postal_expedition = $_POST['code_postal_expedition'];
    $code_postal_destination = $_POST['code_postal_destination'];


    // requête à l'API de géolocalisation de Google pour récupérer les coordonnées géographiques des codes postaux
    $urlExp = "https://maps.google.com/maps/api/geocode/json?components=country:CA|postal_code:".urlencode($code_postal_expedition)."&key=".$api_key;
    $jsonExp = file_get_contents($urlExp);
    $dataExp = json_decode($jsonExp, true);
    //echo $urlExp;

    $urlDest = "https://maps.google.com/maps/api/geocode/json?components=country:CA|postal_code:".urlencode($code_postal_destination)."&key=".$api_key;
    $jsonDest = file_get_contents($urlDest);
    $dataDest = json_decode($jsonDest, true);
    //echo $urlDest;

    // extraction des coordonnées géographiques pour chaque code postal
    $coord_expedition = $dataExp['results'][0]['geometry']['location'];
    $coord_destination = $dataDest['results'][0]['geometry']['location'];

    // calcul de la distance en kilomètres entre les coordonnées géographiques à l'aide de la formule de Haversine
    function distance_haversine($lat1, $lon1, $lat2, $lon2) {
        $R = 6371; // rayon de la Terre en kilomètres
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $R * $c;
        return $d;
    }

    $distance_en_kilometres = distance_haversine($coord_expedition['lat'], $coord_expedition['lng'], $coord_destination['lat'], $coord_destination['lng']);

    $cout_total_dist = $distance_en_kilometres*$cout_par_kilometre;  



    /************ Prix d'expedition en fonction des codes postaux et delai **************/

    //Zone d'expedition
    $zone = $database->prepare('SELECT `zone` FROM `zonage` WHERE `code` = :codeExp');
    $zone->execute(array('codeExp' => $code_postal_expedition));
    $zone_expedition = $zone->fetch() ['zone'];
    // echo $zone_expedition."<br>";

    //Zone de Destination
    $zone = $database->prepare('SELECT `zone` FROM `zonage` WHERE `code` = :codeDest');
    $zone->execute(array('codeDest' => $code_postal_destination));
    $zone_destination = $zone->fetch() ['zone'];
    // echo $zone_destination."<br><br>";

    switch ($_POST['delai']) {
        case 'direct':
            $allCosts = $database->prepare('SELECT * FROM `price_direct` WHERE `departZone` = :zoneDep');
            break;
        
        case '2h':
            $allCosts = $database->prepare('SELECT * FROM `price_2hours` WHERE `departZone` = :zoneDep');
            break;
        
        case 'midday':
            $allCosts = $database->prepare('SELECT * FROM `price_midday` WHERE `departZone` = :zoneDep');
            break;
        
        default:
            $allCosts = $database->prepare('SELECT * FROM `price_nextday` WHERE `departZone` = :zoneDep');
            break;
    }

    $allCosts->execute(array('zoneDep' => $zone_expedition));
    $cout_total_zone = $allCosts->fetch() ['arrZone'.$zone_destination];
}

?>