<?php 
session_start();

$errorsBasePath = "Errors/";

if(!(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==1)))
{
	die("you are not logged in");
}
$uid = $_SESSION['uid'];
$qid = $_SESSION['qid'];
//$uploadedFile = fopen("$_SESSION['programFilePath']","r+");//$_SESSION[''];
$orgFile = $_SESSION['programFilePath'];
system("g++ ".$orgFile." 2>out.txt");
$origFile = fopen("$orgFile","r+");
$errorFile = $errorsBasePath . "o_".$uid."_".$qid."_".$_SESSION['attempts'].".txt";
$logFile = fopen("$errorFile","w+");
$outFile = fopen("out.txt","r+");
$eCount=0;
$lCount=0;
while(!feof($outFile))
{
	$line = fgets($outFile);
	if((strpos($line,'error')!=false))
		$eCount++;	
}
fclose($outFile);
while(!feof($origFile))
{
	$line = fgets($origFile);
	if(strlen($line)>0)
		$lCount++;
}
fclose($origFile);
$result = $lCount.",".$eCount;
fwrite($logFile,$result);
fclose($logFile);
include('db.php');
$result = mysqli_query($conn,"INSERT INTO submissions(uid,qid,attempts,errors,lines_used,uploaded_time) VALUES($uid,$qid,".$_SESSION['attempts'].",$eCount,$lCount,now())");
if($result){
	echo "Done.";
	//$_SESSION['attempts'] = $_SESSION['attempts']+1;
}
?>