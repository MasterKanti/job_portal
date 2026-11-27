<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_profile'])) {
  ?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="admin/img/joblyfetitle.png">
    <title>JobLyfe: Where Talent Meets Opportunity</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <style type="text/css">
      /*
   * Globals
   */

      /* Links */
      a,
      a:focus,
      a:hover {
        color: #fff;
      }

      /* Custom default button */
      .btn-secondary,
      .btn-secondary:hover,
      .btn-secondary:focus {
        color: #333;
        text-shadow: none;
        /* Prevent inheritance from `body` */
        background-color: #fff;
        border: .05rem solid #fff;
      }


      /*
   * Base structure
   */

      html,
      body {
        height: 100%;
        background-color: #333;
      }

      body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-pack: center;
        -webkit-box-pack: center;
        justify-content: center;
        color: #fff;
        text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
      }

      .cover-container {
        max-width: 42em;
      }


      /*
   * Header
   */
      .masthead {
        margin-bottom: 2rem;
      }

      .masthead-brand {
        margin-bottom: 0;
      }

      .nav-masthead .nav-link {
        padding: .25rem 0;
        font-weight: 700;
        color: rgba(255, 255, 255, .5);
        background-color: transparent;
        border-bottom: .25rem solid transparent;
      }

      .nav-masthead .nav-link:hover,
      .nav-masthead .nav-link:focus {
        border-bottom-color: rgba(255, 255, 255, .25);
      }

      .nav-masthead .nav-link+.nav-link {
        margin-left: 1rem;
      }

      .nav-masthead .active {
        color: #fff;
        border-bottom-color: #fff;
      }

      @media (min-width: 48em) {
        .masthead-brand {
          float: left;
        }

        .nav-masthead {
          float: right;
        }
      }


      /*
   * Cover
   */
      .cover {
        padding: 0 1.5rem;
      }

      .cover .btn-lg {
        padding: .75rem 1.25rem;
        font-weight: 700;
      }


      /*
   * Footer
   */
      .mastfoot {
        color: rgba(255, 255, 255, .5);
      }
    </style>

  </head>

  <body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Thank You For Visiting Us!</h1>

        <?php
        session_start();
        include(__DIR__ . '/connection/db.php');

        $maxFileSize = 500 * 1024; // 500 KB
        $allowedImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        $allowedCVAadharTypes = ['application/pdf'];


        // Validate Profile Photo
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['img'])) {
          $file = $_FILES['img'];
          if ($file['size'] > $maxFileSize) {
            die("Error: Profile photo exceeds 500 KB.");
          }
          if (!in_array($file['type'], $allowedImageTypes)) {
            die("Error: Invalid profile photo type.");
          }

          $imgType = $_FILES['img']['type'];
          switch ($imgType) {
            case 'image/jpeg':
              $extension = 'jpg';
              break;
            case 'image/jpg':
              $extension = 'jpg';
              break;
            case 'image/png':
              $extension = 'png';
              break;
            default:
              die("Unsupported profile photo type.");
          }
          $imgHash = hash_file('sha256', $_FILES['img']['tmp_name']);
          $newimgName = 'profile_' . $imgHash . '.' . $extension;
        }

        // Validate CV
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['cv'])) {
          $file = $_FILES['cv'];
          if ($file['size'] > $maxFileSize) {
            die("Error: CV exceeds 500 KB.");
          }
          if (!in_array($file['type'], $allowedCVAadharTypes)) {
            die("Error: Invalid CV type.");
          }

          $cvHash = hash_file('sha256', $_FILES['cv']['tmp_name']);
          $newcvName = 'cv_' . $cvHash . '.pdf';
        }

        // Validate Aadhar Card
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['aadhar'])) {
          $file = $_FILES['aadhar'];
          if ($file['size'] > $maxFileSize) {
            die("Error: Aadhar card exceeds 500 KB.");
          }
          if (!in_array($file['type'], $allowedCVAadharTypes)) {
            die("Error: Invalid Aadhar card type.");
          }

          $aadharHash = hash_file('sha256', $_FILES['aadhar']['tmp_name']);
          $newaadharName = 'aadhar_' . $aadharHash . '.pdf';
        }


        // $img=$_FILES['img']['name'];
        // $tmp_name=$_FILES['img']['tmp_name'];
      
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $pin = $_POST['pin'];
        $landmark = $_POST['landmark'];
        $qualification = $_POST['qualification'];
        $board = $_POST['board'];
        $language = $_POST['language'];
        $study_field = $_POST['study_field'];
        $experience = $_POST['experience'];
        $details = $_POST['details'];
        $location = $_POST['location'];
        $job_type = $_POST['job_type'];
        $mobile_number = $_POST['mobile_number'];
        $whatsapp_number = $_POST['whatsapp_number'];

        // $cv=$_FILES['cv']['name'];
        // $tmp_name2=$_FILES['cv']['tmp_name'];
      
        // $aadhar=$_FILES['aadhar']['name'];
        // $tmp_name3=$_FILES['aadhar']['tmp_name'];
      
        $terms = $_POST['terms'];

        $user_email = $_SESSION['email'];


        $sql = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
        $sql_check = mysqli_num_rows($sql);

        if (!empty($sql_check)) {
          $query = mysqli_query($conn, "UPDATE `profiles` SET `img` = '$newimgName', `first_name` = '$first_name', `last_name` = '$last_name', `dob` = '$dob', `gender` = '$gender', `country` = '$country', `state` = '$state', `city` = '$city', `pin` = '$pin', `landmark` = '$landmark', `qualification` = '$qualification', `board` = '$board', `language` = '$language', `study_field` = '$study_field', `experience` = '$experience', `details` = '$details', `location` = '$location', `preferred_job_type` = '$job_type', `mobile_number` = '$mobile_number', `whatsapp_number` = '$whatsapp_number', `cv` = '$newcvName', `aadhar` = '$newaadharName', `terms` = '$terms' WHERE `user_email` = '$user_email'");

          move_uploaded_file($_FILES["img"]["tmp_name"], 'profile_img/' . $newimgName);
          move_uploaded_file($_FILES["cv"]["tmp_name"], 'cv/' . $newcvName);
          move_uploaded_file($_FILES["aadhar"]["tmp_name"], 'aadhar/' . $newaadharName);

          if ($query) {
            echo "<p class='lead'>Your Profile has been updated successfully!!!</p>";
          } else {
            echo "<p class='lead'>An error occurred, Please try again!!!</p>";
          }
        } else {
          move_uploaded_file($_FILES["img"]["tmp_name"], 'profile_img/' . $newimgName);
          move_uploaded_file($_FILES["cv"]["tmp_name"], 'cv/' . $newcvName);
          move_uploaded_file($_FILES["aadhar"]["tmp_name"], 'aadhar/' . $newaadharName);

          $query = mysqli_query($conn, "INSERT INTO `profiles` (`img`, `first_name`, `last_name`, `dob`, `gender`, `country`, `state`, `city`, `pin`, `landmark`, `qualification`, `board`, `language`, `study_field`, `experience`, `details`, `location`, `preferred_job_type`, `mobile_number`, `whatsapp_number`, `cv`, `aadhar`, `terms`, `verification`, `user_email`) VALUES ('$newimgName', '$first_name', '$last_name', '$dob', '$gender', '$country', '$state', '$city', '$pin', '$landmark', '$qualification', '$board', '$language', '$study_field', '$experience', '$details', '$location', '$job_type', '$mobile_number', '$whatsapp_number', '$newcvName', '$newaadharName', '$terms', 'Unverified', '$user_email')");
          if ($query) {
            echo "<p class='lead'>Your Profile has been added successfully!!!</p>";
          } else {
            echo "<p class='lead'>An error occurred, Please try again!!!</p>";
          }
        }
        ?>
        <p class="lead">
          <a href="my_profile.php" class="btn btn-lg btn-secondary">Back</a>
        </p>

      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> | All Rights Reserved | Designed and Developed by
            <a href="https://idlehax.com" target="_blank">Idlehax Technologies</a>
          </p>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- <script type="text/javascript">
      function Redirect(){
        window.location.href = ("http://localhost/job_portal");
      }
      document.write("Please wait you will be redirected in 10 sec");
      // inverted comma not completed
      secTimeout('Redirect(), 10000);
    </script> -->
  </body>

  </html>

  <?php
} else {
  header('location:job-post.php');
  exit();
}
?>