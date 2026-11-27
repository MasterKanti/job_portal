<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');

$query = mysqli_query($conn, "SELECT * FROM `admin_login` where `admin_email` = '{$_SESSION['email']}' AND (`admin_type` = '1' OR `admin_type` = '0')");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {

    $company = $_POST['company'];
    $industry = $_POST['industry'];
    $description = $_POST['description'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $number = $_POST['number'];
    $admin = $_POST['admin'];

    $query = mysqli_query($conn, "INSERT INTO `company` (`company`, `company_industry`, `company_des`, `company_country`, `company_state`, `company_city`, `company_pin`, `company_admin`, `company_designation`, `company_number`, `company_email`) VALUES ('$company', '$industry', '$description', '$country', '$state', '$city', '$pin', '$name', '$designation', '$number', '$admin')");

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