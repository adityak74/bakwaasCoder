<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Gravitas - VIT University Chennai</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/font.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
<div id="ctr">
	<script type="text/javascript">
		$('document').ready(function(){
			$(".dropdown-menu li a").click(function(){
			  var selText = $(this).text();
			  $(this).parents('.dropdown').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
			});

			$('.btn-addtocart').click(function(){
				//alert('Clicked');
				var qty = $(this).parent().parent().find('.input-qty').val();/*css('background-color','red');*/
				var tid = $(this).parent().parent().find('.tid').val();
				var size = $(this).parent().parent().find('.sizebt').text();
				var resp = $(this).parent().parent().find('.response-text');
				//alert(size);
				$.ajax({
					url: "addtocart.php",
					method: "POST",
					data: 'qty='+qty+'&tid='+tid+'&size='+size+'',
					success: function(data){
						alert("Added to Cart");
					}
				});
			});
		});
	</script>
	<?php require('header.php'); ?>

	<div class="container maincontent">
			<?php
			if(isset($_SESSION['uname']) && isset($_SESSION['loggedin']))
			{
			$fname=$_SESSION['fname'];
			include 'db.php';
			$query = "SELECT * from submissions WHERE uid='".$_SESSION['uid']."'";
			$result = mysqli_query($conn,$query) or die("The Query failed: ".mysqli_error($conn));
			if(mysqli_num_rows($result)>0){
				while($row=mysqli_fetch_assoc($result)){
					$_SESSION['attempts'] = $row['attempts']+1;
				}
			}else{
				$_SESSION['attempts']=1;
			}
			echo 'Welcome '.$fname;
			echo ' | <a href="logout.php">Logout</a>	';
			?>
				<div class="row" class="text-center">
					<div class="col-sm-4">
						<h3 class="text-center"> Rules </h3>
						<ul class="fa-ul">
							<li><i class="fa-li fa fa-expand"></i>Please select the quantity and size correctly.</li>
							<br>
							<li><i class="fa-li fa fa-shopping-cart"></i>Changes/Cancellation will not be made once the order is placed.</li>
							<br>
							<li><i class="fa-li fa fa-money"></i>
The amount to be paid should be paid at the Gravitas counters and an acknowledgement mail will be sent to your registered email id.</li>
							<br>
							<li><i class="fa-li fa fa-envelope"></i>
Please keep the acknowledgement email intact until your order is delivered.</li>
							<br>
							<li><i class="fa-li fa fa-exchange"></i>
Verify that the order delivery acknowledgement mail has been recieved once you collect your order and also with the Gravitas Counter each time that the information is updated on each event from payment to the delivery.</li>
						</ul>
					</div>
					<div class="col-sm-8">
						
						<div class="row" >
							<!-- Problem will load here by random from the database -->
							<?php 
							include 'db.php';

							$query = "SELECT * from users WHERE uid=".$_SESSION['uid'];
							$result = mysqli_query($conn,$query) or die("query failed".mysqli_error($conn));
							$row = mysqli_fetch_assoc($result);

							if($row['questions_alloted']==NULL){

							

							
							//questionGeneration here
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
							
							
							$temp = $_SESSION['uid'];
							//echo $temp;
							$query = mysqli_query($conn,"UPDATE users SET questions_alloted = '$result' WHERE uid = $temp") or die("query failed".mysqli_error($conn));
							//questions genrated and stored
							}
							//display the question to user
							$uid = $_SESSION['uid'];
							$result = mysqli_query($conn,"SELECT questions_alloted FROM users where uid = $uid") or die("query failed ".mysqli_error($conn));
							$row = mysqli_fetch_assoc($result);
							$question = $row['questions_alloted'];
							$temp = explode("_",$question);
							$queDisp = $temp[$_SESSION['attempts']-1];
							$disQuery = mysqli_query($conn,"SELECT qdesc FROM questions WHERE qid = $queDisp") or die("query failed".mysqli_error($conn));
							$qrow = mysqli_fetch_assoc($disQuery);
							
							if($_SESSION['attempts']<4)
							{
							?>
							<center>
								<h3 class="text-center">Your Question</h3>
								<br>
								<h4 style="background-color: rgb(255, 255, 255); padding: 20px; border-radius: 10px;margin:10px;"><?php echo $qrow['qdesc']; ?></h4>
								<form role="form" action="upload.php" method="post" enctype="multipart/form-data">
									<label for="file">
										<br>
										<input id="ufile" type="file" name="uploadedFile" accept="text/x-c++src">
										<br>
										<button class="btn btn-primary" type="submit" name="submitBt">Submit</button>
									</label>
								</form>
							</center>
							<?php
							}
							else{
							?>
							<center>
								<h3>You have completed the challenge.Logout and have fun.</h3>
								<a href="dashboard.php" class="btn btn-primary">My Submissions</a>
							</center>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			<?php
			}
			else
			{
			echo '<center><br><br><br><br>';
			echo '<h1>Welcome to BakwaasCode!!!</h1>';
			echo '<br><a class="btn btn-primary btn-lg" role="button" href="register.php">Register</a> | <a class="btn btn-success btn-lg" role="button" href="login.php">Login</a>';
			echo '</center>';
			}
			?>
		</div>
		<!--
	<div class="footer">
		<h1 class="font-ostrich right">Developed by ITechnospot Team</h1>
	</div>
		-->
		<?php require('footer.php'); ?>
</div>
</body>
</html>