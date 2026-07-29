<?php
define('ROOT_PATH', dirname(__DIR__, 2)) ;

function loadFile($folder = null, $scFolder = null, $file = null) {
  $path = ROOT_PATH . DIRECTORY_SEPARATOR . $folder 
  . DIRECTORY_SEPARATOR . $scFolder . DIRECTORY_SEPARATOR . 
  $file . '.php' ;

  if(file_exists($path)) {
     require $path ;
  }else {
    echo 'fichier non trouver' ;
  }
}