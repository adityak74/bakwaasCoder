<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>BakwaasCode Login | technoVIT</title>
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
		<?php require('header.php'); ?>
		<?php
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
			echo "<script type=\"text/javascript\">window.location.href = 'index.php';</script>";
		}
		else if(!isset($_POST['uname']))
		{
		?>
		<div class="container">
			<div class="row">
			<div class="col-sm-4"></div>
				<div class="col-sm-4" style="box-shadow: 0px 0px 10px #222;border: 1px #000 solid; padding: 14px; border-radius: 9px;
    margin-top: 80px;">
    			<center>
    				
    			
					<h3 class="text-primary" style="margin-top: 0px; margin-bottom: 20px;">Login</h3>
					<form role="form" class="form-horizontal" method="post" action="">
						<div class="form-group form-group-sm">
							<label class="col-sm-4" for="uname">Registration No:</label>
							<div class="col-sm-8"><input type="text" style="text-transform:uppercase;" autofocus class="form-control" name="uname" required id="uname"></div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-4" for="pwd">Password:</label>
							<div class="col-sm-8"><input type="password" autofocus class="form-control" name="pwd" required id="pwd"></div>
						</div>
						<div class="col-sm-4"></div>
						<div class="col-sm-8"><br></div>
						<button type="submit" class="btn btn-primary col-xs-12">Submit</button><br><br>
						<br>
						<a href="register.php" class="btn btn-primary col-xs-12">Register Here</a>
					</form>	
				</center>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
		<?php
		}
		else
		{
			include('db.php');
			$uname = isset($_POST['uname']) ?  mysqli_real_escape_string($conn,htmlentities($_POST['uname'])) : '';
			$pwd = isset($_POST['pwd']) ?  sha1(mysqli_real_escape_string($conn,htmlentities($_POST['pwd']))) : '';
			$query="SELECT * FROM users where regno='".$uname."'";
			$result=mysqli_query($conn,$query) or die("The Query failed: ".mysqli_error($conn));
			$rowcount=mysqli_num_rows($result);
			if($rowcount==1)
			{
				$row = mysqli_fetch_assoc($result);
				$pswd=$row['passwd'];
				if($pwd==$pswd)
				{
					
					$_SESSION['loggedin']=1;
					$_SESSION['uid']=$row['uid'];
					$_SESSION['fname']=$row['name'];
					$_SESSION['uname']=$row['regno'];
					
					echo "<div class=\"col-sm-4\"></div>
					      <div class=\"col-sm-4\">
					      <h1>You have successfully logged in " . $_SESSION['fname'] . "
					      </h1><h4>Please wait while we redirect you...</h4></div>
					      <div class=\"col-sm-4\"></div>";
					echo "<script type=\"text/javascript\">window.location.href = 'index.php';</script>";
				}
				else
				{
					echo '<div class="container">
			<div class="row">
			<div class="col-sm-4"></div>
				<div class="col-sm-4" style="box-shadow: 0px 0px 10px #222;border: 1px #000 solid; padding: 14px; border-radius: 9px;
    margin-top: 80px;">
    			<center>
    				
    				<h3 style="color:red;">Password Incorrect</h3>
					<h3 class="text-primary" style="margin-top: 0px; margin-bottom: 20px;">Login</h3>
					<form role="form" class="form-horizontal" method="post" action="">
						<div class="form-group form-group-sm">
							<label class="col-sm-4" for="uname">Username:</label>
							<div class="col-sm-8"><input type="text" style="text-transform:uppercase;" autofocus class="form-control" name="uname" required id="uname"></div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-4" for="pwd">Password:</label>
							<div class="col-sm-8"><input type="password" autofocus class="form-control" name="pwd" required id="pwd"></div>
						</div>
						<div class="col-sm-4"></div>
						<div class="col-sm-8"><br></div>
						<button type="submit" class="btn btn-primary col-xs-12">Submit</button><br><br>
						<br>
						<a href="register.php" class="btn btn-primary col-xs-12">Register Here</a>
					</form>	
				</center>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>';
				}
			}
			else
			{
				echo '<div class="container">
			<div class="row">
			<div class="col-sm-4"></div>
				<div class="col-sm-4" style="box-shadow: 0px 0px 10px #222;border: 1px #000 solid; padding: 14px; border-radius: 9px;
    margin-top: 80px;">
    			<center>
    				
    				<h3 style="color:red;">Username Incorrect</h3>
					<h3 class="text-primary" style="margin-top: 0px; margin-bottom: 20px;">Login</h3>
					<form role="form" class="form-horizontal" method="post" action="">
						<div class="form-group form-group-sm">
							<label class="col-sm-4" for="uname">Username:</label>
							<div class="col-sm-8"><input type="text" style="text-transform:uppercase;" autofocus class="form-control" name="uname" required id="uname"></div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-4" for="pwd">Password:</label>
							<div class="col-sm-8"><input type="password" autofocus class="form-control" name="pwd" required id="pwd"></div>
						</div>
						<div class="col-sm-4"></div>
						<div class="col-sm-8"><br></div>
						<button type="submit" class="btn btn-primary col-xs-12">Submit</button><br><br>
						<br>
						<a href="register.php" class="btn btn-primary col-xs-12">Register Here</a>
					</form>	
				</center>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>';
			}
		}
		?>
		<?php require('footer.php'); ?>
	</body>
</html>