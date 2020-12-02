<?php
// Include config file
require_once "config/config.php";
 
// Define variables and initialize with empty values
$fname = $lname =$email = $password = $confirm_password = "";
$fname_err = $lname_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate first name, last name and email
    // checks if empty, removes unneccessary whitespace
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter a first name.";
    } else if (empty(trim($_POST["lname"]))){
        $lname_err = "Please enter a last name.";
    } else if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email address.";
    }
    
    else{
        // Prepare a select statement. why? to prevent sql injection and increase efficiency
        // $sql = "Your SQL statement here";
        // $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        $sql = "SELECT StaffID FROM staff WHERE email = ? AND fname=? AND lname=?";
        echo("Error description: " . mysqli_error($conn));
        
        // prepares the query for execution
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            // object rep the prepared statement, string, variable. returns boolean
            mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_fname, $param_lname);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            $param_fname = trim($_POST["fname"]);
            $param_lname = trim($_POST["lname"]);

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                echo("Error description: " . mysqli_error($conn));

                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";

                } else{
                    $email = trim($_POST["email"]);
                    // $fname = trim($_POST["fname"]);
                    // $lname = trim($_POST["lname"]);
                }
            } else{
                echo("Error description: " . mysqli_error($conn));
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";  
        // length validation only, do strength validation soon   
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO staff (fname, lname, email, password) VALUES (?, ?, ?, ?)";
        echo("Error description: " . mysqli_error($conn));
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_email, $param_fname, $param_lname, $param_password);
            echo("Error description: " . mysqli_error($conn));
            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: signin.php");
                
            } else{
                echo "Something went wrong. Please try again later.";
                echo("Error description: " . mysqli_error($conn));
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 1em sans-serif;
            background-color: #AB3C3D;
            color: #F2E6E6;
        }
        
        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <center>
        <div class="wrapper">
            <h1>Welcome, to the Frat House System</h1>
            <p>Imagine the newest hostels on the Ashesi campus were built into Fraternity houses to strengthen diversity and community. You get the opportunity to have a feel of how this would be managed, sign up to get access.</p>
            <!--  put in form action -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <!-- if empty show the error first on submit -->
                <!-- the things commented out above should be placed in form group -->
                <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                    <span class="help-block"><?php echo $fname_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
                    <span class="help-block"><?php echo $lname_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
                <p>Already have an account? <a href="signin.php">Login here</a>.</p>
            </form>
        </div>
        <center>
</body>

</html>