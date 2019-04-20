<?php
	session_start(); 
	include_once('connection.php');
	$conn=DBConnection::get_instance()->get_connection();
	if (isset($_COOKIE['name']) && $_SESSION["logged_in"] = true) {
		$set= $_COOKIE['name'];
		$show="SELECT * FROM user where name = '$set'";								  
		$result=mysqli_query($conn , $show);
		$row=mysqli_fetch_assoc($result);
	    $gender = $row['gender'];
	    $phone = $row['phone'];
	    $email = $row['email'];
	} else {
	    header('Location:http://localhost/120170770_101/login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Content</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style=" margin-top: 70px; margin-left:430px; ">
		
			<div class="col-12">
				<div class="card" style="width:400px">
					<?php if ($gender=="male")
		    				echo'<img class="card-img-top" src="imge/img.png" alt="Card image" style="width:100%">';
		    			 else
		    				echo'<img class="card-img-top" src="imge/img2.png" alt="Card image" style="width:100%">';
		    		 ?>
		    		<div class="card-body">
				      <h3 class="card-title" style="text-transform: capitalize"><?php echo $_COOKIE['name']; ?></h3>
				      <div style="font-family: Lucida Console;">		      		
						<?php 
							if (isset($_POST['see_profile'])) {	
								echo "<strong>Gender: </strong>".$gender."<br>";
								echo "<strong>Phone: </strong>".$phone."<br>";
								echo "<strong>Email: </strong>".$email;	
							}
						 ?>
					  </div>	 	
						 <form method="POST" action="">
					      	<button class="btn btn-primary" name="see_profile">See Profile</button>
					      	<a href="logout.php"><button type="button" type="submit" class="btn btn-danger" style="margin-left: 175px">Logout</button></a>
			      		</form>
				</div>
  			</div>
  			</div>
  	</div>	
</body>
</html>