<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["token"])) {
  $token = $_POST["token"];

  $token_hash = hash("sha256", $token);

  require __DIR__ . '/connection/db.php';

  $sql = "SELECT * FROM admin_login
WHERE reset_token_hash = ?";

  $stmt = $conn->prepare($sql);

  $stmt->bind_param("s", $token_hash);

  $stmt->execute();

  $result = $stmt->get_result();

  $user = $result->fetch_assoc();

  if ($user === null) {
    echo "<script>
            alert('Token not found');
            window.history.back();
          </script>";
    exit();
  } else if (strtotime($user["reset_token_expires_at"]) <= time()) {
    echo "<script>
            alert('Token has expired');
            window.history.back();
          </script>";
    exit();
  } else if (strlen($_POST["password"]) < 8) {
    echo "<script>
            alert('Password must be at least 8 characters');
            window.history.back();
          </script>";
    exit();
  } else if (!preg_match("/[a-z]/i", $_POST["password"])) {
    echo "<script>
            alert('Password must contain at least one letter');
            window.history.back();
          </script>";
    exit();
  } else if (!preg_match("/[0-9]/", $_POST["password"])) {
    echo "<script>
            alert('Password must contain at least one number');
            window.history.back();
          </script>";
    exit();
  } else if (!preg_match("/[\W_]/", $_POST["password"])) {
    echo "<script>
            alert('Password must contain at least one symbol');
            window.history.back();
          </script>";
    exit();
  } else if ($_POST["password"] !== $_POST["password_confirmation"]) {
    echo "<script>
            alert('Passwords must match');
            window.history.back();
          </script>";
    exit();
  } else {
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "UPDATE admin_login
        SET admin_pass = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $password_hash, $user["id"]);

    $stmt->execute();


    echo "<script>
        alert('Password has been updated, you can now login');
        window.location.href = 'job-post.php';
      </script>";
    exit();


    // Redirect here to login page
// Use script alert instead of die
  }
} else {
  header('location:job-post.php');
  exit();
}
?>