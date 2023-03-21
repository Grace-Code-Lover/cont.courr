<?php
    session_start();
    include 'barcode.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding:0;
        }
        html{
            display: flex;
            justify-content: center;
        }
        body {
            height: 90%;
            width: 30%;
            position: relative;
            color: black;
            overflow: hidden;
            padding: 25px;
            border: 1px solid gray;
            margin: 5%;
        }
        section{
            width: 100%;
            length: fit-content;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .header img {
            height: 50px;
        }
        .header, .footer{
            border-bottom: 3px solid black;
        }
        .sender, .receiver, .trackingNumber {
            border-bottom: 1px solid black;
        }
        .sender span, .trackingNumber span, .receiver-info span {
            display: block;
            text-transform: uppercase;
            font-weight: bolder;
            font-size: 17px;
            font-family: "Open Sans", sans-serif;
        }
        .sender p, .receiver-info p {
            color: gray;
        }
        .receiver {
            display: flex;
            gap: 27px;
        }
        .package-info {
            align-self: flex-end;
        }
        .package-info span{
            display: block;
            text-align:right;
        }
        .trackingNumber{
            text-align: center;
        }
        .submit {
            width: 30%;
            float: right;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: #5c5d5e;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            text-align:center;
        }
        .submit:hover {
            cursor: pointer;
            background: #613818;
        }
        
        
    </style>
</head>
<body>
<main>
    <section class="header">
        <img src="continental.png" alt="Continental Courrier">
    </section>
    <section class="sender">
        <p>From / Exp</p>
        <span><?= $_SESSION['username'] ?></span>
        <span><?= $_SESSION['houseAdressuser'] ?></span>
        <span><?= $_SESSION['postaluser'] ?></span>
        <span><?= $_SESSION['countryuser'] ?></span>
    </section>
    <section class="receiver">
        <div class="receiver-info">
            <p>To / Dest.:</p>
            <span><?= $_SESSION['destname'] ?></span>
            <span><?= $_SESSION['houseAdressdest'] ?></span>
            <span><?= $_SESSION['postaldest'] ?></span>
            <span><?= $_SESSION['countrydest'] ?></span>
        </div>
        <div class="package-info">
            <span><?= $_SESSION['weightlb'] ?> lbs;</span>
            <span><?= $_SESSION['dimension'] ?></span>
        </div>
    </section>
    <section class="trackingNumber">
        <p><?php  echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($text, $generator::TYPE_CODE_128)) . '">'; ?></p>
        <p>CTL3254126987</p>
    </section>
    <section class="footer">
        <span>Thank you for choosing Continental Courrier.</span>
    </section>
</main>
</body>
<a class="submit" href="labelPDF.php">Imprimer</a>
</html>