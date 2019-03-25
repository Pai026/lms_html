<?php
$servername = "localhost";
$username = "root";
$password= "";
$dbname = "lastmanstanding1";

$conn =new \MySQLi($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn_error);
}
if($_POST["pswrd"] == "err404")
{
	$id1=$_POST['userid'];
	$result3=mysqli_query($conn,"SELECT Teamname FROM teams");
	while($row3=mysqli_fetch_assoc($result3))
	{	if($id1==$row3)
		{	$flag=1;
			break;
		}
		else
			$flag=0;
	}
	if($flag==0){
$stmt = $conn->prepare("INSERT INTO teams (Teamname) VALUES (?)");
$stmt->bind_param("s", $_POST['userid']);
$stmt->execute();}
$result=mysqli_query($conn,"SELECT TeamID FROM teams WHERE Teamname='$id1'");
$row=mysqli_fetch_assoc($result);
$num=mysqli_num_rows($result);
if($num>=1)
{   
	session_start();
	$id=$row['TeamID'];
	$_SESSION['user_id'] = $row['TeamID'];
	mysqli_query($conn,"UPDATE teams SET timestamps=CURRENT_TIMESTAMP() WHERE Teamid=$id");
	$result2=mysqli_query($conn,"SELECT TeamID FROM progress");
	while($row2=mysqli_fetch_assoc($result2))
	{	if($_SESSION['user_id']==$row2)
			$flag1=1;
		else
			$flag1=0;
	}
	if($flag1==0){
	$stmt = $conn->prepare("INSERT INTO progress(TeamID) VALUES (?)");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	header('Location: Questions.html');}
	else
		header('Location: Questions.html');
}

}
else{
	$_SESSION['error_message'] = 'Wrong Password';
header('Location: new.html');
}
?>