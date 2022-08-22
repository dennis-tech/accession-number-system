<?php
require_once "config.php";
//to get data from the storedata table
$query = "SELECT * FROM `storedata`";
$result =  mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCESSIONED NUMBERS REPORT</title>
    <!-- link to style.css -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>ACCESSIONED NUMBERS REPORT</h1>
    <!-- creating a table to display the data -->
    <!-- adding a table search option -->
    <div class="search">
        <input type="text" name="search" id="search" placeholder="Search.." autocomplete="off">
        <div class="result"></div>  
    </div>
      
    
    
    <table id="myTable">
        <tr id=" tr">
            <th>ID</th>
            <th>SELECTED PERSON</th>
            <th>FROM NUMBERS</th>
            <th>TO NUMBERS</th>
            <th>DATE</th>
        </tr>
        <?php
        // looping through the data and displaying it in the table
        while($row = mysqli_fetch_array($result)){
            echo "<tr >";
            // here we are displaying the data in the table
            echo "<td class= 'tabletr'>".$row['id']."</td>";
            echo "<td class= 'tabletr'>".$row['selected_person']."</td>";
            echo "<td class= 'tabletr'>".number_format($row['numbers_from'])."</td>";
            echo "<td class= 'tabletr'>".number_format($row['numbers_to'])."</td>";
            echo "<td class= 'tabletr'>".$row['date']."</td>";
            echo "</tr>";
        }
        
        
        
        echo "</table>";
        

        
        
        

        ?>
    </table>
    <!-- script tags src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous" -->
    <script src="js/jquery.min.js" >
        $(document).ready(function(){
                $(".search").on("keyup input", function(){
                    
                    
                var input = $(this).val();
                var result = $(this).siblings(".result");
                if(input.length){
                    $.get("backendsearch.php", {term: input}).done(function(data){
                        result.html(data);
                    });
                } else {
                    result.empty();
                    
                }
                
            });
            // set search value on click of result item
            $(document).on("click", ".result p", function(){
                        $(this).parents(".search").find("input[type='text']").val($(this).text());
                        $(this).parent(".result").empty();
                    });
        });
    </script>

        
</body>
</html>