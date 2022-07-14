// getting input from html
let valReport = document.getElementById("report");
let assign_val1 = document.getElementById("assignfrom").value;
// let selectedValue = document.getElementById("person").value;
// 
let num_1  = assign_val1;
let sum = 100;
// date
let dateOptions = { timeZone: 'UTC', month: 'long', day: 'numeric', year: 'numeric' };
let leo = new Date();
let today = leo.toLocaleDateString('en-US', dateOptions);
// calling functions
// issueNo ();
// assignPerson ();
// report_p ();


// calculation of assigning 100 numbers from the set number
function issueNo (){
    // var number = 100;
    // let num_1  = assign_val1;
    // let sum = 100; 
    // while (number <= 200) {
    //     number += prompt ("Error enter a number from 201 to start!");
    // }
    do {
        sum = num_1 >= 0 ? sum += num_1 : sum;

    }while ( num_1 >= 200){
        report_p ();
    }
//  assignPerson ();
}

// var number = 100;
// let assign_val2 = assign_val1 + number; 
// console.log(assign_val2);
// funcion to assign person numbers 
function assignPerson () {
    let selectedValue = document.getElementById("person").value;
    if (selectedValue === "--Select Person--") {
        alert ("You have not selected any person to assign to!");
    } else {
        report_p ();
    }
    // valReport.textContent += selectedValue + " was issued numbers from : " + assign_val1 + " to numbers upto : " + assign_val2 + " on "   + today + "\n";
}

function report_p () {
    valReport.textContent += selectedValue + " was issued numbers from : " + assign_val1 + " to numbers upto : " + issueNo.sum + " on "   + today + "\n";
}
// var num = 0, sum = 0, count = 0; 
// do { 
// num = parseInt(prompt('Enter Number')); 
// sum = num >= 0 ? sum+=num : sum; 
// count = num >= 0 ? count+=1: count; } 
// while(num >= 0);
// console.log(sum + ' count is ' + count);
// console.log(sum/count);