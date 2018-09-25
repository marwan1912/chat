<?php
session_start();
require_once "config.php";
$errors = array();
if(isset($_SESSION['username'])){
      	  header('location: chat.php');
}
if(isset($_POST['submit'])){
$username = mysqli_real_escape_string($link, $_POST['username']);
$password = mysqli_real_escape_string($link, $_POST['password']);
if(!empty($_POST['password'])){
    $password = md5($password);

}
$result = mysqli_query($link, "SELECT * FROM users WHERE username='$username' AND password='$password'");

if(empty($username)){
       	array_push($errors, "Username is required.");
}
if(empty($password)){
       	array_push($errors, "Password is required.");
}

    if(count($errors)==0){
        if(mysqli_num_rows($result)){
	$res = mysqli_fetch_array($result);
	$_SESSION['username'] = $res['username'];
	   header("Location:chat.php");
        }else{
           	array_push($errors, "Username/Password combination was not found. Please try again logging in or register if you don't have an account.");
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
  <form name="form2" action="index.php" method="post">
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
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
      </div>
    </div>
      <div class="form-group row">
      <a href="register.php">Click here to register a new account.</a>
      </div>
  </form>
</div>

</body>
</html>