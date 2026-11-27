<?php
session_start();
// error_reporting(0);
include(__DIR__ . '/connection/db.php');
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
    /* body {
      background-color: #f7f7f7;
    } */
    body {
      /* font-family: Arial, sans-serif; */
      background: linear-gradient(135deg, #4b0082, rgb(200, 150, 255));
      /* color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; */
    }

    .container-style {
      max-width: 1000px;
      margin-top: 50px;
      padding: 3%;
      background-color: rgb(223, 223, 255);
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


<script>
    document.addEventListener("DOMContentLoaded", function () {
      fetch('https://countriesnow.space/api/v0.1/countries')
        .then(response => response.json())
        .then(data => {
          const countryDropdown = document.getElementById('countryDropdown2');
          data.data.forEach(country => {
            let option = document.createElement('option');
            option.value = country.country;
            option.text = country.country;
            countryDropdown.add(option);
          });
        });

      document.getElementById('countryDropdown2').addEventListener('change', function () {
        const selectedCountry = this.value;
        fetch('https://countriesnow.space/api/v0.1/countries/states', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ country: selectedCountry })
        })
          .then(response => response.json())
          .then(data => {
            const stateDropdown = document.getElementById('stateDropdown2');
            stateDropdown.length = 1; // Clear existing options
            data.data.states.forEach(state => {
              let option = document.createElement('option');
              option.value = state.name;
              option.text = state.name;
              stateDropdown.add(option);
            });
          });
      });

      document.getElementById('stateDropdown2').addEventListener('change', function () {
        const selectedCountry = document.getElementById('countryDropdown2').value;
        const selectedState = this.value;
        fetch('https://countriesnow.space/api/v0.1/countries/state/cities', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ country: selectedCountry, state: selectedState })
        })
          .then(response => response.json())
          .then(data => {
            const cityDropdown = document.getElementById('cityDropdown2');
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

  <?php
  include(__DIR__ . '/connection/db.php');
  // include(__DIR__ . '/include/header.php');
  
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
    while ($row = mysqli_fetch_array($query)) {
      $img = $row['img'];

      $user_email = $row['user_email'];

      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $dob = $row['dob'];
      $gender = $row['gender'];
      $country = $row['country'];
      $state = $row['state'];
      $city = $row['city'];
      $pin = $row['pin'];
      $landmark = $row['landmark'];
      $qualification = $row['qualification'];
      $board = $row['board'];
      $language = $row['language'];
      $study_field = $row['study_field'];
      $experience = $row['experience'];
      $details = $row['details'];
      $location = $row['location'];
      $job_type = $row['preferred_job_type'];
      $mobile_number = $row['mobile_number'];
      $whatsapp_number = $row['whatsapp_number'];

      $cv = $row['cv'];
      $aadhar = $row['aadhar'];

      $verification = $row['verification'];
    }
    ?>

    <!-- <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center text-md-left mb-5" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Profile</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">My Profile</h1>
          </div>
        </div>
      </div>
    </div> -->
    <br>
    <br>


    <div class="container container-style">
      <div class="text-center text-center-style mb-2">
        <img src="profile_img/<?php if (!empty($img)) {
          echo $img;
        } else {
          echo 'profile.png';
        } ?>" class="profile-image profile-image-style img-thumbnail" alt="Profile Image">
      </div>
      <div class="text-center text-center-style mb-4 h4"><span
                      class="bg-primary text-white badge py-2 px-2"><?php echo $verification; ?></span></div>


      <div class="ftco-search">
        <div class="row">
          <div class="col-md-12 nav-link-wrap">
            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab"
                aria-controls="v-pills-1" aria-selected="true">Profile for Job Seeker</a>

              <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab"
                aria-controls="v-pills-2" aria-selected="false">Profile for Employer</a>

            </div>
          </div>
          <div class="col-md-12 tab-wrap">

            <div class="tab-content p-4" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">

                <form name="myForm" id="myForm" action="profile_add.php" method="POST" enctype="multipart/form-data">

                  <div class="row">
                    <div class="col-sm-12">
                      <b><label for="" class="form-label form-label-style">PS: Kindly ensure your profile is complete
                          before applying for jobs.</label></b>
                    </div>
                    <div class="col-sm-12">
                      <b><label for="" class="form-label form-label-style">PS: All fields are
                          mandatory.</label></b>
                    </div>
                    <div class="col-sm-12">
                      <b><label for="" class="form-label form-label-style">PS: Completed your profile? <a href="index.php">Click here</a> to apply for jobs.</label></b>
                    </div>
                  </div>
<br>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="Profile Photo" class="form-label form-label-style">Upload Profile Photo (.jpeg, .jpg, .png) under 200 KB</label>
                      <div class="text-center text-center-style">
                        <input type="file" class="form-control-style" name="img" id="img" accept=".jpg, .jpeg, .png"
                          required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Email Address</label>
                      <input type="text" class="form-control form-control-style" name="user_email" id="user_email"
                        placeholder="User Email..." value="<?php if (!empty($email))
                          echo $email; ?>" required readonly>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter First Name</label>
                      <input type="text" class="form-control form-control-style" name="first_name" id="first_name"
                        placeholder="First Name..." value="<?php if (!empty($first_name))
                          echo $first_name; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Last Name</label>
                      <input type="text" class="form-control form-control-style" name="last_name" id="last_name"
                        placeholder="Last Name..." value="<?php if (!empty($last_name))
                          echo $last_name; ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Date of Birth</label>
                      <input type="date" class="form-control form-control-style" name="dob" id="dob" value="<?php if (!empty($dob))
                        echo $dob; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Select Gender</label>
                      <select class="form-control form-control-style" name="gender" id="gender" required>
                        <option value="<?php if (!empty($gender))
                          echo $gender; ?>">
                          <?php if (!empty($gender))
                            echo $gender;
                          else
                            echo "Select Gender"; ?>
                        </option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="" class="form-label form-label-style">Country</label>
                        <select name="country" class="countries form-control form-control-style" id="countryDropdown"
                          required>
                          <option value="<?php if (!empty($country))
                            echo $country; ?>">
                            <?php if (!empty($country))
                              echo $country;
                            else
                              echo "Select Country"; ?>
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="" class="form-label form-label-style">State</label>
                        <select name="state" class="states form-control form-control-style" id="stateDropdown" required>
                          <option value="<?php if (!empty($state))
                            echo $state; ?>">
                            <?php if (!empty($state))
                              echo $state;
                            else
                              echo "Select state"; ?>
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="" class="form-label form-label-style">City</label>
                        <select name="city" class="cities form-control form-control-style" id="cityDropdown" required>
                          <option value="<?php if (!empty($city))
                            echo $city; ?>">
                            <?php if (!empty($city))
                              echo $city;
                            else
                              echo "Select City"; ?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter PIN Code</label>
                      <input type="number" class="form-control form-control-style" name="pin" id="pin"
                        placeholder="eg. 700132" value="<?php if (!empty($pin))
                          echo $pin; ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Nearest Landmark</label>
                      <input type="text" class="form-control form-control-style" name="landmark" id="landmark"
                        placeholder="eg. Eco Urban Village" value="<?php if (!empty($landmark))
                          echo $landmark; ?>" required>
                    </div>

                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Select Highest Qualification</label>
                      <select class="form-control form-control-style" name="qualification" id="qualification" required>
                        <option value="<?php if (!empty($qualification))
                          echo $qualification; ?>">
                          <?php if (!empty($qualification))
                            echo $qualification;
                          else
                            echo "Select Highest Qualification"; ?>
                        </option>
                        <option value="High School">High School</option>
                        <option value="Bachelors Degree">Bachelor's Degree</option>
                        <option value="Masters Degree">Master's Degree</option>
                        <option value="PhD">PhD</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Select 10th Standard Board</label>
                      <select class="form-control form-control-style" name="board" id="board" required>
                        <option value="<?php if (!empty($board))
                          echo $board; ?>">
                          <?php if (!empty($board))
                            echo $board;
                          else
                            echo "Select 10th Standard Board"; ?>
                        </option>
                        <option value="WBBSE English Medium">WBBSE (English Medium)</option>
                        <option value="WBBSE Bengali Medium">WBBSE (Bengali Medium)</option>
                        <option value="CBSE">CBSE</option>
                        <option value="ICSE">ICSE</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>

                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Select Most Preferred Language</label>
                      <select class="form-control form-control-style" name="language" id="language" required>
                        <option value="<?php if (!empty($language))
                          echo $language; ?>">
                          <?php if (!empty($language))
                            echo $language;
                          else
                            echo "Select Preferred Language"; ?>
                        </option>
                        <option value="English">English</option>
                        <option value="Bengali">Bengali</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Field of Study</label>
                      <input type="text" class="form-control form-control-style" name="study_field" id="study_field"
                        placeholder="eg. Engineering, Management etc." value="<?php if (!empty($study_field))
                          echo $study_field; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Select Experience</label>
                      <select class="form-control form-control-style" name="experience" id="experience" required>
                        <option value="<?php if (!empty($experience))
                          echo $experience; ?>">
                          <?php if (!empty($experience))
                            echo $experience;
                          else
                            echo "Select Experience"; ?>
                        </option>
                        <option value="Fresher">Fresher</option>
                        <option value="Less than one year">Less than one year</option>
                        <option value="1-2 years">1-2 years</option>
                        <option value="3-5 years">3-5 years</option>
                        <option value="6-10 years">6-10 years</option>
                        <option value="More than 10 years">More than 10 years</option>
                      </select>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <div class="col-sm-12">
                      <label for="" class="form-label-style">Enter Details of Experiences (Max. 100 words)</label>
                      <textarea placeholder="Max. 100 words" class="form-control" name="details" id="details" required><?php if (!empty($details))
                        echo $details; ?></textarea>
                    </div>
                  </div>



                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Preferred Service Location</label>
                      <input type="text" class="form-control form-control-style" name="location" id="location"
                        placeholder="eg. Newtown, Saltlake" value="<?php if (!empty($location))
                          echo $location; ?>" required>
                    </div>

                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Select Preferred Job Type</label>
                      <select class="form-control form-control-style" name="job_type" id="job_type" required>
                        <option value="<?php if (!empty($job_type))
                          echo $job_type; ?>">
                          <?php if (!empty($job_type))
                            echo $job_type;
                          else
                            echo "Select Job Type"; ?>
                        </option>
                        <option value="Tutor">Tutor</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Internship">Internship</option>
                        <option value="Volunteer">Volunteer</option>
                        <option value="Contract">Contract</option>
                      </select>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Mobile Number</label>
                      <input type="number" class="form-control form-control-style" name="mobile_number" id="mobile_number"
                        placeholder="eg. 9876543210" value="<?php if (!empty($mobile_number))
                          echo $mobile_number; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter WhatsApp Number</label>
                      <input type="number" class="form-control form-control-style" name="whatsapp_number"
                        id="whatsapp_number" placeholder="eg. 9876543210" value="<?php if (!empty($whatsapp_number))
                          echo $whatsapp_number; ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Upload CV/ Biodata (.pdf) under 200 KB</label>
                      <div class="text-center text-center-style">
                        <input type="file" class="form-control-style" name="cv" id="cv" accept=".pdf" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Upload Aadhar Card (.pdf) under 200 KB</label>
                      <div class="text-center text-center-style">
                        <input type="file" class="form-control-style" name="aadhar" id="aadhar" accept=".pdf" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Download CV/ Biodata</label>
                      <td><a href="cv/<?php echo $cv; ?>" download>Here</a></td>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Download Aadhar Card</label>
                      <td><a href="aadhar/<?php echo $aadhar; ?>" download>Here</a></td>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <label for="" class="form-label form-label-style">
                        <input type="checkbox" name="terms" id="terms" value="Accepted" required>
                        I agree to the
                        <a href="termsandconditions.php" target="_blank">Terms and Conditions</a>
                      </label>
                    </div>
                  </div>

                  <div class="d-grid d-grid-style mt-4">
                    <button type="submit" class="btn btn-success btn-success-style" name="submit_profile"
                      id="submit_profile">Update</button>
                  </div>
                </form>
              </div>


              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                <form name="myForm" id="myForm" action="profile_add.php" method="POST" enctype="multipart/form-data">

                  <div class="row">
                    <div class="col-sm-12">
                      <b><label for="" class="form-label form-label-style">PS: Kindly ensure your profile is complete
                          before posting a job.</label></b>
                    </div>
                    <div class="col-sm-12">
                      <b><label for="" class="form-label form-label-style">PS: All fields are
                          mandatory.</label></b>
                    </div>
                    <div class="col-sm-12">
                      <b><label for="" class="form-label form-label-style">PS: Completed your profile? <a href="admin/job_create.php">Click here</a> to post a job.</label></b>
                    </div>
                  </div>
<br>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="Profile Photo" class="form-label form-label-style">Upload Profile Photo (.jpeg, .jpg, .png) under 200 KB</label>
                      <div class="text-center text-center-style">
                        <input type="file" class="form-control-style" name="img" id="img" accept=".jpg, .jpeg, .png"
                          required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Email Address</label>
                      <input type="text" class="form-control form-control-style" name="user_email" id="user_email"
                        placeholder="User Email..." value="<?php if (!empty($email))
                          echo $email; ?>" required readonly>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter First Name</label>
                      <input type="text" class="form-control form-control-style" name="first_name" id="first_name"
                        placeholder="First Name..." value="<?php if (!empty($first_name))
                          echo $first_name; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Last Name</label>
                      <input type="text" class="form-control form-control-style" name="last_name" id="last_name"
                        placeholder="Last Name..." value="<?php if (!empty($last_name))
                          echo $last_name; ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Date of Birth</label>
                      <input type="date" class="form-control form-control-style" name="dob" id="dob" value="<?php if (!empty($dob))
                        echo $dob; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Select Gender</label>
                      <select class="form-control form-control-style" name="gender" id="gender" required>
                        <option value="<?php if (!empty($gender))
                          echo $gender; ?>">
                          <?php if (!empty($gender))
                            echo $gender;
                          else
                            echo "Select Gender"; ?>
                        </option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="" class="form-label form-label-style">Country</label>
                        <select name="country" class="countries form-control form-control-style" id="countryDropdown2"
                          required>
                          <option value="<?php if (!empty($country))
                            echo $country; ?>">
                            <?php if (!empty($country))
                              echo $country;
                            else
                              echo "Select Country"; ?>
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="" class="form-label form-label-style">State</label>
                        <select name="state" class="states form-control form-control-style" id="stateDropdown2" required>
                          <option value="<?php if (!empty($state))
                            echo $state; ?>">
                            <?php if (!empty($state))
                              echo $state;
                            else
                              echo "Select state"; ?>
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="" class="form-label form-label-style">City</label>
                        <select name="city" class="cities form-control form-control-style" id="cityDropdown2" required>
                          <option value="<?php if (!empty($city))
                            echo $city; ?>">
                            <?php if (!empty($city))
                              echo $city;
                            else
                              echo "Select City"; ?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter PIN Code</label>
                      <input type="number" class="form-control form-control-style" name="pin" id="pin"
                        placeholder="eg. 700132" value="<?php if (!empty($pin))
                          echo $pin; ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <label for="" class="form-label form-label-style">Enter Nearest Landmark</label>
                      <input type="text" class="form-control form-control-style" name="landmark" id="landmark"
                        placeholder="eg. Eco Urban Village" value="<?php if (!empty($landmark))
                          echo $landmark; ?>" required>
                    </div>
                  </div>




                  <div class="row">
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter Mobile Number</label>
                      <input type="number" class="form-control form-control-style" name="mobile_number" id="mobile_number"
                        placeholder="eg. 9876543210" value="<?php if (!empty($mobile_number))
                          echo $mobile_number; ?>" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="form-label form-label-style">Enter WhatsApp Number</label>
                      <input type="number" class="form-control form-control-style" name="whatsapp_number"
                        id="whatsapp_number" placeholder="eg. 9876543210" value="<?php if (!empty($whatsapp_number))
                          echo $whatsapp_number; ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <label for="" class="form-label form-label-style">Upload Aadhar Card (.pdf) under 200 KB</label>
                      <div class="text-center text-center-style">
                        <input type="file" class="form-control-style" name="aadhar" id="aadhar" accept=".pdf" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <label for="" class="form-label form-label-style">Download Aadhar Card</label>
                      <td><a href="aadhar/<?php echo $aadhar; ?>" download>Here</a></td>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <label for="" class="form-label form-label-style">
                        <input type="checkbox" name="terms" id="terms" value="Accepted" required>
                        I agree to the
                        <a href="termsandconditions.php" target="_blank">Terms and Conditions</a>
                      </label>
                    </div>
                  </div>

                  <div class="d-grid d-grid-style mt-4">
                    <button type="submit" class="btn btn-success btn-success-style" name="submit_profile"
                      id="submit_profile">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <br>
    <br>
    <br>



    <script>
      document.getElementById('myForm').addEventListener('submit', function (event) {
        const maxFileSize = 500 * 1024; // 500 KB
        const allowedImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const allowedCVAadharTypes = ['application/pdf'];

        const profilePhoto = document.getElementById('img').files[0];
        const cv = document.getElementById('cv').files[0];
        const aadhar = document.getElementById('aadhar').files[0];

        // Validate Profile Photo
        if (profilePhoto) {
          if (profilePhoto.size > maxFileSize) {
            alert('Profile photo must be less than 500 KB');
            event.preventDefault();
            return;
          }
          if (!allowedImageTypes.includes(profilePhoto.type)) {
            alert('Profile photo must be a JPEG, JPG or PNG image');
            event.preventDefault();
            return;
          }
        }

        // Validate CV
        if (cv) {
          if (cv.size > maxFileSize) {
            alert('CV must be less than 500 KB');
            event.preventDefault();
            return;
          }
          if (!allowedCVAadharTypes.includes(cv.type)) {
            alert('CV must be a PDF file');
            event.preventDefault();
            return;
          }
        }

        // Validate Aadhar Card
        if (aadhar) {
          if (aadhar.size > maxFileSize) {
            alert('Aadhar card must be less than 500 KB');
            event.preventDefault();
            return;
          }
          if (!allowedCVAadharTypes.includes(aadhar.type)) {
            alert('Aadhar card must be a PDF file');
            event.preventDefault();
            return;
          }
        }
      });
    </script>

    <?php
    include(__DIR__ . '/include/footer.php');
    ?>

    <?php
  } else {
    header('location:job-post.php');
    exit();
  }
  ?>

  <!-- <script>
  $(document).ready(function(){
    $("#submit").click(function(e){
      e.preventDefault();
      var data=$("#profile_form").serialize();

    $.ajax({
      type: "POST",
      url: "profile_add.php",
      data:data,
      success: function(data){
        alert(data);
      }
    });
    })
  });
</script> -->

  <!-- Form design -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->