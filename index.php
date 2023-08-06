<?php 
require_once 'vendor/autoload.php';

// require_once 'db/config.php' ;
// require_once 'models/user.php' ;




$loader = new \Twig\Loader\FilesystemLoader('views');

$twig = new \Twig\Environment($loader);





//     $result=$_user->GetTousUser();

 


// echo $twig->render('view_user.html',array(
// 'result'=>$result
// ));
 require_once 'controlleur/user_controller.php' ;



 
 

  require_once 'controlleur/user_controller.php' ;
 
 
  if (isset($_GET['action'])) {
     $action = $_GET['action'];
     switch ($action) {
        case '':
        GetUsers($_user,$twig);
            break;
         case 'viewUsers':
         GetUsers($_user,$twig);
             break;
         case 'Editusers':
         EditUsers($twig,$_user);
             break;
             case 'EditusersPost':
             EditUsersPost($twig,$_user);
                 break;
     }}else{
        GetUsers($_user,$twig);
        
     }
 
 ?>