<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Fest-Name Login | ITechnospot</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="css/font.css">
	  <link rel="stylesheet" href="css/custom.css">
	  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="ctr">
<?php require('header.php'); ?>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
	header('Location: index.php');
else if(!isset($_POST['sent']))
{
?>

<script>
var un=0, em=0, mo=0, ps=0;
$('document').ready(function()
{
	$('#uname').change(function()
	{
		var uname=$('#uname').val();
		
		if(uname!='')
		{
			un=0;
			$.ajax({
				type: 'post',
				url: 'register_ajax.php',
				data: 'uname='+uname+'',
				processData: false,
				success: function(data){
					un=data;
				}
			}).error(function(){
					$('#uname-availability').append('<i>Some error has occured. Please refresh and try again.</i>');
					$('#uname-availability').removeClass('hidden');
			}).complete(function(){
					if(un=='1')	
					{
						$('#uname-err').addClass('hidden');
						$('#uname-availability').addClass('hidden');
						$('#uname').parent().parent().removeClass('has-error');
						$('#uname-suc').removeClass('hidden');
						$('#uname').parent().parent().addClass('has-success');
						$('#uname').parent().parent().addClass('has-feedback');
						un=1;
					}
					else
					{
						$('#uname-suc').addClass('hidden');
						$('#uname-availability').removeClass('hidden');
						$('#uname').parent().parent().removeClass('has-success');
						$('#uname-err').removeClass('hidden');
						$('#uname').parent().parent().addClass('has-error');
						$('#uname').parent().parent().addClass('has-feedback');
						un=0;
					}
			});	
		}
	});
	
	$('#mobile').change(function(){
		var mob = $(this).val();
		if(mob!='')
		{
			if (mob>999999999 && mob<10000000000)
			{
				$('#mobile-err').addClass('hidden');
				$('#mobile-reg').addClass('hidden');
				$('#mobile').parent().parent().removeClass('has-error');
				$('#mobile-suc').removeClass('hidden');
				$('#mobile').parent().parent().addClass('has-success');
				$('#mobile').parent().parent().addClass('has-feedback');
				mo=1;
			}
			else
			{
				$('#mobile-suc').addClass('hidden');
				$('#mobile').parent().parent().removeClass('has-success');
				$('#mobile-err').removeClass('hidden');
				$('#mobile-reg').removeClass('hidden');
				$('#mobile').parent().parent().addClass('has-error');
				$('#mobile').parent().parent().addClass('has-feedback');
				mo=0;
			}
		}
	});
	$('#pwd').change(function(){
	var pwd = $('#pwd').val();
	var pswd = $('#pswd').val();
	if(pswd!='')
	{
		if(pwd!=pswd)
		{
			$('#pwd').parent().parent().removeClass('has-success');
			$('#pswd').parent().parent().removeClass('has-success');
			$('#password-match').removeClass('hidden');
			$('#pwd').parent().parent().addClass('has-error');
			$('#pswd').parent().parent().addClass('has-error');
			ps=0;
		}
		else
		{
			$('#pwd').parent().parent().removeClass('has-error');
			$('#pswd').parent().parent().removeClass('has-error');
			$('#password-match').addClass('hidden');	
			$('#pwd').parent().parent().addClass('has-success');
			$('#pswd').parent().parent().addClass('has-success');	
			ps=1;
		}
	}
	});
	$('#pswd').change(function(){
	var pwd = $('#pwd').val();
	var pswd = $('#pswd').val();
	if(pwd!=pswd)
	{
		$('#pwd').parent().parent().removeClass('has-success');
		$('#pswd').parent().parent().removeClass('has-success');
		$('#password-match').removeClass('hidden');
		$('#pwd').parent().parent().addClass('has-error');
		$('#pswd').parent().parent().addClass('has-error');
		ps=0;
	}
	else
	{
		$('#pwd').parent().parent().removeClass('has-error');
		$('#pswd').parent().parent().removeClass('has-error');
		$('#password-match').addClass('hidden');	
		$('#pwd').parent().parent().addClass('has-success');
		$('#pswd').parent().parent().addClass('has-success');	
		ps=1;
	}
	});
});

function validate()
{
if(un && mo && ps)
	return true;
else
	return false;
}
</script>

<div class="container maincontent"><br>
	<div class="row">
		<div class="col-xs-12 text-center"><img src="images/wide_logo.png" alt="ITechnospot Logo"/><br><br></div>
	</div>
	<div class="row">
		<div class="col-xs-3 col-md-3 col-lg-3"></div>
		<div class="col-xs-6 col-md-6 col-lg-6" style="box-shadow: 0px 0px 10px #000;border: 1px #222 solid; padding: 14px; border-radius: 9px;">
			<h3 class="text-primary" style="margin-top: 0px; margin-bottom: 20px;">Register</h3>
			<form role="form" class="form-horizontal" method="post" onsubmit="javascript: return validate();" action="#">
				<div class="form-group form-group-sm">
					<label class="col-sm-4" for="fname">Name:</label>
					<div class="col-sm-8"><input type="text" autofocus class="form-control" name="fname" required id="fname"></div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-sm-4" class="control-label" for="uname">Registration No:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" style="text-transform:uppercase;" required id="uname" name="uname" aria-describedby="usernamestatus">
						<p class="hidden text-danger" id="uname-availability">
							The reg no is already registered.
						</p>
					</div>
					<div class="hidden" id="uname-suc">
						<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
						<span id="usernamestatus" class="sr-only">(success)</span>
					</div>
					<div class="hidden" id="uname-err">
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
						<span id="usernamestatus" class="sr-only">(success)</span>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-sm-4" for="mobile">Mobile No: (10-digit)</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" pattern="\d{10}" name="mobile" required id="mobile" aria-describedby="mobilestatus">
						<p class="hidden text-danger" id="mobile-reg">
							Please enter a valid 10-digit mobile number.
						</p>
					</div>
					<div class="hidden" id="mobile-suc">
						<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
						<span id="mobilestatus" class="sr-only">(success)</span>
					</div>
					<div class="hidden" id="mobile-err">
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
						<span id="mobilestatus" class="sr-only">(success)</span>
					</div>
				</div>
				
				<div class="form-group form-group-sm">
					<label class="col-sm-4" for="pwd">Password:</label>
					<div class="col-sm-8"><input type="password" class="form-control" name="pwd" required id="pwd"></div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-sm-4" for="pswd">Re-enter Password:</label>
					<div class="col-sm-8"><input type="password" class="form-control" name="pswd" required id="pswd">
					<p class="hidden text-danger" id="password-match">
							The two passwords do not match.
					</p>
					</div>
				</div>
	
				<input type="hidden" value="1" name="sent" id="sent">
				<button type="submit" class="btn btn-primary col-xs-12">Submit</button><br><br>
			</form>
		</div>
	</div>
	<div class="col-xs-3 col-md-3 col-lg-3"></div>
	<br>
</div>
<?php
}
else{
	include('db.php');
	$fname = isset($_POST['fname']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['fname'])) : '';
	//$lname = isset($_POST['lname']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['lname'])) : '';
	$uname = isset($_POST['uname']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['uname'])) : '';
	//$email = isset($_POST['email']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['email'])) : '';
	//$regno = isset($_POST['regno']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['regno'])) : '';
	$mobile = isset($_POST['mobile']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['mobile'])) : '';
	$pwd = isset($_POST['pwd']) ?  sha1(mysqli_real_escape_string($conn,htmlentities($_POST['pwd']))) : '';
	//$college = isset($_POST['college']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['college'])) : '';
	//$location = isset($_POST['location']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['location'])) : '';
	
	$query="INSERT INTO users (name, regno, phno, passwd) VALUES('$fname','$uname','$mobile','$pwd')";
	$result=mysqli_query($conn,$query) or die("The Query failed: ".mysqli_error($conn));
	if($result)
	{	echo "<b>";
		echo $fname;
		echo "</b>, you have successfully registered with your email id <b>";
		echo "</b>.<br>";
		$_SESSION['loggedin']=1;
		$_SESSION['fname']=$fname;
		$_SESSION['regno']=$uname;
		$_SESSION['phno']=$mobile;

		//get the recently registered user ID by the regno
		$query = "SELECT * from users WHERE regno='".$uname."'";
		$result=mysqli_query($conn,$query) or die("The Query failed: ".mysqli_error($conn));
		$row = mysqli_fetch_assoc($result);

		$_SESSION['uid']=$row['uid'];

		//print_r($_SESSION);
		echo "Redirecting to the Homepage...<br>";
		echo "<img src='images/loading.gif' height=50 width=50>";
		//sleep(5);
		header("refresh:3; url=index.php");
	}
}
?>
<?php require('footer.php'); ?>
</div>
</body>
</html>
