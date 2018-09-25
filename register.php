<?php
$errors = array();
$success = array();
if(isset($_POST['submit'])) {

    require_once "config.php";
$username = mysqli_real_escape_string($link, $_POST['username']);
  $password= mysqli_real_escape_string($link, $_POST['password']);
	$password2 = $_POST['password2'];
	
	if($password != $password2) {
	    if(!empty($password) && !empty($password2)){
	        		       	array_push($errors, "Passwords do not match.");
	    }
	}
	if(empty($username)){
       	array_push($errors, "Username is required.");
} 
if(empty($password)){
       	array_push($errors, "Password is required.");
}
if(empty($password2)){
       	array_push($errors, "Confirm Password is required.");
}

if(count($errors)==0){
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($link, $user_check_query);
  $user = mysqli_fetch_assoc($result);
		if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists.");
    }
  }
		if(count($errors)==0){
		    $password = md5($password);
			mysqli_query($link, "INSERT INTO users (`username`,`password`) VALUES('$username','$password')" );
			  	$_SESSION['username'] = $username;
			array_push($success,"You are now registered. Click <a href='index.php'>here</a> to login.");
		}
		     
		}
		
}
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<title>Marwan's Chat</title>
</head>
<body>
<div class="container" style="margin-top:25px;">
      <?php  if (count($errors) > 0) : ?>
<div class="alert alert-danger" role="alert">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
  <?php  if (count($success) > 0) : ?>
<div class="alert alert-success" role="alert">
  	<?php foreach ($success as $success) : ?>
  	  <p><?php echo $success ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
  <form name="form2" action="register.php" method="post">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
    </div>
      <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
    </div>
 <div class="form-group row">
      <a href="index.php">Login page</a>
      </div>
  </form>
</div>

</body>
</html>