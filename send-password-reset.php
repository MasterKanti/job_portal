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
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
        $email = $_POST['email'];

        // Check whether $email is present in admin_login and select first_name
        include(__DIR__ . '/connection/db.php');
        $query = "SELECT * FROM admin_login WHERE admin_email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);
          $first_name = $row['first_name'];



          $token = bin2hex(random_bytes(16));
          $token_hash = hash("sha256", $token);

          $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

          require __DIR__ . '/connection/db.php';

          $sql = "UPDATE `admin_login` 
SET `reset_token_hash` = ?, 
reset_token_expires_at = ? 
WHERE `admin_login`.`admin_email` = ?";

          $stmt = $conn->prepare($sql);

          $stmt->bind_param("sss", $token_hash, $expiry, $email);

          $stmt->execute();

          if ($conn->affected_rows) {
            $mail = require __DIR__ . "/mailer.php";
            $mail->setFrom("joblyfeforyou@gmail.com", "JobLyfe");
            $mail->addAddress($email, $first_name);
            $mail->Subject = "JobLyfe: Password Reset";
            $mail->Body = <<<END

    Click <a href="https://joblyfe.com/reset-password.php?token=$token">here</a> to reset your password.

    END;

            try {
              $mail->send();
            } catch (Exception $e) {
              echo "<p class='lead'>Message could not be sent. Mailer error: {$mail->ErrorInfo}</p>";
            }
          }

          // echo "Message sent, please check your inbox.";
          echo "<p class='lead'>Message sent, please check your inbox!!!</p>";
        } else {
          echo "<script>
          alert('No such email exists, please try again!');
          window.location.href = 'forgot-password.php';
        </script>";
          exit();
        }
      } else {
        header('location:job-post.php');
        exit();
      }
      ?>

      <p class="lead">
        <a href="job-post.php" class="btn btn-lg btn-secondary">Back</a>
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