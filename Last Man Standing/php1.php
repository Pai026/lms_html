<?php
$servername = "localhost";
$username = "root";
$password= "";
$dbname = "lastmanstanding";

$conn =new \MySQLi($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn_error);
}
if($_POST["pswrd"] == "abhi")
{
$stmt = $conn->prepare("INSERT INTO teams (Teamname) VALUES (?)");
$stmt->bind_param("s", $_POST['userid']);
$stmt->execute();

$result=mysqli_query($conn,'SELECT TeamID FROM teams');
$row=mysqli_fetch_assoc($result);
$num=mysqli_num_rows($result);
if($num==1)
{   
	session_start();
	$id=$row['TeamID'];
	$_SESSION['user_id'] = $row['TeamID'];
	mysqli_query($conn,"UPDATE teams SET timestamps=CURRENT_TIMESTAMP() WHERE Teamid=$id");
	$stmt = $conn->prepare("INSERT INTO progress(TeamID) VALUES (?)");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	header('Location: Questions.html');
}

}
else{
	$_SESSION['error_message'] = 'Wrong Password';
header('Location: new.html');
}
?>