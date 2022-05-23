<?php include'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Management | Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- <style>
		.loginMsg{
	color: #fff;
	background-color: rgb(0,230,10);
	padding: 5px;
	opacity: .8;
}
.errorMsg{
	color: #fff;
	background-color: rgb(230,0,10);
	padding: 5px;
	opacity: .9;

}
	</style> -->
</head>
<body>
	<div class="container">
		<div class="form-group">
			<h2>Login Form</h2>
			<?php
			require_once 'db.php';
			session_start();
			if(isset($_POST['submit'])){
				$username= $_POST['username'];
				$password= $_POST['password'];
				if(empty($username)){
					$errorMsg[]= "Please Fill Username";
				}elseif(empty($password)){
					$errorMsg[]= "Please fill Password";
				}else{
					try{
						$sql=$connection->prepare("SELECT * FROM login_db WHERE username=:username AND password=:password");
						$sql->execute(array(':username'=>$username,':password'=>$password));
						$row= $sql->fetch(PDO:: FETCH_ASSOC);
						if($sql->rowCount() > 0){
							if($username==$row['username']){
								if($password==$row['password']){
									$_SESSION['user_login']= $row['id'];
									$loginMsg= "Successfully Login...";
									header("refresh:2; index.php");
								}else{
									$errorMsg[]= "Wrong Password";
								}
								}else{
									$errorMsg[]= "Wrong Username";
							}
						}
					}catch(PDOException $e){
						$e->getMessage();
					}
				}
			}
			?>

			<?php
			if(isset($errorMsg)){
				foreach($errorMsg as $error){
		
			?>
			<div class="errorMsg form-control">
				<strong><?php echo $error;?></strong>
			</div>
			<?php
				}
			}
			if(isset($loginMsg)){

			?>
			<div class="loginMsg form-control">
				<strong><?php echo $loginMsg;?></strong>
			</div>
			<?php
			}
			?>
			<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
</head>
<body class="bg-dark">
 
<div class="container h-100">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-5 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto w-25" >Login</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
				}
			?>
			<form method="POST" action="">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="username" placeholder="Enter Email" class="form-control">
				</div>
				<div class="form-group">
				<label for="email">Password:</label>
					<input type="password" name="password" placeholder="Enter Password" class="form-control">
				</div>
 
				<button type="submit" name="submit" class="btn btn-primary">login
				</button>




				
				
			</form>
		</div>
	</div>
</div>
</body>
</html>
