<?php
function switchPage($_get) {
  switch($_get) {
    case 'add' :
      require ('./template/_add_car.php') ;
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