<?php 
class _user{
    private $db;
    //constructor to initialize private to the database connection
    function __construct($conn)
    {
        $this->db=$conn;
    }
    public function InsertUser($firstname,$lastname,$email,$password,$dob,$user_type,$user_Path){
        try {
            $result=$this->getUserByEmail($email);
            if($result['num']>0){
                return false;
            }
            else{
                $new_password=md5($password.$email);
    // define sql statement to be executed
    $sql='INSERT INTO user (firstname,lastname,email,password,dob,user_type,user_Path) VALUES(:fname,:lname,:email,:password,:dob,:user_type,:user_Path)';
    //prepare the sql statement to be executuin
    $stmt=$this->db->prepare($sql);
//bin all placeholders to the actual values
    $stmt->bindparam(':fname',$firstname);
    $stmt->bindparam(':lname',$lastname);
    $stmt->bindparam(':email',$email);
    $stmt->bindparam(':password',$new_password);
    $stmt->bindparam(':dob',$dob);
    $stmt->bindparam(':user_type',$user_type);
    $stmt->bindparam(':user_Path',$user_Path);




 
//execute statment
    $stmt->execute();
    return true;
            }
        
        } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
        }
    }

    //login
    
    public function GettUser($email,$password){
        try{
            
            $sql="SELECT * FROM user where email=:email and password=:password";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':password',$password);

            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function GetTousUser(){
        try{
            $sql="SELECT * FROM `user`";
            $results=$this->db->query($sql);
            $r = $results->fetchAll(PDO::FETCH_ASSOC);
            return $r;
        }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
    }
    public function EditUser($id,$firstname,$lastname,$email,$password,$dob,$user_type){
        try {
            $new_password=md5($password.$email);
            $sql="UPDATE `user` SET `firstname`=:firstname,`lastname`=:lastname,`email`=:email,`password`=:password,`dob`=:dob,`user_type`=:user_type WHERE user_id= :id";
            $stmt=$this->db->prepare($sql);
            //bin all placeholders to the actual values
            $stmt->bindparam(':id',$id);
        
            $stmt->bindparam(':firstname',$firstname);
            $stmt->bindparam(':lastname',$lastname);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':password',$new_password);
            $stmt->bindparam(':dob',$dob);
            $stmt->bindparam(':user_type',$user_type);
         
            //execute statment
                $stmt->execute();
                return true;   
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        
        }
        public function DeleteUser($id){
            try {
                $sql="DELETE from user where user_id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    public function getUserDetails($id){
        try{
            $sql="SELECT * FROM `user` where user_id = :id";
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
    public function getUserByEmail($email){
        try{
            $sql="SELECT count(*) as num FROM user where email= :email";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':email',$email);

            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getUserByidsum($id){
        try{
            $sql="SELECT count(*) as num FROM user where userid= :id";
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
    public function getUserByUser_id($id){
        try{
            $sql="SELECT * FROM user where user_id= :user_id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':user_id',$id);

            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
?>