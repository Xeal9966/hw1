<?php

if(isset($_COOKIE["ID_COOKIE"])){
    header("Location: homepage.html");
    exit;
}

    if (!empty($_POST["email"]) && !empty($_POST["password"]) )
    {
        $conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // ID e Username per sessione, password per controllo
        $query = "SELECT id, email, password FROM users WHERE email = '$email'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        if (mysqli_num_rows($res) > 0) {
            // Ritorna una sola riga, il che ci basta perché l'utente autenticato è solo uno
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {
                setcookie("ID_COOKIE",$entry['id'], time()+3600);
                header("Location: homepage.html");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        // Se l'utente non è stato trovato o la password non ha passato la verifica
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error = "Inserisci username e password.";
    }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>GameBomb_login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/login.css" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />
  </head>
  <body>
    <div class="container">
      <img src="img/oie_6fSIBUaT0dwd.gif" id="absolute">
      <div class="login">
        <div class="subcontainer">
          <div class="menu">
            <a href="#accedi" class="accedi men">Accedi</a>
            <a href="registrati.php" class="registrati men">Registrati</a>
          </div>
          <?php
              if(isset($error)) { echo "<p>";
              echo $error;
              echo "</p>";
              }
          ?>
          <form class="credenziali crede1" method="post">
            <div class="form">
              <span id="title">E-mail</span>
              <input
                type="text"
                class="input"
                name="email"
                placeholder="Inserisci qui la tua e-mail"
              />
            </div>
            <div class="form">
              <span id="title">Password</span>
              <input
                type="password"
                class="input"
                name="password"
                placeholder="Inserisci qui la tua password"
              />
            </div>
            <div class="button_invio">
            <input type="submit" value="Accedi" id="button_invio_inside">
          </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
