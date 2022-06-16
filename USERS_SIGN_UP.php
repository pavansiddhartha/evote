<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();

$response = array();

$response["ERROR"] = true;


if( isset($_POST['FNAME']) &&isset($_POST['LNAME']) && isset($_POST['EMAIL'])&& isset($_POST['PASSWORD']) && isset($_POST['AADHARID']) &&isset($_POST['PHONENO']) && isset($_POST['ADDRESS']) && isset($_POST['DOB'])  ){

$fname= $_POST["FNAME"];
$lname=$_POST['LNAME'];
$email=$_POST['EMAIL'];
$password=$_POST['PASSWORD'];
$aadhar_id=$_POST['AADHARID'];
$phoneno=$_POST['PHONENO'];
$address=$_POST['ADDRESS'];
$dob=$_POST['DOB'];





$res = $db->createUser($fname,$lname,$email,$password,$aadhar_id,$phoneno,$address,$dob);
    
    
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


