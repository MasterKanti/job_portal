<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');

$query = mysqli_query($conn, "SELECT * FROM `admin_login` where `admin_email` = '{$_SESSION['email']}' and `admin_type`='2'");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {


    $login = $_SESSION['email'];
    $job_title = $_POST['job_title'];
    $job_salary = $_POST['job_salary'];
    $description = $_POST['description'];
    $job_type = $_POST['job_type'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $category = $_POST['category'];

    $query = mysqli_query($conn, "INSERT INTO `all_jobs` (`job_customer_email`, `job_title`, `job_salary`, `job_des`, `job_type`, `job_country`, `job_state`, `job_city`, `job_category`) VALUES ('$login', '$job_title', '$job_salary', '$description', '$job_type', '$country', '$state', '$city', '$category')");

    // var_dump($query);
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