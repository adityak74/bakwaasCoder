 <?php
session_start();

$attempts = $_SESSION['attempts'];
$target_dir = "Programs/";

$uid = $_SESSION['uid'];
$qid = $_SESSION['qid'];
$uploadFileName = "p_".$uid."_".$qid."_".$_SESSION['attempts'].".cpp";
$target_file = $target_dir . basename($uploadFileName);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submitBt"])) {
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
    if ($_FILES["uploadedFile"]["size"] > 10240000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
	}
	if($imageFileType != "cpp") {
		
	    echo "Sorry, only Cpp/C++ files are allowed.";
	    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_file)) {
	        echo "The file ". $uploadFileName . " has been uploaded.";
	        $_SESSION['programFilePath'] = $target_file;
	        header("Location: getFile.php");
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}  
}
?> 