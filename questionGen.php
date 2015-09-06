<?php
session_start();
$userQuestionArray = [];
$num = rand(1,10);
$userQuestionArray[] = $num;
while(count($userQuestionArray)<3)
{
	$num = rand(1,10);
	$flag = 0;
	foreach ($userQuestionArray as $value) {
		if($value==$num)
		{
			$flag = 1;
			break;
		}
	}
	if($flag==0)
		$userQuestionArray[]=$num;
}
$result =$userQuestionArray[0];
unset($userQuestionArray[0]);
foreach ($userQuestionArray as $value) {
	$result.="_".$value;
}
//echo $result;
include('db.php');
$temp = $_SESSION['uid'];
$query = mysqli_query($conn,"INSERT INTO users(questions_allotted) VALUES('$result') WHERE uid = $temp");
if($query)
{
	echo "done";
}
?>