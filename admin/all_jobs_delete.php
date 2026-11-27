<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');

$query = mysqli_query($conn, "SELECT * FROM `admin_login` where `admin_email` = '{$_SESSION['email']}' and `admin_type`='0'");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {

    $del = $_GET['del'];
    $query1 = mysqli_query($conn, "DELETE FROM `all_jobs` WHERE `all_jobs`.`job_id` = '$del'");

    if ($query1) {
        echo "<script>alert('Record has been deleted successfully!!!')</script>";
        header('location:all_jobs.php');
        exit();
    } else {
        echo "<script>alert('Record has not been deleted, please try again')</script>";
    }

} else {
    header('location:../job-post.php');
    exit();
}
?>