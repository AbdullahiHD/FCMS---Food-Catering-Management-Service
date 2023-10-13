
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

    // Check if the username is available
    var isAvailable = isUsernameAvailable(username);
    if (!isAvailable) {
        showError("username_err", "Username is already taken.");
        return false;
    }
    
    return true;
}

// function isUsernameAvailable(username) {
    
//     return checkUsernameAvailabilityInDatabase(username);
// }

function showError(id, message) {
    var errorElement = document.getElementById(id);
    errorElement.textContent = message;
    errorElement.style.color = "red"; // Change the color to red
    errorElement.style.animation = "popup 0.3s ease-in-out"; // Add a pop-up animation

    setTimeout(function () {
        errorElement.style.animation = "";
    }, 300);
}

function validateForm() {
    var firstNameValid = checkFirstName('hfname');
    var lastNameValid = checkLastName('hlname');
    var emailValid = checkEmail('hemail');
    var phoneValid = checkPhone('hphone');
    var addressValid = checkStreetAddress('hstreetadd');
    var cityValid = checkCity('hcity');
    var stateValid = checkState('hstate');
    var postcodeValid = checkPostcode('hpostcode');

    // Check if all validations pass
    if (firstNameValid && lastNameValid && emailValid && phoneValid && addressValid && cityValid && stateValid && postcodeValid) {
        return true; // Allow form submission
    } else {
        return false; // Prevent form submission
    }
}

function checkFirstName(hfname) {
    // Get the input element by its ID
    var input = document.getElementById(hfname);
    // Get the value of the input
    var inputValue = input.value.trim();

    // Check if the input is empty
    if (inputValue === '') {
        alertAndHighlight(input, 'First Name cannot be empty', 'error');
        return false;
    }

    // Check if the input contains only alphabet characters
    var alphabetPattern = /^[A-Za-z]+$/;
    if (!alphabetPattern.test(inputValue)) {
        alertAndHighlight(input, 'First Name should contain only alphabet characters', 'error');
        return false;
    }

    // Check if the input length is not more than 20
    if (inputValue.length > 20) {
        alertAndHighlight(input, 'First Name length should not be more than 20 characters', 'error');
        return false;
    }

    // If all checks pass, remove the highlighting and set the border color to green
    removeHighlight(input);
    return true;
}

function checkLastName(hlname) {
    // Get the input element by its ID
    var input = document.getElementById(hlname);
    // Get the value of the input
    var inputValue = input.value.trim();

    // Check if the input is empty
    if (inputValue === '') {
        alertAndHighlight(input, 'Last Name cannot be empty', 'error');
        return false;
    }

    // Check if the input contains only alphabet characters
    var alphabetPattern = /^[A-Za-z]+$/;
    if (!alphabetPattern.test(inputValue)) {
        alertAndHighlight(input, 'Last Name should contain only alphabet characters', 'error');
        return false;
    }

    // Check if the input length is not more than 20
    if (inputValue.length > 20) {
        alertAndHighlight(input, 'Last Name length should not be more than 20 characters', 'error');
        return false;
    }

    // If all checks pass, remove the highlighting and set the border color to green
    removeHighlight(input);
    return true;
}

function checkEmail(hemail) {
    // Get the input element by its ID
    var input = document.getElementById(hemail);
    // Get the value of the input
    var inputValue = input.value.trim();

    // Check if the input is empty
    if (inputValue === '') {
        alertAndHighlight(input, 'Email cannot be empty', 'error');
        return false;
    }

    // Check if the input contains the "@" symbol
    if (inputValue.indexOf('@') === -1) {
        alertAndHighlight(input, 'Email should contain the "@" symbol', 'error');
        return false;
    }

    // If all checks pass, remove the highlighting and set the border color to green
    removeHighlight(input);
    return true;
}

function checkPhone(hphone) {
    // Get the input element by its ID
    var input = document.getElementById(hphone);
    // Get the value of the input
    var inputValue = input.value.trim();

    // Check if the input is empty
    if (inputValue === '') {
        alertAndHighlight(input, 'Phone cannot be empty', 'error');
        return false;
    }

    // Check if the input contains only valid characters (in this case, numbers and '+')
    var phonePattern = /^[0-9+]+$/;
    if (!phonePattern.test(inputValue)) {
        alertAndHighlight(input, 'Phone should contain only numbers and the "+" symbol', 'error');
        return false;
    }

    // Check if the input length is not more than 15 characters (adjust as needed)
    if (inputValue.length > 15) {
        alertAndHighlight(input, 'Phone length should not be more than 15 characters', 'error');
        return false;
    }

    // If all checks pass, remove the highlighting and set the border color to green
    removeHighlight(input);
    return true;
}

function checkStreetAddress(hstreetadd) {
    var input = document.getElementById(hstreetadd);
    var inputValue = input.value.trim();

    // Check if the input is empty
    if (inputValue === '') {
        alertAndHighlight(input, 'Street Address cannot be empty', 'error');
        return false;
    }

    // Check if the input contains only alphabet characters
    var alphabetPattern = /^[A-Za-z\s]+$/; // Allow spaces in Street Address
    if (!alphabetPattern.test(inputValue)) {
        alertAndHighlight(input, 'Street Address should contain only alphabet characters', 'error');
        return false;
    }

    // Check if the input length is not more than 20
    if (inputValue.length > 20) {
        alertAndHighlight(input, 'Street Address length should not be more than 20 characters', 'error');
        return false;
    }

    removeHighlight(input);
    return true;
}

function checkCity(hcity) {
    var input = document.getElementById(hcity);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        alertAndHighlight(input, 'City/town cannot be empty', 'error');
        return false;
    }

    var alphabetPattern = /^[A-Za-z\s]+$/; // Allow spaces in City/town
    if (!alphabetPattern.test(inputValue)) {
        alertAndHighlight(input, 'City/town should contain only alphabet characters', 'error');
        return false;
    }

    if (inputValue.length > 20) {
        alertAndHighlight(input, 'City/town length should not be more than 20 characters', 'error');
        return false;
    }

    removeHighlight(input);
    return true;
}

function checkState(hstate) {
    var input = document.getElementById(hstate);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        alertAndHighlight(input, 'State cannot be empty', 'error');
        return false;
    }

    var alphabetPattern = /^[A-Za-z\s]+$/; // Allow spaces in State
    if (!alphabetPattern.test(inputValue)) {
        alertAndHighlight(input, 'State should contain only alphabet characters', 'error');
        return false;
    }

    if (inputValue.length > 20) {
        alertAndHighlight(input, 'State length should not be more than 20 characters', 'error');
        return false;
    }

    removeHighlight(input);
    return true;
}

function checkPostcode(hpostcode) {
    var input = document.getElementById(hpostcode);
    var inputValue = input.value.trim();

    if (inputValue === '') {
        alertAndHighlight(input, 'Postcode cannot be empty', 'error');
        return false;
    }

    var postcodePattern = /^[0-9]+$/; // Allow only numbers for Postcode
    if (!postcodePattern.test(inputValue)) {
        alertAndHighlight(input, 'Postcode should contain only numbers', 'error');
        return false;
    }

    if (inputValue.length > 10) {
        alertAndHighlight(input, 'Postcode length should not be more than 10 characters', 'error');
        return false;
    }

    removeHighlight(input);
    return true;
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


