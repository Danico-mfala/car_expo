<?php
$dns = "mysql:host=localhost;dbname=carexpo;charset=utf8";
$user = "root" ;
$pass = "" ;
try {
  $cnx = new PDO($dns, $user, $pass);
}catch (PDOException $e) {
  echo "erreur de connexion : " . $e->getMessage();
}