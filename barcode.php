<?php
    require __DIR__ .'/vendor/autoload.php';
    use Picqer\Barcode\BarcodeGeneratorPNG;
    $generator = new BarcodeGeneratorPNG();
    $text="CTL3254126987";
    $barcode = $generator->getBarcode($text, $generator::TYPE_CODE_128);
?>

