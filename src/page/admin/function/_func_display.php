<?php
function switchPage ($quey_get) {
  switch($quey_get) {
    case 'addCard' :
      require ('./template/addCar.php') ;
      break ;
    case 'catalogue' :
      require ('./template/catalogue.php') ;
      break ;
    case 'deconnexion' :
      require ('./template/deconnexion.php') ;
    break ;
    default :
      require ('./template/addCar.php') ;
  }
}