<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="img/joblyfetitle.png">
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
      width: 80px;
      height: 80px;
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

    .form-container input[type="submit"] {
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

    .form-container input[type="submit"]:hover {
      background: #8a2be2;
    }

    .form-container p {
      margin-top: 15px;
      font-size: 0.9rem;
      color: #ddd;
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 20px 20px;
      }

      .form-container h1 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="form-container">
    <form id="admin_login" name="admin_login" method="POST" action="admin_login.php">
      <img src="img/joblyfe.png" alt="Logo">
      <h1>Admin Login</h1>
      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <input type="submit" id="submit" name="submit" value="Sign In">
    </form>
  </div>
</body>

</html>

<?php
include(__DIR__ . '/connection/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email`='$email'");
  if ($query) {
    if (mysqli_num_rows($query) == 1) {
      while ($row = mysqli_fetch_array($query)) {
        if (password_verify($password, $row['admin_pass'])) {
          session_start();
          session_regenerate_id();
          $_SESSION['email'] = $email;
          header('location:admin_dashboard.php');
          exit();
        }
      }
    } else {
      echo "<script>alert('Email or password is incorrect, please try again')</script>";
    }
  }
}
?>