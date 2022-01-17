<?php 

//Get parameters
$roomname = $_GET ['roomname'];

//Connecting to the database
include 'db_connect.php';

//Execute sql to check whether room exists 

$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";

$result  = mysqli_query($conn, $sql);

if($result)
{
	if(mysqli_num_rows($result) == 0)
	{
		$message = "This room doesn't exist try creating a new one!";

	  echo '<script language="javascript">'; //Displaying javascript using echo as message as variable

	  echo 'alert("'.$message.'");';
	  echo 'window.location="http://localhost/Chatroom";';  
	  echo '</script>'; //how to alert javascript in php
	}
}
else
{
	echo "Error : ". mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass{
	height: 350px;
	overflow-y:  scroll;
}
</style>
</head>
<body>
<header class="site-header sticky-top py-1">
     <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        
        <span class="fs-4"><center>insideFPV ChatRoom</center></span>
      </a>

      <nav class="text-center">
        <a class="me-3 py-2 text-decoration-none" href="#">Home</a>
        <a class="me-3 py-2  text-decoration-none" href="#">About</a>
        <a class="me-3 py-2 text-decoration-none" href="#">Contact</a>
        <a class="py-2  text-decoration-none" href="#">Pricing</a>
      </nav>
    </div>
</header>
<h2>Chat Messages - <?php echo $roomname; ?> </h2>

<div class="container">
	<div class  = "anyClass"></div>
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span>
</div>


<input type = "text" class = "form-control" name = "usermsg" id = "usermsg" placeholder = "Add message" ><br>

<button class = "btn btn-default" name = "submitmsg"> Send </button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">

	setInterval(runfunction, 1000);
	function runFunction()
	{
		$.post("htcont.php", {room: '<?php echo $roomname ?>'}, 
			function(data,status)
			{
           document.getElementsByClassName('anyClass')[0].innerHTML =data;
			}
			)
	}

// Get the input field
var input = document.getElementById("usermsg");

// Using enter key to trigger the messsage

input.addEventListener("keyup", function(event) {

  if (event.keyCode === 13) {

    event.preventDefault();

    document.getElementById("submitmsg").click();
  }
});



// IF USER SUBMITS THe FORM

                                                                              
$("#submitmsg").click(function(){
	var clientmsg = $("#usermsg").val();    
  $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>', ip : '<?php echo $_SERVER [' REMOTE_ADDR'] ?>'},

  function(data, status){
  	document.getElementsByClassName('anyClass')[0]. innerHTML = data;});
  $("#usermsg").val("");
return false;
  
    
});


</body>
</html>
