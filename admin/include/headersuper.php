<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/../connection/db.php');
$query = mysqli_query($conn, "SELECT * FROM `admin_login` where `admin_email` = '{$_SESSION['email']}' and `admin_type`='0'");
if ($_SESSION['email'] == true && mysqli_num_rows($query) > 0) {
    // header('location:admin_dashboard.php');
} else {
    header('location:../job-post.php');
    exit();
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <link rel="icon" href="img/joblyfetitle.png">
    <title>JobLyfe: Where Talent Meets Opportunity</title>

    <!-- Icon cdn library -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Debugging jquery taken from w3schools -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Debugging jquery taken from chatgpt
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- Library commented out, check in future for debugging -->
    <!-- jQuery library -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script> -->

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datatables CSS -->
    <!-- Bootstrap 3 version -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap.css"> -->

    <!-- Bootstrap 4 version -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.css"> -->


    <!-- Datatables version -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/dashboard.css">

    <!-- Readonly and Disabled Handling -->
    <style>
        select[readonly] {
            pointer-events: none;
            /* Prevent interaction */
            background-color: #f0f0f0;
            /* Gray out */
            color: #666;
        }
    </style>

    <!-- Country State City Dropdown -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('https://countriesnow.space/api/v0.1/countries')
                .then(response => response.json())
                .then(data => {
                    const countryDropdown = document.getElementById('countryDropdown');
                    data.data.forEach(country => {
                        let option = document.createElement('option');
                        option.value = country.country;
                        option.text = country.country;
                        countryDropdown.add(option);
                    });
                });

            document.getElementById('countryDropdown').addEventListener('change', function () {
                const selectedCountry = this.value;
                fetch('https://countriesnow.space/api/v0.1/countries/states', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ country: selectedCountry })
                })
                    .then(response => response.json())
                    .then(data => {
                        const stateDropdown = document.getElementById('stateDropdown');
                        stateDropdown.length = 1; // Clear existing options
                        data.data.states.forEach(state => {
                            let option = document.createElement('option');
                            option.value = state.name;
                            option.text = state.name;
                            stateDropdown.add(option);
                        });
                    });
            });

            document.getElementById('stateDropdown').addEventListener('change', function () {
                const selectedCountry = document.getElementById('countryDropdown').value;
                const selectedState = this.value;
                fetch('https://countriesnow.space/api/v0.1/countries/state/cities', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ country: selectedCountry, state: selectedState })
                })
                    .then(response => response.json())
                    .then(data => {
                        const cityDropdown = document.getElementById('cityDropdown');
                        cityDropdown.length = 1; // Clear existing options
                        data.data.forEach(city => {
                            let option = document.createElement('option');
                            option.value = city;
                            option.text = city;
                            cityDropdown.add(option);
                        });
                    });
            });
        });
    </script>





</head>


<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../job-post.php"><?php echo $_SESSION['email']; ?></a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
    </nav>