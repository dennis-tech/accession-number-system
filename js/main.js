let dateOptions = { timeZone: 'UTC', month: 'long', day: 'numeric', year: 'numeric' };
let leo = new Date();
let today = leo.toLocaleDateString('en-US', dateOptions);
var javar = '<?=$lastnumber?>';
console.log(javar);
let saveBtn = document.getElementById("save-btn");
let totalCalc = {
  calcNumber: 100,
  currentNumber: javar
}

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

saveBtn.addEventListener("click",function () {
  let selectedValue = document.getElementById("person").value;
  // let currNo = 

let arruy = [selectedValue, totalCalc.currentNumber, total];
  console.log(arruy);
  let src1 = "main.php?arruy=" + arruy[0] + "," + arruy[1]  + "," + arruy[2];
  window.location.href = src1;
})
