<?php 
require_once 'vendor/autoload.php';
require_once 'session.php';

require_once 'db/config.php' ;
require_once 'models/user.php' ;
function Register($twig)  {
  
    
    echo $twig->render('register.html',array(
    
    ));
}
function Nav($twig,$_user)  {
  if(!isset($_SESSION['user_id'])){
    echo $twig->render('nav.html',array(
        'aff'=>0,
      
            ));
  }
else{
        
        $user_id=$_SESSION['user_id'];
        $result=$_user->getUserDetails($user_id);
        echo $twig->render('nav.html',array(
    'aff'=>1,
    'r'=>$result
        ));
 }
   
    
   
}
function RegisterPost($_user, $twig)  {
    if(isset($_POST['submit'])){
    
        $fname=$_POST['firstname'];
        $lname=$_POST['lastname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $dob=$_POST['dob'];
        $user_type=$_POST['user_type'];
        $orig_file = $_FILES["avatar"]["tmp_name"];
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'UploadsUserPath/';
        if($orig_file!=null){
            $UploadsUserPath = "$target_dir$email.$ext";

        }else{
            $UploadsUserPath =null;
          

        }

        move_uploaded_file($orig_file,$UploadsUserPath);}
    $result=$_user->InsertUser($fname,$lname,$email,$password,$dob,$user_type,$UploadsUserPath);
//     header('location:index.php?action=Register');
// echo "Votre compte a été créé avec succès";

if($result){
echo $twig->render('Login.html',array(
  'r'=>1,
    'msg'=>"Votre compte a été créé avec succès"

));
}else{
    echo $twig->render('register.html',array(
        'r'=>0,
          'msg'=>"error"
      
      ));
}
}
    

  

    function Login($twig)  {
  
    
        echo $twig->render('Login.html',array(
        
        ));
    }




    




     
        function LoginPost($_user,$twig){
            $email = strtolower(trim($_POST['email']));
        $password = $_POST['password'];

            $new_password = md5($password.$email);
            $result = $_user->GettUser($email,$new_password);
            if(!$result){
                echo $twig->render('Login.html',array(
                    'msg'=>"Email or Password incorrect",
                    'r'=>1
        
                ));
            }
            else
            {
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $result['user_id'];
            $id=$_SESSION['user_id'];
            $result=$_user->getUserDetails($id);

            // echo $twig->render('viewsingle.html',array(
            // //     'r'=>$result
            
            // // ));
            header('location:index.php?action=viewsingle&id='.$id);
            }
        }
     
     
     
     
     
     
        function Logout($twig)  {
            session_destroy();
    
            header('location:index.php?action=Login');

        }
    
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
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
function EditUsersPost($_user)  {
    extract($_POST);

    $result=$_user->EditUser($id,$firstname,$lastname,$email,$password,$dob,$user_type);
    header('location:index.php?action=viewUsers');

  
}

function GetUserdetail($twig,$_user)  {

    $id=$_GET['id'];
    $result=$_user->getUserDetails($id);

    echo $twig->render('viewsingle.html',array(
        'r'=>$result
    
    ));
}
function GetUserdetailProfil($twig,$_user)  {
    
    $id=$_SESSION['user_id'];
    $result=$_user->getUserDetails($id);

    echo $twig->render('viewsingle.html',array(
        'r'=>$result
    
    ));
}

function DeleteUser($_user)  {
    $id=$_GET['id'];

    $result=$_user->DeleteUser($id);
    header('location:index.php?action=viewUsers');

  
}
   
?>