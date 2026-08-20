<?php
require_once '../app/autoloader/autoload.php' ;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>contact</title>
  <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
  <!-- formulaire de contact -->
  <div class="contact">
    <div>
      <h1>Besoin d'information ?</h1>
      <p>contacter nous notre equipe repond rapidement !</p>
    </div>
    <form action="" method="post">
      <label for="nom">nom</label>
      <input type="text" name="nom" id="nom" placeholder="ex: benji">

      <label for="email">email</label>
      <input type="email" name="email" id="email" placeholder="email@gmail.com">

      <label for="tel">tel</label>
      <input type="tel" name="tel" id="tel" placeholder="+243...">

      <label for="message">message</label>
      <textarea name="message" id="message" placeholder="votre message.."></textarea>

      <input type="submit" name="envoyer" value="valider">
    </form>
  </div>
  <!-- formulaire de contact -->

  <!-- separeteur -->
  <hr>
  <!-- separeteur -->
  <!-- section footer -->
  <?php
  loadFile('page','template','footer');
  ?>
  <!-- section footer -->
</body>
</html>
