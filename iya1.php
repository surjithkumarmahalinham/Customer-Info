<?php
//iya1.php
$connect = mysqli_connect("localhost", "root", "", "customer");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM add_cust 
  WHERE photo LIKE '%".$search."%'
  OR fname LIKE '%".$search."%'
  OR lname LIKE '%".$search."%' 
  OR cityname LIKE '%".$search."%' 
  OR statename LIKE '%".$search."%'
  OR countryname LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM add_cust ORDER BY id ASC";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class = "table table-striped">
    <tr>
     <th>Profile</th>
     <th>First Name</th>
	 <th>Last Name</th>
     <th>City</th>
     <th>State</th>
	 <th>Country</th>
	 <th>Action</th>
			</tr>
 '; 
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td><img width=50 height:50 src="Photos/'.$row["photo"].'"</td></a>
	<td><b><a href=update.php?id=>'.$row["fname"].'</td></a></b>
    <td>'.$row["lname"].'</td>
    <td>'.$row["cityname"].'</td>
    <td>'.$row["statename"].'</td>
	<td>'.$row["countryname"].'</td>
	<td><a href=update.php?id='.$row["id"].'> 
    <button class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></button></a>
	<a href=delete.php?id='.$row["id"].'> 
                                <button class="btn btn-danger btn-xs" onClick="return confirm("Do you really want to delete");">
								<span class="glyphicon glyphicon-trash"></i></button></a>
                              </td>							
	
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>