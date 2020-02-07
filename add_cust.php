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
	  <title>Add Customer</title>
   </head>
   
   <body>
      <div class = "container">
      <h3 class="glyphicon glyphicon-user">AddCustomer</h3><br><br>
        <form method="post" enctype="multipart/form-data" autocomplete="off"> 
        <label>First Name</label><input style="border-left:5px solid #00b300; width:500px;" type="text" class="form-control" name="fname"><br>
		<label>Last Name </label><input style="border-left:5px solid #00b300; width:500px;" type="text" class="form-control" name="lname"><br>
		<label>Gender </label><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;<input type="radio" name="gender" value="Male" >Male
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="gender" value="FeMale" >Female<br><br>
		<label>Email</label> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" class="form-control" name="email" ><br>
	
		<label> Region:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="region" id="txtRegion" class="form-control"/><br>
		
		<label> Country:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="countryname" id="txtCountry" class="form-control"/><br>
		
		<label> State:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="statename" id="txtState" class="form-control"/><br>
		
		<label> City:</label><br/> 
		<input style="border-left:5px solid #00b300; width:500px;" type="text" name="cityname" id="txtCity" class="form-control"/><br>
		
		<label >Picture</label><input type="file" name="fi" style="width:400px;" value="" >
		
            <table><tr>
            
		<div style="margin-left:300px;"><br>
		<td><a href="index.php" style="margin-left:350px;" class="btn btn-default">Cancel</a></td>
            <td><input style="margin-left:30px;" type="submit" name="submit" value="Add" class="btn btn-success" style="width:100px;"></div></td></tr>
		</table>
			
		</form>

<?php

$con=new mysqli("localhost","root","","customer"); 

if(isset($_POST["submit"]))
{
	session_start();
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$gender=$_POST["gender"];
	$email=$_POST["email"];
	$region=$_POST["region"];
	$address=$_POST["countryname"];
	$city=$_POST["cityname"];
	$state=$_POST["statename"];
	
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

        $sql = 
		      "INSERT 
			        INTO 
					     add_cust
						 (fname,lname,gender,email,region,countryname,cityname,statename,photo) 
					VALUES 
					     ('$fname','$lname','$gender','$email','$region','$address','$city','$state','$final_file1')
				    ";
	if($con->query($sql))
	{
		
    echo "<script>alert('Successfully Added');window.location.href='';  </script>";
	$query="select * from add_cust";
	$result=$con->query($query);
	
	}

	else 
	{
    echo "Error2: <br>" . $con->error;
	}
	}
}
?>			
		
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