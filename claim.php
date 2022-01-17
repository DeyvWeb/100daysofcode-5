<?php

//Creating a Realtime PHP Chatroom using PHP & Jquery 

//Getting the value of post parameters

$room = $_POST['room'];

//Checking for string size

if(strlen($room)>20 or strlen($room)<2)
{
	$message = "Please choose a name between 2 to 20 characters";

//Displaying javascript using echo as message as variable

	echo '<script language="javascript">'; 
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';  
    echo '</script>'; 

    //how to alert javascript in php
}

//Checking whether room name is alphanumeric

elseif (!ctype_alnum($room)) 
{
	$message = "Please choose an alphanumeric room name";
   
    //Displaying javascript using echo as message as variable
   
    echo '<script language="javascript">'; 
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';  
    echo '</script>'; //how to alert javascript in php
} 

else 
{
	//Connecting to the database
	include 'db_connect.php';
}

//Check if already room exists

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);

if($result)
{
	if(mysqli_num_rows($result) > 0)
	{
		$message = "Please choose a different room name. This room is already claimed";

    //Displaying javascript using echo as message as variable
   
    echo '<script language="javascript">'; 
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';  
    echo '</script>'; //how to alert javascript in php
	}
	else
	{
		$sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', CURRENT_TIMESTAMP);";
		
		if (mysqli_query($conn, $sql))
		{ 
			$message = "Your room is ready and you can chat now!";

		echo '<script language="javascript">'; //Displaying javascript using echo as message as variable

	    echo 'alert("'.$message.'");';
	    echo 'window.location="http://localhost/Chatroom/  rooms.php?roomname = ' . $room. '";';  
	    echo '</script>'; //how to alert javascript in php
		}
	}
}

else
{
	echo "Error: ".mysqli_server($conn);
}

?>