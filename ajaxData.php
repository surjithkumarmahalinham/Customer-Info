<?php
//Include database configuration file
include('dbConfig.php');

if(isset($_POST["countryid"]) && !empty($_POST["countryid"])){
    //Get all state data
    $query = $con->query("SELECT * FROM state WHERE countryid = ".$_POST['countryid']." AND active_flag = 1 ORDER BY statename ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['stateid'].'">'.$row['statename'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["stateid"]) && !empty($_POST["stateid"])){
    //Get all city data
    $query = $con->query("SELECT * FROM city WHERE stateid = ".$_POST['stateid']." AND active_flag = 1 ORDER BY cityname ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['cityid'].'">'.$row['cityname'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>