
<?php 
require_once 'vendor/autoload.php';
require_once 'session.php';

require_once 'db/config.php' ;
require_once 'models/event.php' ;


function AddEvent($twig)  {
  
    
    echo $twig->render('AddEvent.html',array(
    
    ));
}function viewcal($twig)  {
  
    
    echo $twig->render('cal.html',array(
    
    ));
}


function AddEventPost($event, $twig){
    if(isset($_POST['submit'])){
    
        $eventname=$_POST['eventname'];
        $description=$_POST['description'];
        
        $date_debut=$_POST['d_debut'];
        $orig_file = $_FILES["avatar"]["tmp_name"];
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'Uploads/';
        if($orig_file!=null){
            $event_affiche = "$target_dir$date_debut.$ext";

        }else{
            $event_affiche =null;
          

        }

        move_uploaded_file($orig_file,$event_affiche);

        
    
       
    $result=$event->insertEvent($eventname,$description,$date_debut,$event_affiche);
   
    
        if($result){
            echo $twig->render('AddEvent.html',array(
                'r'=>1,
                  'msg'=>"événement  ajouté avec succès",
                  
              
              ));
        
        
        }
       
    }

}




function GetEvents($event,$twig,$_user)  {
    $result=$event->GetEvent();
    if(isset($_SESSION['userid'])){
    $id=$_SESSION['user_id'];
    $result1=$_user->getUserByUser_id($id);
    echo $twig->render('view_event.html',array(
        'u'=>$result1
        ));}
      echo $twig->render('view_event.html',array(
      'result'=>$result,
      
      
      ));
  }



  function EditEvents($twig,$event)  {
    $id=$_GET['id'];
    $result=$event->getEventDetails($id);

    echo $twig->render('EditEvent.html',array(
        'r'=>$result
    
    ));
}
  

function EditEventPost($event)  {
    extract($_POST);

    $result=$event->EditEvent($id,$eventname,$description,$date_debut,$event_affiche);
    header('location:index.php?action=EditEvent&id='.$id);

  
}
function DeleteEvent($event)  {
    $id=$_GET['id'];

    $result=$event->DeleteEvent($id);
    header('location:index.php?action=ViewEvent');

  
}
function  GetEventsDate($event,$twig,$_user){
      if(isset($_POST['submit'])){
        $datee=$_POST['dob'];
        
        // $search=$event->geteventBydate($date_debut);
        $date=$event->getEventDate($datee);
        if($date){

        echo $twig->render('AddEvent.html',array(
    'd'=>$date,
    's'=>1
        ));
        }else{
            echo $twig->render('AddEvent.html',array(
                'd'=>$datee,
                's'=>2
                    ));
        }
        }
}
function  GetEventsclander($event,$twig,$_user){
    if(isset($_POST['submit'])){
      $datee=$_POST['dob'];
      echo 'hhhhhhh' ,$datee;
      // $search=$event->geteventBydate($date_debut);
    //   $date=$event->getEventDate($datee);
      
//       if($date){
// //           echo $twig->render('../../views/calendar/index.html
// // ',array(
// //               'd'=>$datee,
            
// //                   ));
//     // header('location:index.php?action=viewUsers');

//       }
      }
}
function GetEventdetail($twig,$event,$_user,$inscri)  {
    $id=$_GET['id'];
    $result=$event->getEventDetails($id);
    
    $user_id=$_SESSION['user_id'];
    $rt=$inscri->getUserEventByid($user_id,$id); 
if($rt['num']<=0){
    $rt1=0;
}
else{
    $rt1=1;
}
    $rt2=$_user->getUserByUser_id($user_id);

    echo $twig->render('viewEventsDetail.html',array(
        'r'=>$result,
        'rt'=>$rt1,
        'rt2'=>$rt2
    
    ));
}

    
?>
