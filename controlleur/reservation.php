<?php 
require_once 'vendor/autoload.php';
require_once 'session.php';

require_once 'db/config.php' ;
require_once 'models/inscription.php' ;



function Reservation($inscri, $twig)  {
    if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];

$id=$_GET['id'];
$result=$inscri->insert_inscription($user_id,$id);}
//     header('location:index.php?action=Register');
// echo "Votre compte a été créé avec succès";

header('location:index.php?action=ViewEventDet&id='.$id);

}
    
function DeleteReservation($inscri)  {
    $event_id=$_GET['id'];
    $user_id=$_SESSION['user_id'];

    // $result=$inscri->DeleteReservation($id,$user_id,);
    $result=$inscri->DelInscription($user_id,$event_id);
    header('location:index.php?action=ViewEventDet&id='.$event_id);

  
}


function ViewReservation($twig,$inscri)  {
  
    
    $id=$_GET['id'];
    $result=$inscri->GetTousReservation($id);
      echo $twig->render('viewReservation.html',array(
      'result'=>$result
      ));
      
}
function ViewReservationProfil($twig,$inscri)  {
  
    
    $id=$_SESSION['user_id'];
    $result=$inscri->GetTousReservationUser($id);
    echo $twig->render('viewReservationUser.html',array(
        'result'=>$result
        ));
      
}

function Editres($inscri)  {

    $id=$_GET['id'];
    $rep=$inscri->Editrep($id,'votre réservation a été accepté',1);
    $event=$inscri->GetReservation($id);
    echo $event['event_id'];
$event_id=$event['event_id'];
    header('location:index.php?action=ViewReservation&id='.$event_id);

  
}
function deleteres($inscri)  {

    $id=$_GET['id'];
    $event=$inscri->GetReservation($id);
    echo $event['event_id'];
    $rep=$inscri->DeleteReservationbyinscri($id);
    
$event_id=$event['event_id'];
    header('location:index.php?action=ViewReservation&id='.$event_id);

  
}
function  deleteresProfil($inscri){

    $id=$_GET['id'];
    $user=$inscri->GetReservation($id);
    $rep=$inscri->DeleteReservationbyinscri($id);
    
$user_id=$user['user_id'];
    header('location:index.php?action=ViewReservationUser&id='.$user_id);

  
}
?>