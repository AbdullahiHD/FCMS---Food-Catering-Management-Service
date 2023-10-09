<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Food and Beverage Catering Service">
    <meta name="keywords" content="Create Customer Account">
    <meta name="author" content="Abdullahi">
    <title>Creating Customer Account</title>

    <link rel="stylesheet" href="Styles2/SignUp2.css">

    <script src="JsScripts/Script1.js"></script>

</head>

<body>

    <div  class="general-layout" >
        <div class="hcontent">
            <h1> Customer Account Creation</h1>

            <p>
                You have made it thus far, Just proceed to input your username and password to allow you to join later.
            </p>
        </div>
       

    <form id="form" method="post" action="SignUp.php" novalidate="novalidate" onsubmit="return validateForm()" >
    
        <!--Fieldset3-Login-->
        <fieldset>
            <legend class="leg"> Login Details</legend>
            <input type="text"  name="husername" placeholder="Username"> <br>

            <input type="password" name="hpass" placeholder="Password" ><br>

            <input type="password" name="hconfpass" placeholder="Confirm Password"> <br>
        </fieldset>
        <!--Buttons-->
        <div class="button-container">
            <button type="submit" value="Submit" name="submit">Submit</button>
            <button type="reset" value="Reset">Reset</button>
        </div>
    </form> 
    </div>
</body>

</html>