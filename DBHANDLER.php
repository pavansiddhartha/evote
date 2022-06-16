<?php

class DBHANDLER{
 private $connection;
    function __construct() {
        require_once dirname(__FILE__) . '/DBCONNECT.php';
        // opening db connection
        $db = new DBCONNECT();
        $this->connection = $db->connect();
        mysqli_set_charset($this->connection,"utf8");
    }

    private function getbase64img($imgurl){
    $img = file_get_contents(dirname(__FILE__) .$imgurl);
  
                // Encode the image string data into base64
                    $data = base64_encode($img);
                    return $data;
                // Display the output
                //echo $data;
}
private function getimgbase64($base64_string, $output_file){
        // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    //$data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $base64_string ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 

}
   public function loginUser($voterid, $pass){
           $stmt = $this->connection->prepare("SELECT voterid FROM evote_user WHERE voterid = ? and pass=?");
           $voterid=(int)$voterid;
           $stmt->bind_param("is",$voterid,$pass);

           if($stmt->execute()){
                
            $stmt->bind_result($name);
            $stmt->store_result();
            
          
                    
                    if($stmt->num_rows>0){
                        
                        // User With Same Phone exists...
                        $stmt->fetch();
                        return $voterid;
                    }else{
                        
                        // User  do not exists..
                        return null;
                        
                    }
                    
                }
            }
                




    //Creating User in the Database
    public function createuser($fname,$lname,$email,$password,$aadhar_id,$phoneno,$address,$dob){
    $response = array();
    
    $aadhar_id=(int)$aadhar_id;

    
            //ok we got RC
            //1. check previous attempts if exists delete..
            $stmt = $this->connection->prepare("INSERT INTO evote_user(fname,lname,email,pass,aadhar_id,phoneno,address,dob) values(?, ?, ?, ?, ?,?, ?, ?)");
           $stmt->bind_param("ssssssss", $fname,$lname,$email,$password,$aadhar_id,$phoneno,$address,$dob);

           if($stmt->execute()){
                $vid=$stmt->insert_id;
               //ok 
               return $vid;
           }else{
               
               return null;
           }
            
        }  
   public function candidateInfo($voterid){
       
 
       $data=array();
    $stmt = $this->connection->prepare("SELECT name,partyname,partysymbol,partydescription,candidateid,candidatebio FROM evote_candidateinfo");
    if($stmt->execute()){
     //$partysymbol=$this->getbase64img($partysymbol);    
     $stmt->bind_result($name,$partyname,$partysymbol,$partydescription,$candidateid,$candidatebio);
     $stmt->store_result();
     
   
             
             if($stmt->num_rows>0){
                 
                 // User With Same Phone exists...
                 while($stmt->fetch()){
                //$img=$this->getbase64img($imgurl);
                array_push($data,array('voterid'=>$voterid,'name'=>$name,'partyname'=>$partyname,'partysymbol'=>$partysymbol,'partydescription'=>$partydescription,'candidateid'=>$candidateid,'candidatebio'=>$candidatebio));
                 }
                 return $data;
             }else{
                 
                 // User  do not exists..
                 return 0;
                 
             }
                 
             }else{
                 
                 // no data error
             
             }
           
             
         }

         public function votes($candiadteid,$userid,$esheduleid){
            $response = array();
            
            $candiadteid=(int)$candiadteid;
            $esheduleid=(int)$esheduleid;
            $voterid=(int)$userid;
                    //ok we got RC
                    //1. check previous attempts if exists delete..
                    $stmt = $this->connection->prepare("INSERT INTO evote_votes(cid_id,eid_id,uid_id) values(?, ?, ?)");
                   $stmt->bind_param("iii",$candiadteid,$esheduleid,$userid);
        
                   if($stmt->execute()){
                        //$vid=$stmt->insert_id;
                       //ok 
                       return TRUE;
                   }else{
                       
                       return null;
                   }

         }
                   public function complaints($voterid,$complaint_type,$complaint_description){
                    $response = array();
                    
                    
                        $voterid=(int)$voterid;
                        $complaint_type=(int)$complaint_type;
                            //ok we got RC
                            //1. check previous attempts if exists delete..
                            $stmt = $this->connection->prepare("INSERT INTO evote_complaints(tid_id,description,uid_id) values(?, ?, ?)");
                           $stmt->bind_param("isi", $complaint_type,$complaint_description,$voterid);
                
                           if($stmt->execute()){
                                $vid=$stmt->insert_id;
                               //ok 
                               return $vid;
                           }else{
                               
                               return null;
                           }
                        }

                           
   public function complaintTypes($voterid){
       
 
    $data=array();
    $stmt = $this->connection->prepare("SELECT * FROM evote_complainttypes");
    

    if($stmt->execute()){
         
     $stmt->bind_result($tid,$typename);
     $stmt->store_result();
     
   
             
             if($stmt->num_rows>0){
                 
                 // User With Same Phone exists...
                 while($stmt->fetch()){
                 
                        array_push($data,array("tid"=>$tid,"name"=>$typename));
                 }
                 return $data;
             }else{
                 
                 // User  do not exists..
                 return null;
                 
             }
                 
             }else{
                 
                 // no data error
             
             }
           
             
         }


        }

            
     
                    
                    