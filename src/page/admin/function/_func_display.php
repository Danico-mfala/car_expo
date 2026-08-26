<?php
function switchPage ($quey_get) {
  switch($quey_get) {
    case 'add' :
      require ('./template/_add_car.php') ;
      break ;
    case 'delete' :
      require ('./template/_delete_car.php') ;
      break ;
    case 'edit' :
      require ('./template/_edit_car.php') ;
      break ;
    case 'all' :
      require ('./template/_all_car.php') ;
      break ;
    case 'deconnexion' :
      require ('./template/deconnexion.php') ;
    break ;
      default :
        require ('./template/_add_car.php') ;
  }
}