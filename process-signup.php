<?php
// error_reporting(0);
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $admin_type = '2';

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $activation_token = bin2hex(random_bytes(16));
    $activation_token_hash = hash("sha256", $activation_token);

    $password_pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    $existsemail = "SELECT * FROM `admin_login` WHERE `admin_email` = '$email'";
    $result = mysqli_query($mysqli, $existsemail);
    $numexistsemail = mysqli_num_rows($result);


    // Referral System Starts
    $referral_code = strtoupper(bin2hex(random_bytes(4)));
    $referral_point = 0;
    $exists_referral = "SELECT * FROM `profiles` WHERE `referral_code` = '$referral_code'";
    $result2 = mysqli_query($mysqli, $exists_referral);
    $num_exists_referral = mysqli_num_rows($result2);

    function updateReferral()
    {
        global $referral_point;
        global $mysqli;
        $referral_input = $mysqli->real_escape_string($_POST['referral_code']);
        $query = "SELECT * FROM `profiles` WHERE `referral_code` = '$referral_input'";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $result_fetch = mysqli_fetch_array($result);
                $point = (int) $result_fetch['referral_point'] + 10;
                $update_query = "UPDATE `profiles` SET `referral_point` = '$point' WHERE `user_email` = '{$result_fetch['user_email']}'";
                $result2 = mysqli_query($mysqli, $update_query);
                if ($result2) {
                    $referral_point = 10;
                } else {
                    echo "<script>alert('SQL Error: " . $mysqli->error . "'); window.location.href='signup.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Invalid Referral Code, Please Try Again!'); window.location.href='signup.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('SQL Error: " . $mysqli->error . "'); window.location.href='signup.php';</script>";
            exit();

        }
    }
    // Referral System Ends


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please Enter a Valid Email!')</script>";
    } else if ($numexistsemail > 0) {
        echo "<script>alert('Email Already Exists, Please Try Again!')</script>";
    } else if ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match!')</script>";
    } else if (!preg_match($password_pattern, $password)) {
        echo "<script>alert('Password must contain at least one letter, one number, one symbol, and be at least 8 characters long.')</script>";
    } else if ($num_exists_referral > 0) {
        echo "<script>alert(Internal Server Error, Please Try Again!')</script>";
    } else {

        if ($_POST['referral_code'] != "") {
            updateReferral();
        }

        $sql = "INSERT INTO `admin_login` (`admin_email`, `admin_pass`, `first_name`, `last_name`, `admin_number`, `admin_type`, `account_activation_hash`) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            echo "<script>alert('SQL Error: " . $mysqli->error . "');</script>";
        } else {
            $stmt->bind_param("sssssss", $email, $password_hash, $first_name, $last_name, $mobile_number, $admin_type, $activation_token_hash);

            if ($stmt->execute()) {

                // Insert into `profiles` table
                $profile_sql = "INSERT INTO `profiles` (`user_email`, `mobile_number`, `verification`, `referral_code`, `referral_point`) VALUES (?, ?, ?, ?, ?)";
                $profile_stmt = $mysqli->stmt_init();

                if (!$profile_stmt->prepare($profile_sql)) {
                    echo "<script>alert('SQL Error (Profiles): " . $mysqli->error . "');</script>";
                } else {
                    $verification = 'Unverified';
                    $profile_stmt->bind_param("sssss", $email, $mobile_number, $verification, $referral_code, $referral_point);

                    if ($profile_stmt->execute()) {


                        $mail = require __DIR__ . "/mailer.php";
                        $mail->setFrom("joblyfeforyou@gmail.com", "JobLyfe");
                        $mail->addAddress($email, $first_name);
                        $mail->Subject = "JobLyfe: Account Activation";
                        $mail->Body = <<<END

    Click <a href="https://joblyfe.com/activate-account.php?token=$activation_token">here</a> to activate your account.

    END;

                        try {
                            $mail->send();
                            echo "<script>alert('Please check your email to activate your account!'); window.location.href = 'index.php';</script>";
                            exit();
                        } catch (Exception $e) {
                            echo "<script>alert('Message could not be sent. Mailer error: {$mail->ErrorInfo}');</script>";
                        }



                    } else {
                        echo "<script>alert('Error: " . $mysqli->error . "');</script>";
                    }
                }
            } else {
                echo "<script>alert('Error: " . $mysqli->error . "');</script>";
            }
        }

    }
} else {
    header('location:job-post.php');
    exit();
}

?>