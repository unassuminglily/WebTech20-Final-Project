<?php
include '../config/config.php';

$conn=connectDB();

$fname=$_REQUEST["firstname"];
$lname=$_REQUEST["lastname"];
$email=$_REQUEST["email"];
$password=$_REQUEST["password"];
$hashedp=password_hash($password, PASSWORD_DEFAULT);



$query = "INSERT INTO staff (fname, lname, email, password) VALUES ('$fname','$lname','$email', '$hashedp')";

if ($conn->query($query) === TRUE) {
    header("Location: signin.php", true, 301);
    exit();
} else {
    echo "Error: " . $query . " " . $conn->error;
}

?>