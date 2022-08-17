let dateOptions = { timeZone: 'UTC', month: 'long', day: 'numeric', year: 'numeric' };
let leo = new Date();
let today = leo.toLocaleDateString('en-US', dateOptions);

// window.location.href = "main.php?wiwi";

let totalCalc = {
  calcNumber: 100,
  currentNumber: 79901
}
// console.log(totalCalc.coolValue.value);
let generatedRepo = "";
let numberReport = document.getElementById("number");
let total = totalCalc.currentNumber  + totalCalc.calcNumber; 
function generateNo () {
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
function saveNo() {
  let selectedValue = document.getElementById("person").value;
  
}



