<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');

$query = mysqli_query($conn, "SELECT * FROM `admin_login` where `admin_email` = '{$_SESSION['email']}' AND (`admin_type` = '1' OR `admin_type` = '0')");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {

    $category = $_POST['category'];

    $query = mysqli_query($conn, "INSERT INTO `job_category` (`category`, `category_id`) VALUES ('$category', '$category')");

    if ($query) {
        echo "Data has been successfully inserted";
    } else {
        echo "Some error has occured, please try again";
    }

} else {
    header('location:../job-post.php');
    exit();
}
?>