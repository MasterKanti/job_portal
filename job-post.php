<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="admin/img/joblyfetitle.png">
  <title>JobLyfe: Where Talent Meets Opportunity</title>

  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #4b0082, rgb(200, 150, 255));
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background: #3a007d;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .form-container img {
      margin-bottom: 20px;
    }

    .form-container h1 {
      font-size: 1.8rem;
      margin-bottom: 20px;
    }

    .form-container .form-control {
      width: 100%;
      padding: 10px 15px;
      margin-bottom: 15px;
      border: none;
      border-radius: 5px;
      background: #4c008c;
      color: #fff;
      font-size: 1rem;
    }

    .form-container .form-control::placeholder {
      color: #ddd;
    }

    .form-container .btn {
      width: 100%;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      background: #6a0dad;
      color: #fff;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .form-container .btn:hover {
      background: #8a2be2;
    }

    .form-container a {
      color: #ddd;
      text-decoration: none;
      font-size: 0.9rem;
      display: block;
      margin: 10px 0;
      transition: color 0.3s ease;
    }

    .form-container a:hover {
      color: #fff;
    }

    .form-container p {
      font-size: 0.9rem;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <form action="job-post.php" method="POST">
      <img src="admin/img/joblyfe.png" alt="Logo" width="100" height="100">
      <h1>Please Sign In</h1>
      <input type="email" id="email" class="form-control" name="email" placeholder="Email address" required autofocus
        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
      <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
      <input class="btn" type="submit" name="submit" value="Sign In">
      <a href="signup.php">Create an Account</a>
      <a href="forgot-password.php">Forgot Password?</a>
    </form>
  </div>
</body>

</html>



<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $mysqli = require __DIR__ . "/database.php";

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = sprintf("SELECT * FROM admin_login 
                  WHERE admin_email = '%s'",
    $mysqli->real_escape_string($_POST["email"])
  );

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();

  if ($user) {

    if ($user['account_activation_hash'] === NULL) {

      if (password_verify($password, $user['admin_pass'])) {

        session_start();
        session_regenerate_id();
        $_SESSION['email'] = $user['admin_email'];
        header('location:index.php');
        exit();

      } else {
        echo "<script>alert('Password is incorrect, please try again!')</script>";
      }

    } else {
      echo "<script>alert('Email has not been activated, please check your inbox to activate!')</script>";
    }

  } else {
    echo "<script>alert('Email or password is incorrect, please try again!')</script>";
  }

}




// include('connection/db.php');

// if (isset($_POST['submit'])){
//     $email=$_POST['email'];
//     $password=$_POST['password'];

// $query = mysqli_query($conn, "SELECT * FROM `admin_login` where `admin_email`='$email'");
//   if($query){
//       if (mysqli_num_rows($query) == 1){
//         while ($row=mysqli_fetch_array($query)){
//           if(password_verify($password, $row['admin_pass'])){
//             session_start();
//             session_regenerate_id();
//             $_SESSION['email']=$email;
//             header('location:index.php');
//             exit();
//           }
//         }
//       }
//       else{
//           echo "<script>alert('Email or password is incorrect, please try again')</script>";
//       }
//   }
// }
?>