<?php 
require_once 'vendor/autoload.php';
include_once 'session.php';
require_once 'controlleur/user_controller.php' ;
require_once 'controlleur/event_controlleur.php' ;
require_once 'controlleur/reservation.php' ;






$loader = new \Twig\Loader\FilesystemLoader('views');

$twig = new \Twig\Environment($loader);




 
 
  require_once 'controlleur/user_controller.php' ;
 
  Nav($twig,$_user);
  if (isset($_GET['action'])) {
     $action = $_GET['action'];
     switch ($action) {
      /*--------------------------------------------------------------------------
      --------------------------------------users---------------------------------
      ---------------------------------------------------------------------------*/
         case 'viewUsers':
         GetUsers($_user,$twig);
         break;
         case 'Editusers':
         EditUsers($twig,$_user);
         break;
         case 'EditusersPost':
         EditUsersPost($_user);
         break;
         case 'viewsingle':
         GetUserdetail($twig,$_user);
         break;
         case 'viewProfil':
            GetUserdetailProfil($twig,$_user);
            break;
         case 'DeleteUser':
         DeleteUser($_user);
         break;
         case 'Register':
         Register($twig);
         break;
         case 'RegisterPost':
         RegisterPost($_user,$twig);
         break;
         case 'Login':
         Login($twig);
         break;
         case 'LoginPost':
         LoginPost($_user,$twig);
         break;
         case 'LogOut':
         Logout($twig);
         break;

           /*--------------------------------------------------------------------------
      --------------------------------------Evénement---------------------------------
      ---------------------------------------------------------------------------*/
      case 'AddEvent':
         AddEvent($twig);
         break;
         case 'AddEventPost':
            AddEventPost($event, $twig);
            break;
            case 'ViewEvent':
               GetEvents($event,$twig,$_user);
               break;
               case 'GetEventDate':
                  GetEventsDate($event,$twig,$_user);
                  break;
                  case 'GetEventcaln':
                     GetEventsclander($event,$twig,$_user);
                     break;
                     case 'viewcal':
                        viewcal($twig)  ;
  
                        break;
               case 'EditEvent':
                  EditEvents($twig,$event);
                  break;
                  case 'EditEventPost':
                     EditEventPost($event) ;
                     break;
                     case 'DeleteEvent':
                        DeleteEvent($event) ;
                        break;
                        case 'ViewEventDet':
                           GetEventdetail($twig,$event,$_user,$inscri)  ;
                           break;
  /*--------------------------------------------------------------------------
      --------------------------------------Reservation---------------------------------
      ---------------------------------------------------------------------------*/

                           case 'Reservation':
                              Reservation($inscri, $twig) ;
                              break;
                              case 'DeleteReservation':
                                 DeleteReservation($inscri) ;
                                 break;
                                 case 'ViewReservation':
                                    ViewReservation($twig,$inscri) ;
                                    break;
                                    case 'ViewReservationUser':
                                       ViewReservationProfil($twig,$inscri) ;
                                       break;
                                    case 'Editres':
                                       Editres($inscri) ;
                                       break;
                                       case 'deleteres':
                                          deleteres($inscri) ;
                                          break;
                                          case 'deleteresProfil':
                                             deleteresProfil($inscri) ;
                                             break;
                                 
     }}else{
      Register($twig);
      //   echo $_SESSION['user_id'];
        
     }
 
 ?>