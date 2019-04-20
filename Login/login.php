
<?php 
	include_once('connection.php');
?>

<?php
	$fault_alert = '<div class="col-12"><div class="alert alert-danger">Falied Login</div></div>';
	if (isset($_COOKIE['name'])) {
		header('Location:http://localhost/120170770_101/content.php');
	}else{	
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (isset($_POST['user_name']) && isset($_POST['user_password'])) {
				$username = htmlspecialchars($_POST['user_name']);
				$password = htmlspecialchars($_POST['user_password']);
				$connection = DBConnection::get_instance()->get_connection();
				$sql = "SELECT * FROM user WHERE name = '" . $username . "' AND password = '" . md5($password) . "'";	
				$result = mysqli_query($connection, $sql);
				setcookie("name", $username, time() + (86400 * 30), "/");
				if ($result != false) {
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						session_start();	
						$_SESSION["username"] = $username;
						$_SESSION["logged_in"] = true;
						if (isset($_POST['remember'])) {
							setcookie("name",$username,time() + (8640 * 30), "/");
						}
						header('Location:http://localhost/120170770_101/content.php');
						} else {
							echo $fault_alert;
						}
						} else {
							echo $fault_alert;
						}
					} else {
						echo $fault_alert;
				}
				}
			}
		?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
</head>
<body style="background-image: url(imge/img3.jpg);
			 background-repeat: no-repeat;
 			 background-position: right top;
  			 background-attachment: fixed;">
	<div class="container">
		<div style="margin-top:70px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
                     <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>
				<div style="padding-top:30px" class="panel-body">
					<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
					<form method="POST" action="" class="form-horizontal" role="form">
						<div style="margin-bottom: 25px" class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                    <input type="text" id="user-name" name="user_name" class="form-control" placeholder="Username" required="required">
                		</div> 
			          	<div style="margin-bottom: 25px" class="input-group">
		                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		                    <input type="password" id="user-password" name="user_password" class="form-control" placeholder="Password" required="required">
	               		</div>
	               		<div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" value="1"> Remember me
                                 </label>
                            </div>
                        </div>
						<div style="margin-top:10px" class="col-sm-12 controls">
							<button type="submit" name="submit" class="btn btn-success">Sign in</button>
						</div>
						
					</form>  

				</div>
				
			</div>
		</div>
	</div>
</body>
</html> 