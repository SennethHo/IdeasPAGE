<?php
session_start();

include('conn.php');

if(!isset($_SESSION['id']) || trim($_SESSION['id']==''))
{
    header('Location: admin.php');
    exit(); //terminate the session/script
}


//select unique record using primary key
$querySID = mysqli_query($conn, "select * from user where UserID = '".$_SESSION['id']."'");
$row = mysqli_fetch_assoc($querySID);

// Retrieve the data from the URL parameters
$id = $_GET['id'];
$email = $_GET['email'];
$name = $_GET['name'];
$roles = $_GET['roles'];

// Handle the form submission
if (isset($_POST['submit'])) {
  // Retrieve the edited data from the form
  $newEmail = $_POST['email'];
  $newName = $_POST['name'];
  $newRoles = $_POST['roles'];
  $newPass = $_POST['pass'];

  // Update the database with the edited data
  $query = "UPDATE user SET Email='$newEmail', Password='$newPass', Name='$newName', Roles='$newRoles' WHERE UserID='$id'";
  mysqli_query($conn, $query);

  // Redirect back to the original page
  header("Location: admin.php");
  exit();
}
?>



