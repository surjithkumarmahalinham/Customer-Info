<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="customer"; // Database name 
$con=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 

mysqli_select_db($con,"$db_name")or die("cannot select DB");

if(isset($_POST['delete']))
{
$adminid=$_GET['id'];
$msg=mysqli_query($con,"delete from add_cust where id='$adminid'");
if($msg)
{
echo "<script>alert('Data deleted');</script>";
header("Location:index.php");
}
}

?>

<?php


if(isset($_POST["update"]))
{   
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$gender=$_POST["gender"];
	$email=$_POST["email"];
	$region=$_POST["region"];
	$city=$_POST["cityname"];
	$state=$_POST["statename"];
	$country=$_POST["countryname"];
	
	$file1 = rand(1000,100000)."-".$_FILES['fi']['name'];
    $file_loc1 = $_FILES['fi']['tmp_name'];
	$file_size1 = $_FILES['fi']['size'];
	$file_type1 = $_FILES['fi']['type'];
	$folder1="Photos/";
	
	// new file size in KB
	$new_size1 = $file_size1/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name1 = strtolower($file1);
	// make file name in lower case
	
	$final_file1=str_replace(' ','-',$new_file_name1);
	
	if(move_uploaded_file($file_loc1,$folder1.$final_file1))
	{

	
	$msg1=mysqli_query($con,"update add_cust set fname='$fname' ,lname='$lname' ,gender='$gender' ,email='$email' ,region='$region',
	cityname='$city',statename='$state',countryname='$country',photo='$final_file1' where id='".$_GET['id']."'");
if($msg1)
{
echo "<script>alert('Successfully Updated');window.location.href='';  </script>";
}
	}
}
?>

<?php $ret=mysqli_query($con,"select * from add_cust where id='$_GET[id]'");
	      while($row=mysqli_fetch_array($ret))
	  
	  {?>


<html lang = "en">
   <head>
      <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
      <title>View</title>
   </head>
   
   <body>
      <div class = "container">
      <h3 class="glyphicon glyphicon-user"><?php echo $row['fname'].$row['lname'];?></h3><br><br>
        <form method="post" enctype="multipart/form-data" autocomplete="off"> 
        <label>First Name</label><input style="border-left:5px solid #00b300; width:500px;" type="text" class="form-control" name="fname" value="<?php echo $row['fname'];?>"><br>
		<label>Last Name </label><input style="border-left:5px solid #00b300; width:500px;" type="text" class="form-control" name="lname" value="<?php echo $row['lname'];?>"><br>
		<label>Gender </label><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;<input type="radio" name="gender" value="Male" >Male
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="FeMale" >Female<br><br>
		<label>Email</label> <input style="border-left:5px solid #00b300; width:500px;" type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"><br>
		
		<label> Region:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="region" id="txtRegion" class="form-control" value="<?php echo $row['region'];?>"/><br>
		
		<label> Country:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="countryname" id="txtCountry" class="form-control" value="<?php echo $row['countryname'];?>"/><br>
		
		<label> State:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="statename" id="txtState" class="form-control" value="<?php echo $row['statename'];?>"/><br>
		
		<label> City:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="cityname" id="txtCity" class="form-control" value="<?php echo $row['cityname'];?>"/><br>
		<br>
		<label>Picture</label><input type="file" name="fi" style="width:400px;" value="">
		<table><tr>
            <td><input type="submit" name="delete" value="Delete" class="btn btn-danger" style="width:80px;"></div>	</td>
		<div style="margin-left:300px;"><br>
		<td><a href="index.php" style="margin-left:250px;" class="btn btn-default">Cancel</a></td>
            <td><input style="margin-left:30px;" type="submit" name="update" value="Update" class="btn btn-success" style="width:100px;"></div></td></tr>
		</table>
		</form>

	  <?php } ?>
	
<script>
    $(document).ready(function () {
        $('#txtRegion').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "server2.php",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "server.php",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
    });
</script>
		
<script>
    $(document).ready(function () {
        $('#txtState').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "server1.php",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
    });
</script>
		
<script>
    $(document).ready(function () {
        $('#txtCity').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "server3.php",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
    });
</script>
	
   </body>
</html>