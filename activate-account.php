<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["token"])) {
  $token = $_GET["token"];

  $token_hash = hash("sha256", $token);

  require __DIR__ . '/connection/db.php';

  $sql = "SELECT * FROM admin_login
WHERE account_activation_hash = ?";

  $stmt = $conn->prepare($sql);

  $stmt->bind_param("s", $token_hash);

  $stmt->execute();

  $result = $stmt->get_result();

  $user = $result->fetch_assoc();

  if ($user === null) {
    die("Token not found");
  }

  $sql = "UPDATE `admin_login` SET `account_activation_hash` = NULL WHERE `id` = ?";

  $stmt = $conn->prepare($sql);

  $stmt->bind_param("s", $user['id']);

  $stmt->execute();
  ?>

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

      .form-container h1 {
        font-size: 1.8rem;
        margin-bottom: 20px;
      }

      .form-container label {
        display: block;
        margin-bottom: 8px;
        font-size: 1rem;
        text-align: left;
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

      .form-container button {
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

      .form-container button:hover {
        background: #8a2be2;
      }

      .form-container a {
        color: #ddd;
        text-decoration: none;
        font-size: 0.9rem;
        display: block;
        margin-top: 10px;
        transition: color 0.3s ease;
      }

      .form-container a:hover {
        color: #fff;
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
      <img src="admin/img/joblyfe.png" alt="Logo" width="100" height="100">
      <h1>Account Activated</h1>
      <p>Account Activated Successfully!<br>You can now <a href="job-post.php">LOGIN</a></p>
    </div>
  </body>

  </html>


  <?php
} else {
  header('location:job-post.php');
  exit();
}
?>