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
                <li><a href="">Our Team</a></li>
                <li><a href="">Contact</a></li>
                
            </ul>
            <a href="" class="registrationbutton">Login</a>

        </nav>
    </header>
    
        <!-- Brief Heading and content -->
        <div class="hcontent">
            <h1> Customer Sign Up</h1>

            <p>
                Signing up for our catering service application opens the door to a world of convenience and culinary delights. 
                Enjoy seamless event planning with a vast selection of catering options, personalized recommendations, and efficient 
                vendor selection. Our platform simplifies budget management and offers a hassle-free planning experience. Say goodbye 
                to event planning stress and embrace the ease of organizing memorable gatherings. Join us today to unlock a world of
                catering solutions tailored to your unique preferences and requirements.
                Kindly proceed to provide details for your profile then complete account creation with providing us with your preferred login credentials details

            </p>
        </div>
       

    <form id="form" method="post" action="SignUp.php" >
        <!--Fieldset1-Personal Details-->
        <fieldset>
            <legend class="leg"> PERSONAL DETAILS</legend>
            <label for="hfname">First Name</label>
            <input type="text" id="hfname" name="hfname"  placeholder="Your first name"> <br>

            <label for="hlname">Last Name</label>
            <input type="text" id="hhlname" name="hlname" placeholder="Your last name"> <br>

            <label for="hemail">Email</label>
            <input type="text" id="hemail" name="hemail" placeholder="abc1@hotmail.com"><br>

            <label for="hphone">Phone</label>
            <input type="text" id="hphone" name="hphone" placeholder="+123456789"> <br>
        </fieldset>

        <!--Fieldset2-Address-->
        <fieldset>
            <legend class="leg"> PHYSICAL ADDRESS</legend>
            <label for="hstreetadd">Street Address </label>
            <input type="text" id="hstreetadd" name="hstreetadd"> <br>

            <label for="hcity">City/town</label>
            <input type="text" id="hcity" name="hcity"> <br>

            <label for="hstate">State</label>
            <input type="text" id="hstate" name="hstate"> <br>

            <label for="hpostcode">Postcode</label>
            <input type="text" id="hpostcode" name="hpostcode"> <br>
        </fieldset>

        <!--Buttons-->
        <div class="button-container">
            <button  type="submit" value="Submit" name="submit">Proceed</button>
            <button type="reset" value="Reset">Reset</button>
        </div>
    </form> 
</body>

</html>