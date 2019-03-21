
<?php
$to = $_POST['email'];
$subject = "CLUE 5";
$message = "space";
$headers = "From: genisys@ai.com";
if(mail($to,$subject,$message,$headers)){
echo "VERIFICATION CODE SEND TO THE EMAIL";
}
else
echo "Can Not send";
?>
