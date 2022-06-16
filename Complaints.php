<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();

$response = array();

$response["ERROR"] = true;

if( isset($_POST['VOTERID']) && isset($_POST['COMPLAINT_TYPE']) && isset($_POST['COMPLAINT_DESCRIPTION']) ) {

$voterid= $_POST["VOTERID"];
$complaint_type= $_POST["COMPLAINT_TYPE"];
$complaint_description= $_POST["COMPLAINT_DESCRIPTION"];






$res = $db->complaints($voterid,$complaint_type,$complaint_description);
    
    
    if($res!=NULL){
        
        // no error , user created safely..
        // Initiate to send SMS
    
        $response["ERROR"] = false;
        
        
       /* $response["MESSAGE"] = "SMS request is initiated! You will be receiving it shortly.";*/

    } 

}
echo json_encode($response);