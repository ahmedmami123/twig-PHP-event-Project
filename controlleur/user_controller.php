<?php 
require_once 'vendor/autoload.php';

require_once 'db/config.php' ;
require_once 'models/user.php' ;






function GetUsers($_user,$twig)  {
  
    $result=$_user->GetTousUser();
    echo $twig->render('view_user.html',array(
    'result'=>$result
    ));
}




   
?>