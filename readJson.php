<?php 
 require_once "config.php";// open connection
 date_default_timezone_set('Africa/Nairobi');
 if(isset($_GET['arruy'])){
 $data = explode (",", $_GET['arruy']);
        $selectedPerson = $data[0];
    $fromNo = $data[1];
    $toNo = $data[2];
    $currenttime = time();
    $currentdate = date("Y-m-d h:i", $currenttime);
    $sql = "INSERT INTO `storedata`(`selected_person`, `numbers_from`, `numbers_to`, `date`) VALUES ('$selectedPerson', '$fromNo', '$toNo', '$currentdate' ) ";
    $result = mysqli_query($conn, $sql);
    $last_id = mysqli_insert_id($conn);
    $fetchsql = "SELECT * FROM storedata WHERE id= $last_id ";
    $fetchresult = mysqli_query($conn, $fetchsql);
    $row = mysqli_fetch_array($fetchresult);
    $lastnumber= $row["numbers_to"];
    
    }
   
?>