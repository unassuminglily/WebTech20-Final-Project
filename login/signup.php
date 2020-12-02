<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Galada&family=Oxygen&family=Pacifico&display=swap" rel="stylesheet">
    <title>Signup</title>

<!-- <style>
    body {
    font: 1em sans-serif;
    background-color: #AB3C3D;
    color: #F2E6E6;
}

    .wrapper {
        border-radius: 3%;
        width: 60%;
        padding: 20px;
        /* background-color: white; */
    }
</style> -->
</head>

<body>
    <center>
        <div class="wrapper">
        <h1>Welcome, to the Frat House System</h1>
        <p>Imagine the newest hostels on the Ashesi campus were built into Fraternity houses to strengthen diversity and community. You get the opportunity to have a feel of how this would be managed, sign up to get access.</p>
            <form id="signupform" class="form-su" name="form" method="post" action="su_validate.php" onsubmit="return(validate());"  >
                    <legend class="form-heading">Sign up to join the community!</legend>

                    <label>First name</label>
                    <div class="col-sm-8 form-group">
                        <input type="text" class="form-control" name="firstname" id="fname" placeholder="Enter your First Name" required>
                    </div>

                    <label>Last name</label>
                    <div class="col-sm-8 form-group">
                        <input type="text" class="form-control" name="lastname" id="lname" placeholder="Enter your Last Name" required>
                    </div>

                    <label>Email address</label>
                    <div class="col-sm-8 form-group">
                        <input type="text" class="form-control" pattern="\w+([\._-]\w+)*@ashesi.edu.gh$" title="Enter a valid Ashesi University email address. E.g., bob.smith@ashesi.edu.gh " name="email" id="email" placeholder="Enter your Ashesi email E.g., bob.smith@ashesi.edu.gh " required>
                    </div>

                    <label>Password</label>
                    <div class="col-sm-8 form-group">
                        <input type="password" onchange="passcheck()" class="form-control" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" title="Password must be at least 8 characters and contain 1 lowercase letter, 1 uppercase letter and 1 digit." name="password" id="pass" placeholder="8 characters at least, at least 1 lowercase letter, 1 uppercase letter and 1 digit" required>
                    </div>

                    <label>Confirm Password</label>
                    <div class="col-sm-8 form-group">
                        <input type="password" class="form-control" id="confirm" placeholder="Confirm password" required onchange="passcheck()">
                    </div>


                    <div class="col-sm-4 form-group ">
                        <button type="submit" class="btn btn-info btn-lg btn-block login-button">Register</button>
                    </div>
            </form>
        </div>
    <center>     
</body>


<script>
    var fname=document.getElementById("fname");
    var mname=document.getElementById("mname");
    var lname=document.getElementById("lname");
    var email=document.getElementById("email");
    var pass=document.getElementById("pass");
    var cpass=document.getElementById("confirm");


    function passcheck(){
        cpass.setAttribute("pattern",pass.value);
        cpass.setAttribute("title","Field must match password field");
    }
</script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- jQuery (Bootstrap JS plugins depend on it) -->
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</html>