<?php
if(!isset($_GET['titolo'])){
  header("Location: homepage.html");
  exit;
}
$conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
$var = mysqli_real_escape_string($conn,$_GET['titolo']);
$query="SELECT* from games g where g.name='".$var."'";
$res = mysqli_query($conn, $query);
$entry = mysqli_fetch_assoc($res);
$id_game=$entry['id_game'];
$query = "SELECT voto, nome
FROM games join recensore join recensione 
WHERE id_game=gioco and id_editore=editor and name='".$var."'";
$res2 = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>



<!DOCTYPE html>
<html>
  <head>
    <title>GameBomb_homepage</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Scope+One&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/gamedetails.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/gamedetails.js" defer></script>
  </head>
  <body>
    <div class="menumobile hidden">
      <img src="img/icons/delete.png" id="delete" />
      <a href="homepage.html#novità"><span id="voce">Novità</span></a>
      <a href="homepage.html#raccolte"><span id="voce">Raccolte</span></a>
      <a href="homepage.html#offerta"><span id="voce">Promozioni</span></a>
      <a href="homepage.html#rec"><span id="voce">Recensioni</span></a>
    </div>
    <div class="overlay hidden"></div>
    <div class="navbar">
      <a href="homepage.html" class="logo_addr">
        <img src="img/cooltext384479799279327.png" class="logo"
      /></a>
      <div class="mobile">
        <img src="img/icons/burger 1.svg" id="burger" />
        <img src="img/cooltext384480893474897.png" id="logomobile" />
      </div>
      <div class="menu">
        <a href="homepage.html#novità"><span id="voce">Novità</span></a>
        <a href="homepage.html#raccolte"><span id="voce">Raccolte</span></a>
        <a href="homepage.html#offerta"><span id="voce">Promozioni</span></a>
        <a href="homepage.html#rec"><span id="voce">Recensioni</span></a>
      </div>
      <div class="container">
          <img
            src="img/icons/add_shopping_cart_white_24dp.svg"
            id="icon_cart"
          />
        <a href="#account"
          ><img src="img/icons/av01 1.png" id="log" style="margin-right: 10px"
        /></a>
        <div class="account hidden">
          <img src="img/icons/av04.jpg" id="log1" />
          <span style="padding-bottom: 30px">Davie504</span>
          <a href="choseavatar.php"
            ><div id="ab">
              <img
                src="img/icons/Vector1.png"
                style="width: 16px; height: 16px"
              />
              <span class="write">Modifica Avatar</span>
            </div></a
          >
          <a href="#esci" id="esci"><span id="ab" class="write">Esci</span></a>
        </div>
      </div>
    </div>
    <div class="full-container">
      <div class="section">
          <?php
          echo '<img src=';
          echo $entry['main_image'];
          echo ' class="copertina">';
          ?>
        <div class="gamebox">
          <?php
          echo '<img src=';
          echo $entry['main_image'];
          echo ' id="main">';
          ?>
          <div class="description">
          <?php
          echo '<h2>';
          echo $entry['name'];
          echo '</h2>';
          ?>
          <div id="infoes">
          <?php
          echo '<span>';
          echo 'Data:    ';
          echo $entry['realese_date'];
          echo '</span>';

          echo '<span>';
          echo 'Genere:    ';
          echo $entry['genre'];
          echo '</span>';

          echo '<span>';
          echo 'ESRB:    ';
          echo $entry['esrb_rating'];
          echo '</span>';
          ?>
          </div>
          <?php
          echo '<h3>';
          echo '€ ';
          echo $entry['prezzo'];
          echo '</h3>';
          ?>
          <div class="bottone">
          <img src="img/icons/cart-white.png" alt="">
          <span>Aggiungi</span>
          <div class="anim hidden">
            <span>Aggiunto</span>
          </div>
          </div>
          </div>
        </div>

          <div id="recensioni"> 
            <span style="margin-bottom: 50px;">Tutte le Recensioni</span>
            <div class="blocchi">
              <?php
              while($row=mysqli_fetch_object($res2)){
                echo '<div class="recbox">';

                echo '<span class="voto">';
                echo $row->voto;
                echo '/10';
                echo '</span>';

                echo '<span>';
                echo 'by ';
                echo $row->nome;
                echo '</span>';

                echo '</div>';
                }

                mysqli_close($conn);
              ?>
            </div>
          </div>
        <div class="footer">
          <div id="credit">
            <div>
              <span>Sollami</span>
              <span>Gabriele Maria</span>
              <span>n.m. O46002082</span>
              <span>Web Programming</span>
              <span>Ing. Informatica</span>
            </div>
            <div id="cen">
              <span>Condizioni di Vendita</span>
              <span>Pagamento Sicuro</span>
              <span>Informazioni sulla Privacy</span>
            </div>
            <img src="img/footer/Frame 33.png" id="euro" />
          </div>
          <div id="credit2">
            <div id="social">
              <img src="img/footer/Vector.png" alt="" />
              <img src="img/footer/Vector (1).png" alt="" />
              <img src="img/footer/Vector (2).png" alt="" />
            </div>
          </div>
          <div id="credit">
            <img src="img/footer/aaa.png" alt="" />
            <img src="img/footer/Frame 29.png" id="pay" />
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
