<?php
session_start();
$uid = $_SESSION['uid'];
include('db.php');
$result = mysqli_query($conn,"SELECT questions_alloted FROM users where uid = $uid") or die("query failed ".mysqli_error($conn));
$row = mysqli_fetch_assoc($result);
$question = $row['questions_alloted'];
$temp = explode("_",$question);
$queDisp = 1;//$temp[$_SESSION['attempts']-1];
$disQuery = mysqli_query($conn,"SELECT qdesc FROM questions WHERE qid = $queDisp") or die("query failed".mysqli_error($conn));
$qrow = mysqli_fetch_assoc($disQuery);
echo $qrow['qdesc'];
?>
