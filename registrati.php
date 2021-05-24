<?php
if(isset($_COOKIE["ID_COOKIE"])){
    header("Location: homepage.html");
    exit;
}
if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"]) && 
isset($_POST["againpassword"]))
    {
        $error = array();
        $conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 

        # PASSWORD
        if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $_POST['password'])) {
            $error[] = "Password non valida, utilizza caratteri alfanumerici e maiuscole";
        }
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti (almeno 8 caratteri)";
        } 
        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["againpassword"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $mailquery="select* from users u where u.email='".$email."'";
            $res = mysqli_query($conn,$mailquery);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }
            if (count($error) == 0) {
                $querycont="select* from users";
                $name = mysqli_real_escape_string($conn, $_POST['nome']);
                $surname = mysqli_real_escape_string($conn, $_POST['cognome']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $password = password_hash($password, PASSWORD_BCRYPT);
                $default="img/icons/av01.jpg";
                $query = "INSERT INTO users(email, password, name, avatar_image, surname) VALUES('$email', '$password', '$name', '$default', '$surname')";
                
                if (mysqli_query($conn, $query)) {
                    setcookie("ID_COOKIE",mysqli_insert_id($conn), time()+3600);
                    mysqli_free_result($res);
                    mysqli_close($conn);
                    header("Location: choseavatar.php");
                    exit;
                } else {
                    $error[] = "Errore di connessione al Database";
                }
            }
            $lenght=count($error);
            mysqli_close($conn);
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
      <img src="img/oie_6fSIBUaT0dwd.gif" id="absolute" />
      <div class="login">
        <div class="subcontainer">
          <div class="menu">
            <a href="login.php" class="registrati men">Accedi</a>
            <a href="#accedi" class="accedi men">Registrati</a>
          </div>
          <?php
    if(isset($error0))  echo "<p>Errore: Devi compilare tutti i campi</p>";
    if(isset($error)){
      for($i=0;$i<$lenght;$i++){
        echo "<p>";
        echo $error[$i];
        echo "</p>";
      }
    }
    ?>
          <form class="credenziali crede1" method="post">
            <div class="form">
              <span id="title">Nome</span>
              <input
                type="text"
                class="input"
                name="nome"
                placeholder="Inserisci qui il tuo nome"
              />
            </div>
            <div class="form">
              <span id="title">Cognome</span>
              <input
                type="text"
                class="input"
                name="cognome"
                placeholder="Inserisci qui il tuo cognome"
              />
            </div>
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
            <div class="form">
              <span id="title"> Ripeti Password</span>
              <input
                type="password"
                class="input"
                name="againpassword"
                placeholder="Inserisci qui la tua password"
              />
            </div>
            <div class="button_invio">
              <input type="submit" value="Registrati" id="button_invio_inside" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
