<?php  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoesshopdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
    $first_name =  $_REQUEST['fname'];
    $last_name = $_REQUEST['lname'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $phone_number = $_REQUEST['mobile'];
    $email = $_REQUEST['email'];
    
    $sql = "INSERT INTO user (firstName, lastName, username, password, mobile, email, registeredAt) VALUES ('$first_name', '$last_name', '$username', $password, '$phone_number', '$email', NOW())";
          
    if (mysqli_query($conn, $sql)) {
        echo '<script language="javascript">';
        echo 'alert("New record created successfully!")';
        echo '</script>';
        // echo "New record created successfully";
    } else {
        echo '<script language="javascript">';
        echo 'alert("Error can not create new record!")';
        echo '</script>';
        // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }   
}
?>