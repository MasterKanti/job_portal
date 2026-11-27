<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');

$query = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email` = '{$_SESSION['email']}' AND `admin_type`='0'");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {

    $del = $_GET['del'];
    $result = mysqli_query($conn, "SELECT `user_email` FROM `profiles` WHERE `id` = '$del'");
    $profile = mysqli_fetch_array($result);
    $user_email = $profile['user_email'];

    $query1 = mysqli_query($conn, "DELETE FROM `profiles` WHERE `profiles`.`id` = '$del'");
    $query2 = mysqli_query($conn, "DELETE FROM `admin_login` WHERE `admin_login`.`admin_email` = '$user_email' AND `admin_type`<>'0'");

    if ($query1 && $query2) {
        echo "<script>alert('Record has been deleted successfully!!!')</script>";
        header('location:profiles.php');
        exit();
    } else {
        echo "<script>alert('Record has not been deleted, please try again')</script>";
    }

} else {
    header('location:../job-post.php');
    exit();
}
?>