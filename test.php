<?php 

//$binPath = "\"D:\Program Files (x86)\CodeBlocks\MinGW\bin";

$result = system("g++ hell.cpp 2> out.txt");
$uid = 123;
$qid = 3;
$attempts = 2;
$fileName = "o_".$uid."_".$qid."_".$attempts.".txt";
$file = fopen("$fileName","w+");
$Upfile = fopen("out.txt","r+");
/*echo "Errors : <br>";*/
$Ecount=0;
$Lcount=0;
while(!feof($Upfile)){
    $line = fgets($Upfile);
    # do same stuff with the $line
	if(strlen($line)>0)
		$Lcount++;
	echo $line."<br>";
	if((strpos($line,'error')!=false))
		$Ecount++;
}
$result = $Lcount."\n".$Ecount;
//echo $result;
fwrite($file,$result);
fclose($Upfile);
rewind($file);
while(!feof($file))
{
	$line = fgets($file);
	echo $line."<br>";
}
fclose($file);

?>