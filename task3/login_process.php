<?php
include "config/db.php";
$username=$_POST['username'];
$pass=$_POST ['pass'];
$sql="SELECT*FROM users where username =? ";
$stat =$conn->prepare($sql);
$stat->bind_param("s",$username);
$stat->execute();
$result= $stat->get_result();
$user=$result->fetch_assoc();
    if($user && $pass==$user['password']){
        echo "hello".$user['username'];
         header("location:index.php");
    }else{
        header("location:login.php?error=data not found");
    }

















