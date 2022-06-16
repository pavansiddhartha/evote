<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();

$response = array();

$response["ERROR"] = true;

if( isset($_POST['VOTERID']) && isset($_POST['CANDIDATEID']) && isset($_POST['ESCHEDULEID'])  ) {

$voterid= $_POST["VOTERID"];
$candidateid= $_POST["CANDIDATEID"];





$res = $db->votes($voterid,$candidateid,$_POST['ESCHEDULEID']);
    
    
    if($res!=NULL){
        
        // no error , user created safely..
        // Initiate to send SMS
    
        $response["ERROR"] = false;
        
        
       /* $response["MESSAGE"] = "SMS request is initiated! You will be receiving it shortly.";*/

    } 

}
echo json_encode($response);
?>