<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();

$response = array();

$response["ERROR"] = true;

if( isset($_POST['VOTERID'])  ) {

$voterid= $_POST["VOTERID"];





$res = $db->candidateInfo($voterid);
    
    
    if($res!=NULL){
        
        // no error , user created safely..
        // Initiate to send SMS
    
        $response["ERROR"] = false;
        $response["DATA"]=$res;
        
        
       /* $response["MESSAGE"] = "SMS request is initiated! You will be receiving it shortly.";*/

    } 

}
echo json_encode($response);
?>