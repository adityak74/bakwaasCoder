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
			if(isset($_SESSION['uname']))
			{
			$fname=$_SESSION['fname'];
			echo 'Welcome '.$fname;
			echo ' | <a href="logout.php">Logout</a><a class="btn btn-primary" style="float:right;margin:2px;" href="index.php">My Home</a>';
			?>
				<br><br><br>
				<div class="row" class="text-center">
					
					<div class="col-sm-12">
						<h3 class="text-center" style="border-bottom: 1px solid blue;"> Your Submissions </h3>
						<?php
						include 'db.php';
						$query = "SELECT q.qdesc,s.uploaded_time from questions q,submissions s WHERE q.qid=s.qid and uid=".$_SESSION['uid'];
						$result=mysqli_query($conn,$query) or die("The Query failed: ".mysqli_error($conn));
						$count = mysqli_num_rows($result);

						if($count>0){
						while ($row = mysqli_fetch_assoc($result)) {
							$uploaded_time = $row['uploaded_time'];


							echo '<div class="row" style="background-color: rgb(255, 255, 255); padding: 20px; border-radius: 10px;margin:10px;"><h4 style="display: inline; margin-right: 10px;float:left;">'.$row['qdesc'].'</h4>
								<h4 style="display: inline; margin-right: 10px;float:right;">'.$uploaded_time.'</h4>
								</div>';
							
						}
						}else{
							echo '<div class="row" style="background-color: rgb(255, 255, 255); padding: 20px; border-radius: 10px;margin:10px;"><h4 style="display: inline; margin-right: 10px;float:left;">You have not registered for any events.</h4>
								</div>';
						}


						?>
						
					</div>
					
					
				</div>
			<?php
			}
			else
			{
			echo '<center><br><br><br><br>';
			echo '<h1>Welcome to Gravitas!!!</h1>';
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