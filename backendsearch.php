<?php
require 'config.php';
// search function with ajax
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    $query = "SELECT * FROM `storedata` WHERE `selected_person` LIKE '%$search%'";
    $result =  mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if($count == 0){
        echo "<h1>NO RESULTS FOUND</h1>";
    }else{
        echo "<p>";
        echo $count." results found";
        echo "</p>";
        
        
        
    }
}

?>