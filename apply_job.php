<?php
session_start();
if ($_SESSION['email'] == true) {
} else {
  header('location:job-post.php');
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
    <!-- <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Cover</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link" href="#">Features</a>
            <a class="nav-link" href="#">Contact</a>
          </nav>
        </div>
      </header> -->

    <main role="main" class="inner cover">
      <h1 class="cover-heading">Thank You For Visiting Us!</h1>

      <?php

      // PHPMailer Starts
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
      // PHPMailer Ends
      
      include(__DIR__ . '/connection/db.php');
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {


        $job_seeker = $_POST['job_seeker'];

        $id_job = $_POST['id_job'];
        $customer_email = $_POST['customer_email'];
        $first_name2 = $_POST['first_name2'];
        $last_name2 = $_POST['last_name2'];
        $job_title2 = $_POST['job_title2'];
        $city2 = $_POST['city2'];
        $employee_id1 = $_POST['employee_id1'];

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $pin = $_POST['pin'];
        $qualification = $_POST['qualification'];
        $board = $_POST['board'];
        $language = $_POST['language'];
        $study_field = $_POST['study_field'];
        $experience = $_POST['experience'];
        $details = $_POST['details'];

        $sql = mysqli_query($conn, "SELECT * FROM `job_apply` WHERE `job_seeker` = '$job_seeker' AND `id_job` = '$id_job'");
        if (mysqli_num_rows($sql) > 0) {
          echo "<p class='lead'>Your have already applied!!!</p>";
        } else {

          $img = 'profile.png';
          $query1 = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
          while ($row = mysqli_fetch_array($query1)) {
            $img = $row['img'];
          }
          $query = mysqli_query($conn, "INSERT INTO `job_apply` (`first_name`, `last_name`, `dob`, `gender`, `country`, `state`, `city`, `pin`, `qualification`, `board`, `language`, `study_field`, `experience`, `details`, `file`, `id_job`, `job_seeker`) VALUES ('$first_name', '$last_name', '$dob', '$gender', '$country', '$state', '$city', '$pin', '$qualification', '$board', '$language', '$study_field', '$experience', '$details', '$img', '$id_job', '$job_seeker')");
          if ($query) {
            echo "<p class='lead'>Your Application has been submitted successfully!!!</p>";

          } else {
            echo "<p class='lead'>An error occurred, Please try again!!!</p>";
          }
        }


        // PHPMailer Starts
        require __DIR__ . '/admin/email/vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {

          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'joblyfeforyou@gmail.com';

          $mail->Password = 'znzo dwuv pkqj ltpb';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $mail->setFrom('joblyfeforyou@gmail.com', 'JobLyfe');

          $mail->addAddress($customer_email, $first_name2);

          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = "Excellent! Your Job Posting On JobLyfe [JOB ID: $id_job] Has Received A New Application";

          $message = "Dear " . strtoupper($first_name2) . " " . strtoupper($last_name2) . ",\n\n";
          $message .= "I hope this message finds you well. We would like to inform you that your job posting for the job of *" . $job_title2 . "* at *" . $city2 . "* has received a new application. To review the application in detail, please log in to your account on JobLyfe and navigate to the Job Applications section in your Admin Panel. [EMPLOYEE ID: $employee_id1]";

          $mail->Body = $message;
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          echo "<p class='lead'>Employer has been mailed successfully!!!</p>";

        } catch (Exception $e) {
          echo "<p class='lead'>Mail could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
        }
        // PHPMailer Ends
      
      }
      ?>
      <p class="lead">
        <a href="index.php" class="btn btn-lg btn-secondary">Back</a>
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