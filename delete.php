<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="customer"; // Database name 
$con=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 

mysqli_select_db($con,"$db_name")or die("cannot select DB");
$adminid=$_GET['id'];
$msg=mysqli_query($con,"delete from add_cust where id='$adminid'");
if($msg)
{
header("Location:index.php");
}


?>