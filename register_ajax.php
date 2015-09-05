<?php
include('db.php');
if(isset($_POST['email']))
{
$email=mysqli_real_escape_string($conn,htmlentities($_POST['email']));
$query="select * from users where email='".$email."'";
//echo $query;
$result = mysqli_query($conn,$query) or die("The Query failed: ".mysqli_error($conn));
$rowcount=mysqli_num_rows($result);
/*while($row = mysql_fetch_assoc($result))
{
echo 'ans: '.$row['email'].'';
}*/
if($rowcount==1)
	echo '0';
else
	echo '1';
}
else if(isset($_POST['uname']))
{
$uname=mysqli_real_escape_string($conn,htmlentities($_POST['uname']));
include 'db.php';
$query="select * from users where regno='".$uname."'";
//echo $query;
$result = mysqli_query($conn,$query) or die("The Query failed: ".mysqli_error($conn));
$rowcount=mysqli_num_rows($result);
/*while($row = mysql_fetch_assoc($result))
{
echo 'ans: '.$row['uname'].'';
}*/
if($rowcount==1)	// Username already present in the database. Return false.
	echo '0';
else
	echo '1';
}
else 
{
header('Location: index.php');
}
?>