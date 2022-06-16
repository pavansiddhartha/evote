<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();

$response = array();

$response["ERROR"] = true;


if( isset($_POST['VOTERID']) && isset($_POST['PASSWORD']) ){

$voterid= $_POST["VOTERID"];
$password=$_POST["PASSWORD"];




$res = $db->loginUser($voterid,$password);
    
    
    if($res!=NULL){
        
        // no error , user created safely..
        // Initiate to send SMS
    
        $response["ERROR"] = false;
        //$response["ID"]=$res;
        
        
       /* $response["MESSAGE"] = "SMS request is initiated! You will be receiving it shortly.";*/

    } 

}
echo json_encode($response);
?>

    


 
