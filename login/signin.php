<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="..styles/forms.css">

<style>
   
    html{
    margin:0;
    padding:0;
    width:100%;
    height:100%;
    }
    body{
    width:100%;
    height:100%;
    background-color: #14080E;
    font-family:Arial, sans-serif;
    font-size:16px;
    line-height:30px;
    padding:20px;
    margin:0;
    }

    .form-su{
        color: white;
        background-color: #4F6272;
        border-radius: 5px;
        
        width: 80%;
        padding: 40px;
        margin: 10% auto;
        
        -webkit-box-shadow: -1px 3px 18px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px 3px 18px 0px rgba(0,0,0,0.75);
        box-shadow: -1px 3px 18px 0px rgba(0,0,0,0.75);
    }

    .form-heading {
        color: #ffffff;
    font-size: 23px;
    background: #e8cbc0; /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #e8cbc0, #636fa4); /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #e8cbc0, #636fa4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    margin: 20px 0 20px;
    padding: 20px;
    }

    label{
    min-width: 120px;
        position: relative;
        cursor: pointer;
        color: #666;
        font-size: 15px;
    }



</style>
</head>
<body>
<?php
include '../config/config.php';
?>
<form class="form-su" name="form" method="post" action="si_validate.php" onsubmit="">
    <br>
    <fieldset>
        <legend class="form-heading">Welcome back, sign in! </legend>
        <div class="form-group">
            <input type="text" class="form-control" pattern="\w+([\._-]\w+)*@ashesi.edu.gh$" title="Enter a valid Ashesi University email address. E.g., bob.smith@ashesi.edu.gh " name="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="pass" placeholder="Enter password" required>
        </div>
        <?php
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];

            unset($_SESSION['message']);
        }
        if(isset($_SESSION['message'])){
            echo $_SESSION['admin'];
        }

        ?>
    </fieldset>

    <div class="form-group ">
        <button type="submit" class="btn btn-info btn-md btn-block login-button">Login</button>
        <!-- <a href="reset-password.php" class="btn btn-link">Reset Password</a> -->
    </div>
</form>
</body>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</html>
