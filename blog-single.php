<?php
session_start();
if (isset($_SESSION['email'])) {
  include(__DIR__ . '/connection/db.php');
  $query2 = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
  if (mysqli_num_rows($query2) > 0) {
    $profile = mysqli_fetch_array($query2);
    if (empty($profile['img']) || empty($profile['first_name']) || empty($profile['last_name']) || empty($profile['dob']) || empty($profile['gender']) || empty($profile['country']) || empty($profile['state']) || empty($profile['city']) || empty($profile['pin']) || empty($profile['landmark']) || empty($profile['qualification']) || empty($profile['board']) || empty($profile['language']) || empty($profile['study_field']) || empty($profile['experience']) || empty($profile['details']) || empty($profile['location']) || empty($profile['preferred_job_type']) || empty($profile['mobile_number']) || empty($profile['whatsapp_number']) || empty($profile['cv']) || empty($profile['aadhar'])) {
      header("location:my_profile.php");
      exit();
    }
  }
  ?>

  <?php
  include(__DIR__ . '/connection/db.php');
  $id = $_GET['id'];

  $user_email = $_SESSION['email'];

  // $query = mysqli_query($conn, "SELECT * FROM `all_jobs` WHERE `job_id` = '$id'");

  $sql = "SELECT *
FROM `all_jobs`
LEFT JOIN `company` ON `all_jobs`.`job_customer_email` = `company`.`company_email`
LEFT JOIN `profiles` ON `all_jobs`.`job_customer_email` = `profiles`.`user_email`
WHERE `job_id` = '$id'";

  $query = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_array($query)) {
    $id_job = $row['job_id'];
    $customer_email = $row['job_customer_email'];
    $title = $row['job_title'];
    $salary = $row['job_salary'];
    $des = $row['job_des'];
    $job_type = $row['job_type'];
    $country = $row['job_country'];
    $state = $row['job_state'];
    $city = $row['job_city'];
    $category = $row['job_category'];
    $sub_category = $row['job_sub_category'];

    $first_name2 = $row['first_name'];
    $last_name2 = $row['last_name'];
    $verification = $row['verification'];

    $company = $row['company'];
    $company_industry = $row['company_industry'];
    $company_des = $row['company_des'];
    $company_country = $row['company_country'];
    $company_state = $row['company_state'];
    $company_city = $row['company_city'];
    $company_pin = $row['company_pin'];
    $company_admin = $row['company_admin'];
    $company_designation = $row['company_designation'];
    $company_number = $row['company_number'];
    $company_proof = $row['company_proof'];
    $company_email = $row['company_email'];
  }


  $query1 = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
  while ($row = mysqli_fetch_array($query1)) {
    $img1 = $row['img'];

    $employee_id1 = $row['id'];

    $first_name1 = $row['first_name'];
    $last_name1 = $row['last_name'];
    $dob1 = $row['dob'];
    $gender1 = $row['gender'];
    $country1 = $row['country'];
    $state1 = $row['state'];
    $city1 = $row['city'];
    $pin1 = $row['pin'];
    $landmark1 = $row['landmark'];
    $qualification1 = $row['qualification'];
    $board1 = $row['board'];
    $language1 = $row['language'];
    $study_field1 = $row['study_field'];
    $experience1 = $row['experience'];
    $details1 = $row['details'];
    $location1 = $row['location'];
    $job_type1 = $row['preferred_job_type'];
    $mobile_number1 = $row['mobile_number'];
    $whatsapp_number1 = $row['whatsapp_number'];

    $cv1 = $row['cv'];
    $aadhar1 = $row['aadhar'];
  }

  ?>

  <?php

  if ($customer_email == $_SESSION['email']) {

    echo "<script>
          alert('You cannot apply to a job you posted!');
          window.location.href = 'index.php';
          </script>";
    exit();
  } else {

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
          background-color: white;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label-style {
          font-weight: bold;
          color: #000;
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
                    if (empty($first_name1) && empty($last_name1)) {
                      echo $_SESSION['email'];
                    } else {
                      echo trim($first_name1 . ' ' . $last_name1);
                    }
                    ?>
                  </a></li>
                <li class="nav-item custom-dropdown">
                  <div class="custom-dropdown-container">
                    <img src="profile_img/<?php echo empty($img1) ? "logo.png" : $img1; ?>" class="custom-profile-img"
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


      <!-- <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center text-md-left mb-5" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Apply Job</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Apply Job</h1>
          </div>
        </div>
      </div>
    </div> -->
      <br>
      <br>

      <section class="ftco-degree-bg">
        <div class="container container-style">
          <div class="row">
            <div class="col-md-12 ftco-animate">


              <h2>
                <td>
                  <?php echo $title; ?>
                  <span class="bg-primary text-white badge py-2 px-2"><?php echo $verification; ?></span>
                </td>
              </h2>
              <h5>
                <div class="badge-wrap">
                  <span class="bg-success text-white badge py-1 px-1"><?php echo $company; ?></span>
                  <span class="bg-success text-white badge py-1 px-1"><?php echo $company_industry; ?></span>
                </div>
              </h5>

              <h5><span class="icon-my_location"></span>
                <?php echo $country; ?>,
                <?php echo $state; ?>,
                <?php echo $city; ?>
              </h5>
              <div>
                <span class="icon-briefcase"> <?php echo $salary; ?></span><br>
                <span class="icon-class"> <?php echo $job_type; ?></span><br>
                <span class="icon-layers">
                  <?php echo $category; ?>     <?php if (!empty($sub_category))
                            echo ' - ' . $sub_category; ?></span><br>
                <span class="icon-description"> <?php echo $des; ?></span>
              </div>

            </div>

          </div>
        </div>
      </section>



      <section class="ftco-degree-bg mb-5">
        <div class="container container-style">
          <div class="row">
            <div class="col-md-12 ftco-animate">

              <form action="apply_job.php" method="POST" name="jobportal" id="jobportal" enctype="multipart/form-data">
                <!-- <div style="padding: 2%;"> -->

                <input type="hidden" name="job_seeker" id="job_seeker" value="<?php echo $_SESSION['email']; ?>">

                <input type="hidden" name="id_job" id="id_job" value="<?php echo $id_job; ?>">
                <input type="hidden" name="customer_email" id="customer_email" value="<?php echo $customer_email; ?>">
                <input type="hidden" name="first_name2" id="first_name2" value="<?php echo $first_name2; ?>">
                <input type="hidden" name="last_name2" id="last_name2" value="<?php echo $last_name2; ?>">
                <input type="hidden" name="job_title2" id="job_title2" value="<?php echo $title; ?>">
                <input type="hidden" name="city2" id="city2" value="<?php echo $city; ?>">
                <input type="hidden" name="employee_id1" id="employee_id1" value="<?php echo $employee_id1; ?>">

                <div class="row mb-3">
                  <div class="col-sm-6">
                    <label for="" class="form-label-style">Enter First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name..."
                      value="<?php if (!empty($first_name1))
                        echo $first_name1; ?>" required readonly>
                  </div>
                  <div class="col-sm-6">
                    <label for="" class="form-label-style">Enter Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name..."
                      value="<?php if (!empty($last_name1))
                        echo $last_name1; ?>" required readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-6">
                    <label for="" class="form-label-style">Enter Date of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob" value="<?php if (!empty($dob1))
                      echo $dob1; ?>" required readonly>
                  </div>
                  <div class="col-sm-6">
                    <label for="" class="form-label-style">Select Gender</label>
                    <select class="form-control" name="gender" id="gender" required readonly>
                      <option value="<?php if (!empty($gender1))
                        echo $gender1; ?>">
                        <?php if (!empty($gender1))
                          echo $gender1;
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
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="" class="form-label-style">Country</label>
                      <select name="country" class="countries form-control" id="countryDropdown" required readonly>
                        <option value="<?php if (!empty($country1))
                          echo $country1; ?>">
                          <?php if (!empty($country1))
                            echo $country1;
                          else
                            echo "Select Country"; ?>
                        </option>
                        <!-- <option value="">Select Country</option> -->
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="" class="form-label-style">State</label>
                      <select name="state" class="states form-control" id="stateDropdown" required readonly>
                        <option value="<?php if (!empty($state1))
                          echo $state1; ?>">
                          <?php if (!empty($state1))
                            echo $state1;
                          else
                            echo "Select State"; ?>
                        </option>
                        <!-- <option value="">Select State</option> -->
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="" class="form-label-style">City</label>
                      <select name="city" class="cities form-control" id="cityDropdown" required readonly>
                        <option value="<?php if (!empty($city1))
                          echo $city1; ?>">
                          <?php if (!empty($city1))
                            echo $city1;
                          else
                            echo "Select City"; ?>
                        </option>
                        <!-- <option value="">Select City</option> -->
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <label for="" class="form-label-style">Enter PIN Code</label>
                    <input type="number" class="form-control" name="pin" id="pin" placeholder="eg. 700132" value="<?php if (!empty($pin1))
                      echo $pin1; ?>" required readonly>
                  </div>

                </div>

                <div class="row mb-3">
                  <div class="col-sm-4">
                    <label for="" class="form-label-style">Select Highest Qualification</label>
                    <select class="form-control" name="qualification" id="qualification" required readonly>
                      <option value="<?php if (!empty($qualification1))
                        echo $qualification1; ?>">
                        <?php if (!empty($qualification1))
                          echo $qualification1;
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

                  <div class="col-sm-4">
                    <label for="" class="form-label-style">Select 10th Standard Board</label>
                    <select class="form-control" name="board" id="board" required readonly>
                      <option value="<?php if (!empty($board1))
                        echo $board1; ?>">
                        <?php if (!empty($board1))
                          echo $board1;
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

                  <div class="col-sm-4">
                    <label for="" class="form-label-style">Enter Most Preferred Language</label>
                    <select class="form-control" name="language" id="language" required readonly>
                      <option value="<?php if (!empty($language1))
                        echo $language1; ?>">
                        <?php if (!empty($language1))
                          echo $language1;
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

                <div class="row mb-3">
                  <div class="col-sm-6">
                    <label for="" class="form-label-style">Enter Field of Study</label>
                    <input type="text" class="form-control" name="study_field" id="study_field"
                      placeholder="eg. Engineering, Management etc." value="<?php if (!empty($study_field1))
                        echo $study_field1; ?>" required readonly>
                  </div>
                  <div class="col-sm-6">
                    <label for="" class="form-label-style">Select Experience</label>
                    <select class="form-control" name="experience" id="experience" required readonly>
                      <option value="<?php if (!empty($experience1))
                        echo $experience1; ?>">
                        <?php if (!empty($experience1))
                          echo $experience1;
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
                    <textarea placeholder="Max. 100 words" class="form-control" name="details" id="details" required
                      readonly><?php if (!empty($details1))
                        echo $details1; ?></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <li><label for="" class="form-label-style">PS: Your Profile Image will be uploaded</label></li>
                    <li><label for="" class="form-label-style">PS: Kindly ensure your profile is completely filled before
                        submitting the form.</label></li>
                  </div>
                </div>
                <input type="submit" name="submit" id="submit" value="submit" class="btn btn-success btn-success-style"
                  placeholder="Submit">
                <!-- </div> -->
              </form>


            </div>

          </div>
        </div>
      </section>


      <!-- <section class="ftco-section-parallax">
    <div class="parallax-img d-flex align-items-center">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
            <h2>Subcribe to our Newsletter</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
              blind texts. Separated they live in</p>
            <div class="row d-flex justify-content-center mt-4 mb-4">
              <div class="col-md-8">
                <form action="#" class="subscribe-form">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control" placeholder="Enter email address">
                    <input type="submit" value="Subscribe" class="submit px-3">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

      <?php
      include(__DIR__ . '/include/footer.php');
      ?>

      <?php
  }
} else {
  header('location:job-post.php');
  exit();
}
?>