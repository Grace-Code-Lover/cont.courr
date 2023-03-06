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
                <li><a href="signupPage.php" class="nav-link">Inscription</a></li>
                <li><a href="./loginPage.php" class="nav-link">Connexion</a></li>
                <li><a href="#" class="nav-link">A Propos</a></li>
                <li><a href="#" class="nav-link">Contact</a></li>
            </ul>
            <!-- <button class="view-work">view Work</button> -->
        </nav>

        <h1>Bienvenue sur notre site</h1>
        <h3>Inscrivez-vous ou connectez-vous si vous avez déjà un compte</h3>

        <form action="signup.php" method="post">
            <h2>Inscription</h2>
            <label for="username">Username</label> : 
            <input type="text" name="username" id="username" /><br />

            <label for="email">Email</label> : 
            <input type="text" name="email" id="email" /><br />

            <label for="pswd">Password</label> : 
            <input type="password" name="pswd" id="pswd" /><br />

            <label for="confirmPswd">Confirm Password</label> : 
            <input type="password" name="confirmPswd" id="confirmPswd" /><br />
            
            <input type="submit" value="Envoyer" />
        
        </form>

        <form action="login.php" method="post" class="loginform">
            <h2>Connexion</h2>
            <label for="username">Username</label> : 
            <input type="text" name="username" id="username" /><br />

            <label for="pswd">Password</label> : 
            <input type="password" name="pswd" id="pswd" /><br />
            
            <input type="submit" value="Envoyer" />
    
        </form>

    </main>
    
</body>
</html>