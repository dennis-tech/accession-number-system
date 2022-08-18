<!-- PHP -->
<?php 
session_start();
require_once "config.php";
$fetchsql = "SELECT MAX(numbers_to) FROM storedata";
$fetchresult = mysqli_query($conn, $fetchsql);
$lastrow = mysqli_fetch_array($fetchresult);




 date_default_timezone_set('Africa/Nairobi');
    if(isset($_GET['arruy'])){
    $data = explode (",", $_GET['arruy']);
    $selectedPerson = $data[0];
    $fromNo = $data[1];
    $toNo = $data[2];
    $currenttime = time();
    $currentdate = date("Y - m - d h:i", $currenttime);
    $sql = "INSERT INTO `storedata`(`selected_person`, `numbers_from`, `numbers_to`, `date`) VALUES ('$selectedPerson', '$fromNo', '$toNo', '$currentdate' ) ";
    $result = mysqli_query($conn, $sql);
    // adding $result to json file
    $json = json_encode($result);
    file_put_contents('./js/data.json', $json);
    
    $fetchsql = "SELECT MAX(numbers_to) FROM storedata";
$fetchresult = mysqli_query($conn, $fetchsql);
$lastrow = mysqli_fetch_array($fetchresult);
  
}


?>

<!-- HTML -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACCESSION NUMBER GENERATOR</title>
        <!-- <script type = "text/javascript" src = "js/jquery.min.js"></script> -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <!-- header -->
        <div class="header">
            <header>
                <img class="logo" src="nmk-logo.png" alt="national museums of kenya logo">
                <h1>NATIONAL MUSEUMS OF KENYA</h1>
                <h2>Paleontology Section</h2>
                <h3>ACCESSION CARD SYSTEM</h3>
            </header>
        </div>
        <!-- select person -->
        
            <div class="person" id="pers">
                    <label>Select Person</label>
                    <select id="person" > 
                            <option value="--Select Person--">--Select Person--</option>
                            <option value="Rose">Rose</option>
                            <option value="Yattich">Francis</option>
                            <option value="Pauline">Pauline</option>
                            <option value="Tom">Tom</option>
                            <option value="Faith">Dr. Manthi</option>
                            <option value="Patrick Gitonga">Ileny</option>
                            <option value="Cecilia">Cecilia</option>
                            <option value="Justus">Justus</option>
                    </select>        
            </div>
          <!-- buttons -->
            <div class="btn">
              <div>
                <button  class= "btn-btn" type="submit" onclick="generateNo()">GENERATE</button>
              </div>
              <div>
                <button type="submit" class= "btn-btn" id="save-btn">SAVE</button>
              </div>         
            </div>
            <!-- paragraph report -->
            <p id="accession-report"><br></p>

            <!-- logout btn -->
    <button class= "btn-btn"> <a href="logout.php">Log out</a> </button> 
  <div>
    <?php
 
    echo $lastrow[0];


    ?>
  </div>
    
    <!-- JAVASCRIPT -->
      <script>
        //get $lastrow[0] from php
        var lastrow = <?php echo $lastrow[0]; ?>;
        let dateOptions = { timeZone: 'UTC', month: 'long', day: 'numeric', year: 'numeric' };
        let leo = new Date();
        let today = leo.toLocaleDateString('en-US', dateOptions);
        let saveBtn = document.getElementById("save-btn");
        let totalCalc = {
          currentNumber:parseInt(lastrow), 
          calcNumber: 100
          
        }

        let generatedRepo = "";
        let numberReport = document.getElementById("accession-report");
        let total = totalCalc.currentNumber + totalCalc.calcNumber; 
        function generateNo() {
            let selectedValue = document.getElementById("person").value; 
            
                if (selectedValue === "--Select Person--") {
              alert ("You have not selected any person to assign to!");

            } else {      
              generatedRepo += `<li> <span class = "selectedperson"> ${selectedValue}</span> has been assigned numbers from 
              <span class = "currno">${totalCalc.currentNumber.toLocaleString()}</span> to <span class = "total">
              ${total.toLocaleString()}</span> on <span class = "today">${today}</span> </li>`;
              numberReport.innerHTML = generatedRepo;
            }
        }

        saveBtn.addEventListener("click",function () {
              let selectedValue = document.getElementById("person").value;
              let arruy = [selectedValue, totalCalc.currentNumber, total];
              if (selectedValue === "--Select Person--") {
                alert ("You have not selected any person to assign to!");
          
              } else {
              let src1 = "main.php?arruy=" + arruy[0] + "," + arruy[1]  + "," + arruy[2];
              window.location.href = src1;
              console.log(arruy);
              }
              
              
          
        });
      </script>
              
    </body>
</html>