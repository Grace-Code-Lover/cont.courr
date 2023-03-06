<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css">
    
    <title>User Connection</title>
</head>
<body>
    <main>
        <nav>
            <ul class="navigation">
                <li><a href="#" class="nav-link">Inscription</a></li>
                <li><a href="deconnexion.php" class="nav-link">Deconnexion</a></li>
                <li><a href="#" class="nav-link">A Propos</a></li>
                <li><a href="#" class="nav-link">Contact</a></li>
            </ul>
        </nav>


        <?php
            session_start();
            if (isset($_SESSION['userid']) AND isset($_SESSION['username']))
            {
                ?> <h1 style="margin:auto;"><?php echo 'Bonjour ' ?> <span style="color:blue;"><?php echo  $_SESSION['username'] ?></span> <?php echo ' votre identifiant est ' . $_SESSION['userid']; ?> </h1> <?php
            }
        ?>

    </main>
</body>
</html>
    