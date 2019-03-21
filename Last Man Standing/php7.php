<?php
$servername = "localhost";
$username = "root";
$password= "";
$dbname = "lastmanstanding";
$conn =new \MySQLi($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn_error);
}
session_start();
$r=$_SESSION['user_id'];
$result=mysqli_query($conn,"SELECT Q5 FROM answers");
$result1=mysqli_query($conn,"SELECT total FROM progress where TeamID=$r");
$row=mysqli_fetch_assoc($result);
$row1=mysqli_fetch_assoc($result1);
$p=$row['Q5'];
echo $p;
$q=$row1['total'];
echo $p;
if($_POST["pswrd"] == $p)
{
mysqli_query($conn,"UPDATE progress SET Q5=1,total=total+1 WHERE TeamID=$r");
if($q+1==5)
{
	
	mysqli_query($conn,"UPDATE teams SET timestampf=CURRENT_TIMESTAMP() WHERE TeamID=$r");
	header('Location: KILL.html');
	 unset($_SESSION['user_id']);
 session_destroy();
}
else
header('Location: Questions.html');
}
else{
	$_SESSION['error_message'] = 'Wrong Password';
header('Location: Questions.html');
}
?>
