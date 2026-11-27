<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');

$query = mysqli_query($conn, "SELECT * FROM `admin_login` where `admin_email` = '{$_SESSION['email']}' and `admin_type`='0'");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {

    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $admin_type = $_POST['admin_type'];

    $query = mysqli_query($conn, "INSERT INTO `admin_login` (`admin_number`, `admin_email`, `admin_pass`, `first_name`, `last_name`, `admin_type`) VALUES ('$number', '$email', '$password', '$first_name', '$last_name', '$admin_type')");

    // var_dump($query);
    if ($query) {
        echo "Data has been successfully inserted";
    } else {
        echo "Some error please try again";
    }

} else {
    header('location:../job-post.php');
    exit();
}
?>