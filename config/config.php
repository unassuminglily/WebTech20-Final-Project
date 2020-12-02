<?php 
    // details for the necessary connection
//     $host="localhost";
//     $user="root";
//     $password="";
//     $db= "loa06212022";

//     // connecting to the db
//     $conn = mysqli_connect($host, $user, $password, $db);
 
// // Check connection
//     if($conn === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
//     }

?>

<?php
define('host', 'localhost');
define('user', 'root');
define('password', '');
define('db', 'loa06212022');

function connectDB(){
    $conn = mysqli_connect(host,user,password,db);
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else{
//        echo 'success';
        return $conn;
    }

}

?>