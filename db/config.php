<?php 
$host ='127.0.0.1';
$db='event_db';
$user='root';
$pass='';
$charset='utf8mb4';
$dsn="mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo=new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    throw new PDOException($e->getMessage());
}
require_once 'models/user.php';
require_once 'models/event.php';
require_once 'models/inscription.php';



$_user=new _user($pdo);
$event= new event($pdo);
$inscri=new inscri($pdo);



?>