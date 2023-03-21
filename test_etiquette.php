<?php
session_start();
include 'barcode.php';
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/TCPDF-main/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Continental Courrier Inc.');
$pdf->SetTitle('Shipment Label');
$pdf->SetSubject('Shipment Label');
$pdf->SetKeywords('Shipment, Label, Continental, Courrier, Inc');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT, 0);


// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 20);

// add a page
$pdf->AddPage();

$html = '
<html lang="en" style="display: flex; justify-content: center;">
<body style="height: 90%; width: 30%; position: relative; color: black; overflow: hidden; padding: 25px; border: 1px solid gray; margin: 5%;">
<main>
    <section class="header" style="width: 100%; length: fit-content; margin-top: 10px; margin-bottom: 10px; border-bottom: 3px solid black;">
        <img src="continental.png" alt="Continental Courrier" style="height: 50px;">
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

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0, '');

// ---------------------------------------------------------
// Clean any content of the output buffer
ob_end_clean();
//Close and output PDF document
$pdf->Output(null, 'I');

//============================================================+
// END OF FILE
//===================