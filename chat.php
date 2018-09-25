<?php
session_start();
if(!isset($_SESSION["username"])){
          	  header('location: index.php');

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
  <form name="form1">
    <div class="form-group row">
        <p>Welcome <?php echo $_SESSION['username']; ?></p>
        </div>
      <div class="form-group">
    <label for="exampleTextarea">Your Message:</label>
    <textarea class="form-control" rows="3" id="box" name="msg"></textarea>
  </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <a href="#"<button type="submit" class="btn btn-primary" onclick="submitChat()">Send</button></a>
      </div>
    </div>
      <div class="form-group row">
      <a href="logout.php">Logout.</a>
      </div>
  </form>
</div>

<div id="chatlogs">
LOADING CHATLOGS...    
</div>
    <script
  src="http://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
    
    <script>
    
function submitChat() {
	if(form1.msg.value == '') {
		alert("Enter your message!!!");
		return;
	}
	var msg = form1.msg.value;
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('box').value = "";
            }
        };
        xmlhttp.open("GET","insert.php?msg="+msg,true);
        xmlhttp.send();

}

document.addEventListener('DOMContentLoaded', function() {
    setInterval(function(){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("chatlogs").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","call.php",true);
        xmlhttp.send();
        
    },1000);
	
},false);
</script>
</body>
</html>
