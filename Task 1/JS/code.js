document.forms[0].submit.disabled=true;
let code_input = document.getElementById("code_input");
let code_label = document.getElementById("code_label");
code_input.addEventListener("blur", function () {
    if (code_input.value == code_label.textContent) {
        document.forms[0].submit.disabled=false;
    }    
})