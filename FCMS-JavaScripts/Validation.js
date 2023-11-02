
// Validation.js

// Sign Up page validation
function validateSignUp() {
    var username = document.getElementById("husername").value;
    var password = document.getElementById("hpass").value;
    var confpass = document.getElementById("hconfpass").value;

    // Reset any previous error messages
    document.getElementById("username_err").textContent = "";
    document.getElementById("password_err").textContent = "";
    document.getElementById("confpass_err").textContent = "";

    // Check if the username is empty or contains only spaces
    if (username.trim() === "") {
        showError("username_err", "Username is required.");
        return false;
    }

    // Check if the username is not more than 20 characters
    if (username.length > 20) {
        showError("username_err", "Username should not be more than 20 characters.");
        return false;
    }

    // Check if the username is available
    if (existingUsernames.includes(username)) {
        showError("username_err", "Username is already taken.");
        return false;
    }

    // Check if the password is empty or contains spaces
    if (password.trim() === "" || /\s/.test(password)) {
        showError("password_err", "Password is required and should not contain spaces.");
        return false;
    }

    // Check if the password is not less than 8 characters
    if (password.length < 8) {
        showError("password_err", "Password should be at least 8 characters.");
        return false;
    }

    // Check if the confirm password matches the password
    if (confpass.trim() === "") {
        showError("confpass_err", "Confirm Password is required.");
        return false;
    }

    // Check if the confirm password matches the password
    if (password !== confpass) {
        showError("confpass_err", "Passwords do not match.");
        return false;
    }

    return true;
}

function showError(id, message) {
    var errorElement = document.getElementById(id);
    errorElement.textContent = message;
    errorElement.style.color = "red"; // Change the color to red
    errorElement.style.animation = "popup 0.3s ease-in-out"; // Add a pop-up animation

    setTimeout(function () {
        errorElement.style.animation = "";
    }, 300);
}

var errors = []; // This will hold all error messages

function validateForm() {
    errors = []; // Clear previous errors

    checkFirstName('hfname');
    checkLastName('hlname');
    checkEmail('hemail');
    checkPhone('hphone');
    checkStreetAddress('hstreetadd');
    checkCity('hcity');
    checkState('hstate');
    checkPostcode('hpostcode');

    // Check if there are any errors
    if (errors.length > 0) {
        alert(errors.join("\n")); // Display all errors together
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}

function checkFirstName(hfname) {
    var input = document.getElementById(hfname);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('First Name cannot be empty');
        highlightError(input);
    } else if (!/^[A-Za-z]+$/.test(inputValue)) {
        errors.push('First Name should contain only alphabet characters');
        highlightError(input);
    } else if (inputValue.length > 20) {
        errors.push('First Name length should not be more than 20 characters');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function checkLastName(hlname) {
    var input = document.getElementById(hlname);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('Last Name cannot be empty');
        highlightError(input);
    } else if (!/^[A-Za-z]+$/.test(inputValue)) {
        errors.push('Last Name should contain only alphabet characters');
        highlightError(input);
    } else if (inputValue.length > 20) {
        errors.push('Last Name length should not be more than 20 characters');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function checkEmail(hemail) {
    var input = document.getElementById(hemail);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('Email cannot be empty');
        highlightError(input);
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(inputValue)) {
        errors.push('Invalid Email format');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function checkPhone(hphone) {
    var input = document.getElementById(hphone);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('Phone cannot be empty');
        highlightError(input);
    } else if (!/^[0-9+]+$/.test(inputValue)) {
        errors.push('Phone should contain only numbers and the "+" symbol');
        highlightError(input);
    } else if (inputValue.length > 15) {
        errors.push('Phone length should not be more than 15 characters');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function checkStreetAddress(hstreetadd) {
    var input = document.getElementById(hstreetadd);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('Street Address cannot be empty');
        highlightError(input);
    } else if (!/^[A-Za-z\s]+$/.test(inputValue)) {
        errors.push('Street Address should contain only alphabet characters and spaces');
        highlightError(input);
    } else if (inputValue.length > 50) { // increased the max length for street addresses
        errors.push('Street Address length should not be more than 50 characters');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function checkCity(hcity) {
    var input = document.getElementById(hcity);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('City cannot be empty');
        highlightError(input);
    } else if (!/^[A-Za-z\s]+$/.test(inputValue)) {
        errors.push('City should contain only alphabet characters and spaces');
        highlightError(input);
    } else if (inputValue.length > 30) {
        errors.push('City length should not be more than 30 characters');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function checkState(hstate) {
    var input = document.getElementById(hstate);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('State cannot be empty');
        highlightError(input);
    } else if (!/^[A-Za-z\s]+$/.test(inputValue)) {
        errors.push('State should contain only alphabet characters and spaces');
        highlightError(input);
    } else if (inputValue.length > 30) {
        errors.push('State length should not be more than 30 characters');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function checkPostcode(hpostcode) {
    var input = document.getElementById(hpostcode);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        errors.push('Postcode cannot be empty');
        highlightError(input);
    } else if (!/^[0-9]+$/.test(inputValue)) {
        errors.push('Postcode should contain only numbers');
        highlightError(input);
    } else if (inputValue.length > 10) {
        errors.push('Postcode length should not be more than 10 characters');
        highlightError(input);
    } else {
        removeHighlight(input);
    }
}

function highlightError(element) {
    element.style.borderColor = 'red';
}

function removeHighlight(element) {
    element.style.borderColor = '';
}


// function validateSignUp() {
//     var userNameValid = checkUserName('husername');


//     // Check if all validations pass
//     if (userNameValid) {
//         return true; // Allow form submission
//     } else {
//         return false; // Prevent form submission
//     }
// }

// function checkUserName(husername) {
//     // Get the input element by its ID
//     var input = document.getElementById(husername);
//     // Get the value of the input
//     var inputValue = input.value.trim();

//     // Check if the input is empty
//     if (inputValue === '') {
//         alertAndHighlight(input, 'Username cannot be empty', 'error');
//         return false;
//     }

//     // Check if the input contains only alphabet characters
//     var alphabetPattern = /^[A-Za-z]+$/;
//     if (!alphabetPattern.test(inputValue)) {
//         alertAndHighlight(input, 'Username should contain only alphabet characters', 'error');
//         return false;
//     }

//     // Check if the input length is not more than 20
//     if (inputValue.length < 8) {
//         alertAndHighlight(input, 'Username length should not be more than 20 characters', 'error');
//         return false;
//     }

//     // If all checks pass, remove the highlighting and set the border color to green
//     removeHighlight(input);
//     return true;
// }

// function validateSignUp() {
//     var username = document.forms["form"]["husername"].value;
//     var password = document.forms["form"]["hpass"].value;
//     var confpass = document.forms["form"]["hconfpass"].value;
//     var usernameRegex = /^[A-Za-z]{1,20}$/;

//     // Reset previous error messages
//     document.getElementById("username_err").textContent = "";
//     document.getElementById("password_err").textContent = "";
//     document.getElementById("confpass_err").textContent = "";

//     // Validate username
//     if (username === "") {
//         document.getElementById("username_err").textContent = "Username is required.";
//         return false;
//     } else if (!username.match(usernameRegex)) {
//         document.getElementById("username_err").textContent = "Username should only contain alphabetic characters and be up to 20 characters long.";
//         return false;
//     }

//     // Validate password
//     if (password === "") {
//         document.getElementById("password_err").textContent = "Password is required.";
//         return false;
//     } else if (password.length < 8) {
//         document.getElementById("password_err").textContent = "Password should be at least 8 characters long.";
//         return false;
//     }

//     // Validate confirm password
//     if (confpass === "") {
//         document.getElementById("confpass_err").textContent = "Confirm Password is required.";
//         return false;
//     } else if (confpass !== password) {
//         document.getElementById("confpass_err").textContent = "Passwords do not match.";
//         return false;
//     }
//     return true;
// }
// function validateSignUp()
// {
//     var userNameValid = checkUsername('husername');
//     if (userNameValid) {
//         return true; // Allow form submission
//     } else {
//         return false; // Prevent form submission
//     }

// }

// function checkUsername(husername) {
//     var input = document.getElementsByName(husername);
//     var inputValue = input.value.trim();

//     // Check if the input is empty
//     if (inputValue === '') {
//         alertAndHighlight(input, 'Username cannot be empty', 'error');
//         return false;
//     }

//     // Check if the username contains only alphabet characters
//     var alphabetPattern = /^[A-Za-z]+$/;
//     if (!alphabetPattern.test(inputValue)) {
//         alertAndHighlight(input, 'Username should contain only alphabet characters', 'error');
//         return false;
//     }

//     // Check if the username has a minimum threshold of 8 characters
//     if (inputValue.length < 8) {
//         alertAndHighlight(input, 'Username should be at least 8 characters long', 'error');
//         return false;
//     }

//     removeHighlight(input);
//     return true;
// }


function alertAndHighlight(input, message, status) {
    alert(message);
    if (status === 'error') {
        input.style.borderColor = 'red'; // Change border color to red for errors
        input.style.borderRadius = '5px'; // Add border radius for errors
    }
}

function removeHighlight(input) {
    input.style.borderColor = 'green'; // Change border color to green for correct inputs
    input.style.borderRadius = '5px'; // Add border radius for correct inputs
}


