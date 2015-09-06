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
echo $result;
?>