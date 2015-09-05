<?php 
session_start();
if(!(isset($_SESSION['logggedin']) && ($_SESSION['logggedin']==1)))
{
	die("you are not logged in");
}

$uid = $_SESSION['uid'];
//$sid = $_SESSION['sid'];
$qid = $_SESSION['qid'];
$uploadedFile = $_SESSION['programFilePath'];

$command = system("g++ ".$uploadedFile." 2>out.txt");
$errorFile = "o_".$uid."_".$qid."_".$_SESSION['attempts']."txt";
$logFile = fopen("$errorFile","w+");
$outFile = fopen("out.txt","r+");
$orgFile = fopen("$uploadedFile","r+");
$eCount;
$lCount;
while(!feof($outFile))
{
	$line = fgets($outFile);
	if(strpos($line,'error')!=false)
	$eCount++;	
}
fclose($outFile);
while(!feof($orgFile))
{
	$line = fgets($orgFile);
	if(strlen($)>0)
		$lcount++;
}
fclose($orgfile);
$result = $lCount."<br>".$eCount;
fwrite($logFile,$result);
fclose($logFile);
$_SESSION['attempts'] = $_SESSION['attempts']+1;
include('db.php');
$result = mysqli_query($conn,"INSERT INTO submissions(uid,qid,attempts,errors,lines_used) values($uid,$qid,$_SESSION['attempts'],$eCount,$lCount)");
echo if(!$result)
