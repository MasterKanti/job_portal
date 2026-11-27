<?php
session_start();
error_reporting(0);
include(__DIR__ . '/../connection/db.php');
if (!isset($_SESSION['email'])) {

} else {
  $header = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
  while ($row = mysqli_fetch_array($header)) {
    $img = $row['img'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="icon" href="admin/img/joblyfetitle.png">
  <title>JobLyfe: Where Talent Meets Opportunity</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">


  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">

  <!-- Style for my_profile -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> -->

  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">


  <!-- Style for my_profile -->
  <style>
    body {
      background-color: #f7f7f7;
    }

    .container-style {
      max-width: 1000px;
      margin-top: 50px;
      padding: 3%;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-image-style {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin: auto;
    }

    .form-label-style {
      font-weight: bold;
      color: #000;
    }

    .form-control-style {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ced4da;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .text-center-style {
      text-align: center;
    }

    .d-grid-style {
      display: grid;
    }

    .btn-success-style {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    .btn-success-style:hover {
      background-color: #218838;
    }
  </style>

  <style>
    /* Isolated styles for the dropdown */
    .custom-dropdown-container {
      position: relative;
      display: inline-block;
    }

    .custom-profile-img {
      border-radius: 50%;
      object-fit: cover;
      width: 50px;
      height: 50px;
      cursor: pointer;
      border: 2px solid #ddd;
      transition: border-color 0.3s ease;
    }

    .custom-profile-img:hover {
      border-color: #007bff;
      /* Add hover effect for the profile image */
    }

    .custom-dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 10px 0;
      list-style: none;
      display: none;
      /* Hidden by default */
      z-index: 1000;
      /* Ensures it stays above other elements */
      min-width: 160px;
      animation: fadeIn 0.3s ease;
    }

    .custom-dropdown-container:hover .custom-dropdown-menu {
      display: block;
      /* Show the dropdown on hover */
    }

    .custom-dropdown-link {
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      font-size: 14px;
      color: #333;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .custom-dropdown-link:hover {
      background-color: #007bff;
      color: #fff;
      border-radius: 4px;
    }

    .custom-logout {
      color: #e74c3c;
    }

    .custom-logout:hover {
      background-color: #c0392b;
      color: #fff;
    }

    /* Smooth dropdown animation */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

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

  <!-- Style for Referral Link Start -->
  <style>
    .text-break {
      word-wrap: break-word;
      overflow-wrap: break-word;
      white-space: normal;
    }
  </style>
  <!-- Style for Referral Link End -->


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

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">JobLyfe</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php if ($page == 'home') {
            echo 'active';
          } ?>"><a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item <?php if ($page == 'contact') {
            echo 'active';
          } ?>"><a href="contact.php" class="nav-link">Contact Us</a></li>
          <li class="nav-item <?php if ($page == 'terms') {
            echo 'active';
          } ?>"><a href="termsandconditions.php" class="nav-link" target="_blank">Terms & Conditions</a></li>

          <?php
          if (isset($_SESSION['email'])) {
            ?>
            <li class="nav-item cta mr-md-2"><a href="admin/admin_dashboard.php" class="nav-link">Dashboard</a></li>
            <li class="nav-item cta mr-md-2"><a href="job-post.php" class="nav-link">
                <?php
                if (empty($first_name) && empty($last_name)) {
                  echo $_SESSION['email'];
                } else {
                  echo trim($first_name . ' ' . $last_name);
                }
                ?>
              </a></li>
            <li class="nav-item custom-dropdown">
              <div class="custom-dropdown-container">
                <img src="profile_img/<?php echo empty($img) ? "profile.png" : $img; ?>" class="custom-profile-img"
                  type="button" data-toggle="dropdown" alt="Profile Image">
                <ul class="custom-dropdown-menu">
                  <li><a href="my_profile.php" class="custom-dropdown-link">My Profile</a></li>
                  <li><a href="logout.php" class="custom-dropdown-link custom-logout">Logout</a></li>
                </ul>
              </div>
            </li>


            <?php
          } else {
            ?>
            <li class="nav-item cta mr-md-2"><a href="job-post.php" class="nav-link">Login</a></li>

            <?php
          }
          ?>

        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->