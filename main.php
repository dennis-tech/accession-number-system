<!-- PHP -->
<?php 
session_start();
require_once "config.php";
$fetchsql = "SELECT MAX(numbers_to) FROM storedata";
$fetchresult = mysqli_query($conn, $fetchsql);
$lastrow = mysqli_fetch_array($fetchresult);
$lastrow[0]++;




 date_default_timezone_set('Africa/Nairobi');
   // NMK
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
    header("Location: main.php");

    // TBI      
} else if(isset($_GET['arruy2'])){
    $data2 = explode (",", $_GET['arruy2']); 
    $selectedPerson2 = $data2[0];
    $fromNo2 = $data2[1];
    $toNo2 = $data2[2];
    $currenttime2 = time();
    $currentdate2 = date("Y - m - d h:i", $currenttime2);
    $sqltbi = "INSERT INTO `storedata`(`selected_person`, `numbers_from`, `numbers_to`, `date`) VALUES ('$selectedPerson2', '$fromNo2', '$toNo2', '$currentdate2' ) ";
    $resulttbi = mysqli_query($conn, $sqltbi);
    // adding $result to json file
    $jsontbi = json_encode($resulttbi);
    file_put_contents('./js/data.json', $jsontbi);
    
    // $fetchsqltbi = "SELECT MAX(numbers_to) FROM storedata";
    // $fetchresult = mysqli_query($conn, $fetchsql);
    // $lastrow = mysqli_fetch_array($fetchresult);
    header("Location: main.php");

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
                <h3>ACCESSION NUMBER SYSTEM</h3>
            </header>
        </div>
        <!-- select person -->
        
            <div class="person" id="pers">
                    <label>Select Person</label>
                    <select id="person" > 
                            <option value="--Select Person--">--Select Person--</option>
                            <option value="Rose">Rose</option>
                            <option value="Yattich">Yattich</option>
                            <option value="Pauline">Pauline</option>
                            <option value="Tom">Tom</option>
                            <option value="Faith">Faith</option>
                            <option value="Patrick Gitonga">Patrick Gitonga</option>
                            <option value="Cecilia">Cecilia</option>
                            <option value="Justus">Justus</option>
                            <option value="TBI">TBI</option>
                    </select>        
            </div>
          <!-- buttons -->
            <div class="btn">
              <div>
                <button  class= "btn-btn btn-right" type="submit" onclick="generateNo()">GENERATE</button>
              </div>
              <div>
                <button type="submit" class= "btn-btn" id="save-btn">SAVE</button>
              </div>         
            </div>
            
            <!-- paragraph report -->
            <p id="accession-report"><br></p>

            <!-- logout/report btn -->
            <div class="btn">
              <div>
                <button class="btn-btn btn-right" type="submit"><a href="report.php">VIEW REPORT</a></button>
              </div>

              <div>
                <button class= "btn-btn" type="submit"> <a href="logout.php">LOG OUT</a> </button> 
              </div>

            </div>
   
    
    <!-- JAVASCRIPT -->
      <script>
        //get $lastrow[0] from php
        var lastrow = <?php echo $lastrow[0]; ?>;
        let dateOptions = { timeZone: 'UTC', month: 'long', day: 'numeric', year: 'numeric' };
        let leo = new Date();
        let today = leo.toLocaleDateString('en-US', dateOptions);
        let saveBtn = document.getElementById("save-btn");
        // NMK CALCULATIONS
        let totalCalc = {
          currentNumber:parseInt(lastrow), 
          calcNumber: 100          
        }
        // TBI CALCULATIONS
        let totalTbi = {
          currentNumber:20000, 
          calcNumber: 20000         
        }

        let generatedRepo = "";
        let numberReport = document.getElementById("accession-report");
        let tbiTotal = totalTbi.currentNumber + totalTbi.calcNumber;
        let total = totalCalc.currentNumber + totalCalc.calcNumber; 
        function generateNo() {
            let selectedValue = document.getElementById("person").value; 
            
                if (selectedValue === "--Select Person--") {
              alert ("You have not selected any person to assign to!");

            } else if(selectedValue === "TBI"){
              generatedRepo += `<li> <span class = "selectedperson"> ${selectedValue}</span> has been assigned numbers from 
              <span class = "currno">${totalTbi.currentNumber.toLocaleString()}</span> to <span class = "total">
              ${tbiTotal.toLocaleString()}</span> on <span class = "today">${today}</span> </li>`;
              numberReport.innerHTML = generatedRepo;
            }
            else {
              generatedRepo += `<li> <span class = "selectedperson"> ${selectedValue}</span> has been assigned numbers from 
              <span class = "currno">${totalCalc.currentNumber.toLocaleString()}</span> to <span class = "total">
              ${total.toLocaleString()}</span> on <span class = "today">${today}</span> </li>`;
              numberReport.innerHTML = generatedRepo;
            }     
              
            }

        saveBtn.addEventListener("click",function () {
              let selectedValue = document.getElementById("person").value;
              let arruy = [selectedValue, totalCalc.currentNumber, total];
              let arruy2 = [selectedValue, totalTbi.currentNumber, tbiTotal];
              if (selectedValue === "--Select Person--") {
                alert ("You have not selected any person to assign to!");
          
              } else if(selectedValue === "TBI"){
                let src2 = "main.php?arruy2=" + arruy2[0] + "," + arruy2[1]  + "," + arruy2[2];
                window.location.href = src2;
                console.log(arruy2);
              }
              
              else {
              let src1 = "main.php?arruy=" + arruy[0] + "," + arruy[1]  + "," + arruy[2];
              window.location.href = src1;
              console.log(arruy);
              }
              
              
          
        });
      </script>
              
    </body>
</html>