//var inputID = document.forms["loginForm"]["inputNRICFIN"];
//var inputPass = document.forms["loginForm"]["inputPassword"];
var inputNRIC = document.getElementById("inputNRICFIN");
var inputPass = document.getElementById("inputPassword");
var isNric = false;
var isPass = false;

const nricHandler = function(e) {
    if (e.target.value.length == 9) {
        isNric = true;
    } else {
        isNric = false;
    }

    if (isNric && isPass) {
        enableButton(false);
    } else {
        enableButton(true);
    }
}

const passHandler = function(e) {
    if (e.target.value.length >= 8) {
        isPass = true;
    } else {
        isPass = false;
    }

    if (isNric && isPass) {
        enableButton(false);
    } else {
        enableButton(true);
    }
}

function enableButton(isEnable) {
    document.getElementById("sign-in-button").disabled = isEnable;
}

inputNRIC.addEventListener('input', nricHandler);
inputNRIC.addEventListener('propertychange', nricHandler);

inputPass.addEventListener('input', passHandler);
inputPass.addEventListener('propertychange', passHandler);

// function validateInputs() {
    //window.alert("Please enter your name");
    // var name = document.forms["SurveyForm"]["Name"];
    // var email = document.forms["SurveyForm"]["Email"];
    // var age = document.forms["SurveyForm"]["Age"];
    // var course = document.forms["SurveyForm"]["Course"];

    // if ((name.value).trim() === "") {
    //     window.alert("Please enter your name");
    //     name.focus();
    //     return false;
    // }
    
    // if ((email.value).trim() === "") {
    //     window.alert("Please enter your email address");
    //     email.focus();
    //     return false;
    // } else {
    //     var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    //     if (!regex.test(email.value)) {
    //         window.alert("You have entered an invalid email address");
    //         email.focus();
    //         return false;
    //     }
    // }

    // if ((age.value).trim() === "") {
    //     window.alert("Please enter your age");
    //     age.focus();
    //     return false;
    // } else {
    //     if (isNaN(age.value)) {
    //         window.alert("Please enter number only");
    //         age.focus();
    //         return false;
    //     }
    // }

    // if (course.selectedIndex < 1 || 
    //         course[course.selectedIndex].value === 0) {
    //     window.alert("Please select a Course");
    //     course.focus();
    //     return false;
    // }

    // var nameValue = (name.value).trim();
    // var emailValue = (email.value).trim();
    // var ageValue = Number(age.value);
    // var courseValue = course[course.selectedIndex].value;
    // var courseText = course[course.selectedIndex].text;
    // var message = nameValue + ", " + emailValue + ", " + ageValue 
    //         + ", " + courseValue + ", " + courseValue + " - " + courseText;
    // window.alert(message);
    // return true; 
// }