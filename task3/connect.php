 <?php
$host ="localhost";
$user_name ="root";
$password ="";
$db ="crudy";
$connect = new mysqli($host ,$user_name ,$password ,$db);
if($connect->connect_error)
echo"connection failed" .$connect->connect_error;
?>