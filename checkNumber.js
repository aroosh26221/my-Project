var age = prompt("Enter your age (numbers only):");
for(;;){
if (isNaN(age)) {
  alert("Please enter a number!");
  age = prompt("Try again:");}
else {break;}}
document.write("Your age is: " + age);
