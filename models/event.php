<?php 

class event{

    private $db;
    //constructor to initialize private to the database connection
    function __construct($conn)
    {
        $this->db=$conn;
    }
    public function getEventById($id){
        try{
            $sql="SELECT count(*) as num FROM event where id= :id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);

            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //function to insert a new record into the event database
    public function insertEvent($eventname,$description,$date_debut,$event_affiche){
try {
    // define sql statement to be executed
    $sql='INSERT INTO event (eventname,description,date_debut,event_affiche) VALUES(:evname,:descri,:d_debut,:event_affiche)';
    //prepare the sql statement to be executuin
    $stmt=$this->db->prepare($sql);
//bin all placeholders to the actual values
    $stmt->bindparam(':evname',$eventname);
    $stmt->bindparam(':descri',$description);
    $stmt->bindparam(':d_debut',$date_debut);
    $stmt->bindparam(':event_affiche',$event_affiche);



  

//execute statment
    $stmt->execute();
    return true;
} catch (PDOException $e) {
echo $e->getMessage();
return false;
}
    }
    public function GetEvent(){
        try{
            $sql="SELECT * FROM `EVENT`";
            $results=$this->db->query($sql);
            $r = $results->fetchAll(PDO::FETCH_ASSOC);
            return $r;
        }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
    }
    public function GetEventByUserid($id){
        try{
            $sql="SELECT * FROM `event` where user_id = :id";
            $stmt=$this->db->query($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
    }
    public function getEventDetails($id){
        try{
            $sql="SELECT * FROM `event` where event_id = :id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

}
public function getEventDate($date_debut){
    
        try{
            $sql="SELECT * FROM `event` where date_debut = :date";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':date',$date_debut);
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

}

public function geteventBydate($date_debut){
    try{
        $sql="SELECT count(*) as num FROM event where date_debut=$date_debut ";
        $stmt=$this->db->prepare($sql);
       

        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
    }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

public function DeleteEvent($id){
    try {
        $sql="DELETE from event where event_id=:id";
    $stmt=$this->db->prepare($sql);
    $stmt->bindparam(':id',$id);
    $stmt->execute();
    return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
public function EditEvent($id,$eventname,$description,$date_debut,$event_affiche){
    try {
        $sql="UPDATE `event` SET `eventname`=:evname,`description`=:descri,`date_debut`=:d_debut,`event_affiche`=:event_affiche WHERE event_id= :id";
        $stmt=$this->db->prepare($sql);
        //bin all placeholders to the actual values
        $stmt->bindparam(':id',$id);
    
        $stmt->bindparam(':evname',$eventname);
        $stmt->bindparam(':descri',$description);
        $stmt->bindparam(':d_debut',$date_debut);
        $stmt->bindparam(':event_affiche',$event_affiche);
        //execute statment
            $stmt->execute();
            return true;   
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
    
    }
    
}



 
?>