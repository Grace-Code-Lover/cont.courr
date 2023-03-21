<?php 
    session_start();
    require 'vendor/autoload.php';
    include 'barcode.php';
    use Dompdf\Dompdf;

    // Create a new instance of Dompdf
    $dompdf = new Dompdf();
    $paperSize = array(0, 0, 101.6, 152.4); // array with width and height in millimeters
    $dompdf->setPaper('A4', 'portrait');
    //$dompdf->set_option('base_path', 'F:/wamp64/www/user_connection');

    // Load HTML content
    $html = '
    <html lang="en" style="display: flex; justify-content: center; ">
<body style="position: relative; color: black; overflow: hidden; padding: 25px; margin: 5%; ">
<main style="height: 15.2cm; border: 1px solid gray; padding: 25px;">
    <section class="header" style="width: 100%; length: fit-content; margin-top: 10px; margin-bottom: 10px; border-bottom: 3px solid black;">
        <img src="https://pbs.twimg.com/profile_images/1211726311/dompdf_400x400.png" style="height: 50px;">
    </section>
    <section class="sender" style="width: 100%; length: fit-content; margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid black;">
        <p style="color: gray;">From / Exp</p>
        <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['username'].'</span>
        <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['houseAdressuser'].'</span>
        <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['postaluser'].'</span>
        <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['countryuser'].'</span>
    </section>
    <section class="receiver" style="width: 100%; length: fit-content; margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid black;  display: flex; gap: 27px;">
        <div class="receiver-info">
            <p style="color: gray;">To / Dest.:</p>
            <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['destname'].'</span>
            <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['houseAdressdest'].'</span>
            <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['postaldest'].'</span>
            <span style="display: block; text-transform: uppercase; font-weight: bolder; font-size: 17px; font-family: "Open Sans", sans-serif;">'.$_SESSION['countrydest'].'</span>
        </div>
        <div class="package-info" style="align-self: flex-end;">
            <span style="display: block; text-align:right;">'.$_SESSION['weightlb'].' lbs;</span>
            <span style="display: block; text-align:right;">'.$_SESSION['dimension'].'</span>
        </div>
    </section>
    <section class="trackingNumber" style="width: 100%; length: fit-content; margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid black; text-align: center;">
        <p><img src="data:image/png;base64,' . base64_encode($barcode) . '"></p>
        <p>CTL3254126987</p>
    </section>
    <section class="footer" style="width: 100%; length: fit-content; margin-top: 10px; margin-bottom: 10px; border-bottom: 3px solid black;">
        <span>Thank you for choosing Continental Courrier.</span>
    </section>
</main>
</body>
</html>
    ';
    $dompdf->loadHtml($html);
    
    // Render the PDF
    $dompdf->render();
    // Send HTTP headers to display PDF in browser
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline;');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    header('Accept-Ranges: none');
    header('Content-Length: ' . strlen($dompdf->output()));
    
    // Output the generated PDF to the browser
    echo $dompdf->output();
    // Save the PDF
    //$dompdf->stream(null, array('Attachment' => 0));


?>