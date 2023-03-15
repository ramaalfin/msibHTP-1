// Mendapatkan elemen HTML yang diperlukan
const display = document.getElementById("display");
const buttons = document.querySelectorAll("button");

// Mendefinisikan variabel yang diperlukan
let num1 = "";
let num2 = "";
let operator = "";
let result = "";

// Mendefinisikan fungsi yang diperlukan
function inputNumber(number) {
    if (result) {
        clearDisplay();
    }
    if (operator) {
        num2 += number;
        display.value = num2;
    } else {
        num1 += number;
        display.value = num1;
    }
}

function operators(op) {
    if (num1) {
        operator = op;
        display.value = operator;
    }
}

function calculate() {
    if (num2) {
        switch (operator) {
            case "+":
                result = parseFloat(num1) + parseFloat(num2);
                break;
            case "-":
                result = parseFloat(num1) - parseFloat(num2);
                break;
            case "*":
                result = parseFloat(num1) * parseFloat(num2);
                break;
            case "/":
                result = parseFloat(num1) / parseFloat(num2);
                break;
            case "^":
                result = Math.pow(parseFloat(num1), parseFloat(num2));
                break;
        }
        display.value = result;
        num1 = result;
        num2 = "";
        operator = "";
    }
}

function clearDisplay() {
    display.value = "";
    num1 = "";
    num2 = "";
    operator = "";
    result = "";
}