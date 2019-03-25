
<?php
$to = $_POST['email'];
$subject = "CLUE 5";
$message = "space";
$headers = "From: genisys@ai.com";
if(mail($to,$subject,$message,$headers)){
echo "CLUE SEND TO THE EMAIL";
}
else
echo "Can Not send";
?>
