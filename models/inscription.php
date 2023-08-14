<?php 
class inscri{
    private $db;
    //constructor to initialize private to the database connection
    function __construct($conn)
    {
        $this->db=$conn;
    }

public function GetTousReservation($id){
    try{
        $sql="SELECT * FROM `inscription`, `user`, `event` WHERE `inscription`.`user_id`=`user`.`user_id` && `inscription`.`event_id`=`event`.`event_id` && `inscription`.`event_id`=$id";
        $stmt=$this->db->query($sql);
        // $stmt->bindparam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $e) {
    echo $e->getMessage();
    return false;
}
}
public function GetTousReservationUser($id){
    try{
        $sql="SELECT * FROM `inscription`, `user`, `event` WHERE `inscription`.`user_id`=`user`.`user_id` && `inscription`.`event_id`=`event`.`event_id` && `inscription`.`user_id`=$id";
        $stmt=$this->db->query($sql);
        // $stmt->bindparam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $e) {
    echo $e->getMessage();
    return false;
}
}
    public function getInscriByEevnt_id($id){
        try{
         
            $sql="SELECT * FROM `inscription` where event_id=$id";
            $results=$this->db->query($sql);
            return $results;
        }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}


public function getInscriByEevnt_idUser($user_id,$event_id){
    try{
     
        $sql="SELECT * FROM `inscription` where event_id=$event_id and user_id=$user_id";
        $results=$this->db->query($sql);
        return $results;
    }catch (PDOException $e) {
    echo $e->getMessage();
    return false;
}

}
public function getUserByid($user_id){
    try{
        $sql="SELECT count(*) as num FROM inscription where user_id= :user_id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':user_id',$user_id);

        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
    }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
public function getUserEventByid($user_id,$event_id){
    try{
        $sql="SELECT count(*) as num FROM inscription where user_id= :user_id and event_id=:event_id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':user_id',$user_id);
        $stmt->bindparam(':event_id',$event_id);


        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
    }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}


public function DeleteReservation($id,$user_id){
    try {
        $sql="DELETE from inscription where inscri_id=:id and user_id=:user_id";
    $stmt=$this->db->prepare($sql);
    $stmt->bindparam(':user_id',$user_id);
    $stmt->bindparam(':id',$id);

    $stmt->execute();
    return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
public function DeleteReservationbyid($id){
    try {
        $sql="DELETE from inscription where user_id=:id";
    $stmt=$this->db->prepare($sql);
    $stmt->bindparam(':id',$id);
    $stmt->execute();
    return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
public function DeleteReservationbyinscri($id){
    try {
        $sql="DELETE from inscription where inscri_id=:id";
    $stmt=$this->db->prepare($sql);
    $stmt->bindparam(':id',$id);
    $stmt->execute();
    return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
    //function to insert a new record into the attendee database
    public function insert_inscription($user_id,$event_id){
        try {
            $result=$this->getUserEventByid($user_id,$event_id);
            if($result['num']>0){
                return false;
            }
            else{
            // define sql statement to be executed
            $sql='INSERT INTO inscription (user_id,event_id) VALUES(:user_id,:event_id)';
            //prepare the sql statement to be executuin
            $stmt=$this->db->prepare($sql);
        //bin all placeholders to the actual values
            $stmt->bindparam(':user_id',$user_id);
            $stmt->bindparam(':event_id',$event_id);
         
        
        
        
          
        
        //execute statment
            $stmt->execute();
            return true;}
        } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
        }
            }


            public function GetReservation($id){
                try{
                    $sql="SELECT * FROM `inscription` where inscri_id = $id";
                    $stmt=$this->db->query($sql);
              
                    $stmt->execute();
                    $result=$stmt->fetch();
                    return $result;
                }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            }

           
            public function Editrep($id,$rep,$valid){
                try {
                    $sql="UPDATE `inscription` SET `reponse`=:rep,`validat`=:valid WHERE inscri_id = :id";
                    $stmt=$this->db->prepare($sql);
                    //bin all placeholders to the actual values
                    $stmt->bindparam(':id',$id);
                
                  
                    $stmt->bindparam(':rep',$rep);
                    $stmt->bindparam(':valid',$valid);



                   
                    //execute statment
                        $stmt->execute();
                        return true;   
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }
                
                }
            public function GetMonReservation(){
                try{
                    $sql="SELECT * FROM `inscription`";
                    $results=$this->db->query($sql);
                    return $results;
                }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            }
            public function DelInscription($user_id,$event_id){
                try {
                    $sql="DELETE from inscription where event_id=:event_id and user_id=:user_id";
                $stmt=$this->db->prepare($sql);
                $stmt->bindparam(':user_id',$user_id);

                $stmt->bindparam(':event_id',$event_id);
                $stmt->execute();
                return true;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }
            }




}

?>