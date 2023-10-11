<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Food and Beverage Catering Service">
    <meta name="keywords" content="Create Customer Account">
    <meta name="author" content="Abdullahi">
    <title>Creating Customer Account</title>

    <!-- Linl the general layout css -->
    <link rel="stylesheet" href="../FCMS-Assets/Main.css"> 

    <!-- Link to this pages css -->
    <link rel="stylesheet" href="../FCMS-CSS/CreateDetails.css">

    <!-- Link the navbar style css -->
    <link rel="stylesheet" href="../FCMS-CSS/Tahastyle.css">

    <script src="../FCMS-JavaScripts/Validation.js"></script>
</head>

<body>
    <header>
        <!-- Navigation bar -->
        <nav>

            <!-- Adding logo -->
            <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="160" height="30" alt="CulinaryCue - Home">
            </a>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Menu</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Contact</a></li>
                
            </ul>
            <a href="" class="registrationbutton">Login</a>

        </nav>
    </header>
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