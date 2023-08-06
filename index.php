<?php 
// require_once 'vendor/autoload.php';

// require_once 'db/config.php' ;
// require_once 'models/user.php' ;




// $loader = new \Twig\Loader\FilesystemLoader('views');

// $twig = new \Twig\Environment($loader);





//     $result=$_user->GetTousUser();

 


// echo $twig->render('view_user.html',array(
// 'result'=>$result
// ));
 require_once 'controlleur/user_controller.php' ;
$loader = new \Twig\Loader\FilesystemLoader('views');


$twig = new \Twig\Environment($loader);

 GetUsers($_user,$twig);


?>