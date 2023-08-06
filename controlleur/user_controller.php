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

function EditUsers($twig,$_user)  {
    $id=$_GET['id'];
    $result=$_user->getUserDetails($id);

    echo $twig->render('edituser.html',array(
        'r'=>$result
    
    ));
}
function EditUsersPost($twig,$_user)  {
    extract($_POST);

    $result=$_user->EditUser($id,$firstname,$lastname,$email,$password,$dob,$user_type);
    header('location:index.php?action=viewUsers');

  
}


   
?>