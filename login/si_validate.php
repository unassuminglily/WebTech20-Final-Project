<?php
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../views/home.php");
    exit;
}
 
// Include config file
require_once "../config/config.php";

$conn = connectDB();

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        echo "h12";
        // Prepare a select statement
        $sql = "SELECT fname, lname, password FROM staff WHERE email = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            
            // Set parameters
            $param_email = $email;
            // $param_password = $password;

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $fname, $lname, $email, $hashedp);
                    // echo "hey5";
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashedp)){
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            // $_SESSION["id"] = $id;
                            $fullname=$fname." ".$lname;
                            $_SESSION['fullname']=$fullname;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: ../views/home.php");
                            echo "success";
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            header('location: signin.php');
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                    // header('location: signin.php');
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                // header('location: signin.php');
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}else{
    echo "hi";
}
?>


<!-- <?php
// include '../config/config.php';

// $conn=connectDB();

// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);

// $email=$_REQUEST["email"];
// $password=$_REQUEST["password"];

// $hashedp=$row["password"];
// $auth = password_verify($_POST['password'], $hashedp);
// if ($auth==TRUE){
//     echo "Welcome to the Dashboard";
// }
// else{
//     echo $auth;
//     echo "Sorry, wrong password/email<br>
//     <a href='loginstudent.php'><button>Back to Login</button></a>";
// }



// if($stmt = $conn->prepare('SELECT fname,lname FROM staff WHERE email = ? and password = ?')){
//     $stmt->bind_param('ss', $email, $password);
//     $stmt->execute();
//     $stmt->store_result();
//     if($stmt->num_rows > 0) {
//         $stmt->bind_result($fname,$lname, $hashedp);
//         while ($stmt->fetch()) {
//             $fullname=$fname." ".$lname;
//         }
//         if ($auth == TRUE){
//             $_SESSION['fullname']=$fullname;
//             $_SESSION['email']=$email;
//             echo 'success';
//         }
        

//         // $query="SELECT * FROM fellows_mods WHERE modid='$email'";
//         // $result = $conn->query($query);
//         // $count=0;
//         // while ($row_users = mysqli_fetch_array($result)){
//         //     $count=$count+1;

//         // }
//         // if($count>0){
//         //     $_SESSION['admin']='true';
//         //     echo $_SESSION['admin'];
//         // }
//         // else{
//         //     $_SESSION['admin']='false';
//         //     echo $_SESSION['admin'];
//         // }

//         header('location: ../views/home.php');
//     }
//     else{
//         $error='Incorrect username and/or password!';
//         $_SESSION['message'] = $error;
//         header('location: signin.php');
//     }

// }


?> -->