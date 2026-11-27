<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');

$query = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email` = '{$_SESSION['email']}' AND (`admin_type` = '1' OR `admin_type` = '0')");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {

    $sub_category_id = $_POST['sub_category_id'];
    $sub_category = $_POST['sub_category'];

    $query = mysqli_query($conn, "INSERT INTO `sub_category` (`sub_category_id`, `sub_category`) VALUES ('$sub_category_id', '$sub_category')");

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