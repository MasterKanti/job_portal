<?php
include(__DIR__ . '/connection/db.php');
include(__DIR__ . '/include/header.php');
include(__DIR__ . '/include/sidebar.php');

$id = $_GET['edit'];
$query = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `id` = '$id'");
while ($row = mysqli_fetch_array($query)) {

  $img = $row['img'];

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
  $verification = $row['verification'];
  $user_email = $row['user_email'];
  $referral_code = $row['referral_code'];
  $referral_point = $row['referral_point'];

  $aadhar = $row['aadhar'];
  $cv = $row['cv'];

}

$query1 = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email` = '{$_SESSION['email']}'");
while ($row1 = mysqli_fetch_array($query1)) {
  $admin_type1 = $row1['admin_type'];
}

$query2 = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email` = '$user_email'");
while ($row2 = mysqli_fetch_array($query2)) {
  $admin_type2 = $row2['admin_type'];
}
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="profiles.php">Customer Profiles</a></li>
      <li class="breadcrumb-item"><a href="profile_edit.php?edit=<?php echo $id; ?>">Update Profile</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">Update Profile</h1>


    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <!-- <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button> -->
      </div>
      <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle"> -->

      <!-- <a class="btn btn-primary" href="add_customer.php">Add Customer</a> -->
    </div>
  </div>


  <div style="width: 60%; margin-left: 20%; background-color: #F2F4F4;">

    <div id="msg"></div>
    <form action="" method="POST" style="margin: 3%; padding: 3%;" name="customer_form" id="customer_form"
      enctype="multipart/form-data">

      <div class="form-group">
        <label for="">PS: Fields marked with * are mandatory.</label>
      </div>


      <div class="form-group">
        <label for="">Update Profile Photo (.jpeg, .jpg, .png) under 200 KB :</label>
        <input type="file" class="form-control" name="img" id="img" accept=".jpg, .jpeg, .png">
      </div>

      <div class="form-group">
        <label for="">* Update First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php if (!empty($first_name))
          echo $first_name; ?>" class="form-control" placeholder="Enter First Name" required>
      </div>

      <div class="form-group">
        <label for="">* Update Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php if (!empty($last_name))
          echo $last_name; ?>" class="form-control" placeholder="Enter Last Name" required>
      </div>


      <div class="form-group">
        <label for="">* Update Date of Birth</label>
        <input type="date" name="dob" id="dob" value="<?php if (!empty($dob))
          echo $dob; ?>" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="">* Update Gender</label>
        <select class="form-control" name="gender" id="gender" required>
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

      <div class="form-group">
        <label for="">* Update Country</label>
        <select name="country" class="countries form-control" id="countryDropdown" required>
          <option value="<?php if (!empty($country))
            echo $country; ?>">
            <?php if (!empty($country))
              echo $country;
            else
              echo "Select Country"; ?>
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="">* Update State</label>
        <select name="state" class="states form-control" id="stateDropdown" required>
          <option value="<?php if (!empty($state))
            echo $state; ?>">
            <?php if (!empty($state))
              echo $state;
            else
              echo "Select State"; ?>
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="">* Update City</label>
        <select name="city" class="cities form-control" id="cityDropdown" required>
          <option value="<?php if (!empty($city))
            echo $city; ?>">
            <?php if (!empty($city))
              echo $city;
            else
              echo "Select City"; ?>
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="">* Update PIN Code</label>
        <input type="number" name="pin" id="pin" value="<?php if (!empty($pin))
          echo $pin; ?>" class="form-control" placeholder="eg. 700132" required>
      </div>

      <div class="form-group">
        <label for="">* Update Nearest Landmark</label>
        <input type="text" name="landmark" id="landmark" value="<?php if (!empty($landmark))
          echo $landmark; ?>" class="form-control" placeholder="eg. Eco Urban Village" required>
      </div>

      <div class="form-group">
        <label for="">Update Highest Qualification</label>
        <select class="form-control" name="qualification" id="qualification">
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

      <div class="form-group">
        <label for="">Update 10th Standard Board</label>
        <select class="form-control" name="board" id="board">
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

      <div class="form-group">
        <label for="">Update Most Preferred Language</label>
        <select class="form-control" name="language" id="language">
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

      <div class="form-group">
        <label for="">Update Field of Study</label>
        <input type="text" name="study_field" id="study_field" value="<?php if (!empty($study_field))
          echo $study_field; ?>" class="form-control" placeholder="eg. Engineering, Management">
      </div>

      <div class="form-group">
        <label for="">Update Experience</label>
        <select class="form-control" name="experience" id="experience">
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

      <div class="form-group">
        <label for="">Update Details of Experiences</label>
        <textarea placeholder="Max. 100 words" class="form-control" name="details" id="details"><?php if (!empty($details))
          echo $details; ?></textarea>
      </div>

      <div class="form-group">
        <label for="">Update Preferred Service Location</label>
        <input type="text" name="location" id="location" value="<?php if (!empty($location))
          echo $location; ?>" class="form-control" placeholder="eg. Newtown, Saltlake">
      </div>

      <div class="form-group">
        <label for="">Update Job Type</label>
        <select class="form-control" name="job_type" id="job_type">
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

      <div class="form-group">
        <label for="">* Update Mobile Number</label>
        <input type="number" class="form-control" name="mobile_number" id="mobile_number" placeholder="eg. 9876543210"
          value="<?php if (!empty($mobile_number))
            echo $mobile_number; ?>" required>
      </div>
      <div class="form-group">
        <label for="">* Update WhatsApp Number</label>
        <input type="number" class="form-control" name="whatsapp_number" id="whatsapp_number"
          placeholder="eg. 9876543210" value="<?php if (!empty($whatsapp_number))
            echo $whatsapp_number; ?>" required>
      </div>



      <div class="form-group">
        <label for="">Update CV/ Biodata (.pdf) under 200 KB :</label>
        <input type="file" class="form-control" name="cv" id="cv" accept=".pdf">
      </div>
      <div class="form-group">
        <label for="">Update Aadhar Card (.pdf) under 200 KB :</label>
        <input type="file" class="form-control" name="aadhar" id="aadhar" accept=".pdf">
      </div>


      <div class="form-group">
        <label for="">* Profile Verification</label>
        <select class="form-control" name="verification" id="verification" required <?php if ($admin_type1 >= $admin_type2)
          echo 'readonly'; ?>>
          <option value="<?php if (!empty($verification))
            echo $verification; ?>">
            <?php if (!empty($verification))
              echo $verification;
            else
              echo "Select Verification"; ?>
          </option>
          <option value="Verified">Verified</option>
          <option value="Unverified">Unverified</option>
        </select>
      </div>



      <div class="form-group">
        <label for="">* User Email</label>
        <input type="text" class="form-control" name="user_email" id="user_email" placeholder="Enter User Email" value="<?php if (!empty($user_email))
          echo $user_email; ?>" required readonly>
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label for="">* Referral Code :</label>
          <input type="text" class="form-control" name="referral_code" id="referral_code"
            placeholder="Enter User Referral Code" value="<?php if (!empty($referral_code))
              echo $referral_code; ?>" required readonly>
        </div>
        <div class="form-group col-sm-6">
          <label for="">Update Referral Point (10 Point = ₹100) :</label><br>
          <button type="button" onclick="decrease()" <?php if ($admin_type1 >= $admin_type2) echo 'disabled'; ?>>-</button>
          <span id="counter"><?= $referral_point ?></span>
          <button type="button" onclick="increase()" <?php if ($admin_type1 >= $admin_type2) echo 'disabled'; ?>>+</button>
        </div>
      </div>

      <input type="hidden" name="value" id="valueInput" value="<?php if (!empty($referral_point))
        echo $referral_point; ?>">



      <div class="row">
        <div class="form-group col-sm-4">
          <label for="">Download Profile Image :</label>
          <td><a href="../profile_img/<?php echo $img; ?>" download>Download</a></td>
        </div>
        <div class="form-group col-sm-4">
          <label for="">Download CV/ Biodata :</label>
          <td><a href="../cv/<?php echo $cv; ?>" download>Download</a></td>
        </div>
        <div class="form-group col-sm-4">
          <label for="">Download Aadhar Card :</label>
          <td><a href="../aadhar/<?php echo $aadhar; ?>" download>Download</a></td>
        </div>
      </div>


      <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit']; ?>">


      <div class="form-group">

        <input type="submit" class="btn btn-block btn-success" placeholder="Update" name="submit" id="submit">
      </div>



    </form>


  </div>

  <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

  <div class="table-responsive">
  </div>
</main>
</div>
</div>


<script>
  let count = <?= $referral_point ?>;

  function updateDisplay() {
    document.getElementById("counter").innerText = count;
    document.getElementById("valueInput").value = count;
  }

  function increase() {
    count += 10;
    updateDisplay();
  }

  function decrease() {
    if (count >= 10) {
      count -= 10;
      updateDisplay();
    }
  }
</script>


<script>
  document.getElementById('customer_form').addEventListener('submit', function (event) {
    const maxFileSize = 500 * 1024; // 500 KB
    const allowedImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    const allowedCVAadharTypes = ['application/pdf'];

    const profilePhotoInput = document.getElementById('img');
    const cvInput = document.getElementById('cv');
    const aadharInput = document.getElementById('aadhar');

    const profilePhoto = profilePhotoInput.files.length > 0 ? profilePhotoInput.files[0] : null;
    const cv = cvInput.files.length > 0 ? cvInput.files[0] : null;
    const aadhar = aadharInput.files.length > 0 ? aadharInput.files[0] : null;

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



<!-- Bootstrap core JavaScript
    ================================================== -->

<!-- Library commented out, check in future for debugging -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script> -->
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>


<!-- Datatables plugin -->

<!-- Bootstrap 3 -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap.js"></script> -->

<!-- Bootstrap 4 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap4.js"></script> -->


<!-- Datatables -->
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

<script>
  new DataTable('#example');
</script>

<!-- <script>
  $(document).ready(function(){
   $("#submit").click(function(){
    var email=$("#email").val();
    var username=$("#username").val();
    var password=$("#password").val();
    var first_name=$("#first_name").val();
    var last_name=$("#last_name").val();
    var admin_type=$("#admin_type").val();
    var data=$("#customer_form").serialize();

    $.ajax({
      type: "POST",
      url: "customer_add.php",
      data:data,
      success: function(data){
        // alert(data);
        $("#msg").html(data);
// no semicolon below
      }

    });
   });
  });

</script> -->


</body>

</html>


<?php
include(__DIR__ . '/connection/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {




  $maxFileSize = 500 * 1024; // 500 KB
  $allowedImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
  $allowedCVAadharTypes = ['application/pdf'];

  // Validate Profile Photo
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['img']) && $_FILES['img']['tmp_name'] !== "") {
    $file = $_FILES['img'];
    if ($file['size'] > $maxFileSize) {
      die("Error: Profile photo exceeds 500 KB.");
    }
    if (!in_array($file['type'], $allowedImageTypes)) {
      die("Error: Invalid profile photo type.");
    }

    $imgType = $file['type'];
    switch ($imgType) {
      case 'image/jpeg':
      case 'image/jpg':
        $extension = 'jpg';
        break;
      case 'image/png':
        $extension = 'png';
        break;
      default:
        die("Unsupported profile photo type.");
    }

    $imgHash = hash_file('sha256', $file['tmp_name']);
    $newimgName = 'profile_' . $imgHash . '.' . $extension;
  }

  // Validate CV
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['cv']) && $_FILES['cv']['tmp_name'] !== "") {
    $file = $_FILES['cv'];
    if ($file['size'] > $maxFileSize) {
      die("Error: CV exceeds 500 KB.");
    }
    if (!in_array($file['type'], $allowedCVAadharTypes)) {
      die("Error: Invalid CV type.");
    }

    $cvHash = hash_file('sha256', $file['tmp_name']);
    $newcvName = 'cv_' . $cvHash . '.pdf';
  }

  // Validate Aadhar Card
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['aadhar']) && $_FILES['aadhar']['tmp_name'] !== "") {
    $file = $_FILES['aadhar'];
    if ($file['size'] > $maxFileSize) {
      die("Error: Aadhar card exceeds 500 KB.");
    }
    if (!in_array($file['type'], $allowedCVAadharTypes)) {
      die("Error: Invalid Aadhar card type.");
    }

    $aadharHash = hash_file('sha256', $file['tmp_name']);
    $newaadharName = 'aadhar_' . $aadharHash . '.pdf';
  }





  $id1 = $_POST['id'];

  $first_name1 = $_POST['first_name'];
  $last_name1 = $_POST['last_name'];
  $dob1 = $_POST['dob'];
  $gender1 = $_POST['gender'];
  $country1 = $_POST['country'];
  $state1 = $_POST['state'];
  $city1 = $_POST['city'];
  $pin1 = $_POST['pin'];
  $landmark1 = $_POST['landmark'];
  $qualification1 = $_POST['qualification'];
  $board1 = $_POST['board'];
  $language1 = $_POST['language'];
  $study_field1 = $_POST['study_field'];
  $experience1 = $_POST['experience'];
  $details1 = $_POST['details'];
  $location1 = $_POST['location'];
  $job_type1 = $_POST['job_type'];
  $mobile_number1 = $_POST['mobile_number'];
  $whatsapp_number1 = $_POST['whatsapp_number'];
  $verification1 = $_POST['verification'];
  $referral_point1 = $_POST['value'];

  $result = mysqli_query($conn, "SELECT `admin_email` FROM `admin_login` WHERE `admin_type` = '0'");
  $profile = mysqli_fetch_array($result);
  $admin_email = $profile['admin_email'];

  $sql = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email` = '{$_SESSION['email']}' AND `admin_type`='0'");

  if (mysqli_num_rows($sql) > 0) {
    $query3 = mysqli_query($conn, "UPDATE `profiles` SET `first_name` = '$first_name1', `last_name` = '$last_name1', `dob` = '$dob1', `gender` = '$gender1', `country` = '$country1', `state` = '$state1', `city` = '$city1', `pin` = '$pin1', `landmark` = '$landmark1', `qualification` = '$qualification1', `board` = '$board1', `language` = '$language1', `study_field` = '$study_field1', `experience` = '$experience1', `details` = '$details1', `location` = '$location1', `preferred_job_type` = '$job_type1', `mobile_number` = '$mobile_number1', `whatsapp_number` = '$whatsapp_number1', `verification` = '$verification1', `referral_point` = '$referral_point1' WHERE `id` = '$id1'");

    if (isset($imgHash) && $imgHash != "") {
      $query5 = mysqli_query($conn, "UPDATE `profiles` SET `img` = '$newimgName' WHERE `id` = '$id1'");
      $imgMoved1 = move_uploaded_file($_FILES["img"]["tmp_name"], '../profile_img/' . $newimgName);
    }
    if (isset($cvHash) && $cvHash != "") {
      $query6 = mysqli_query($conn, "UPDATE `profiles` SET `cv` = '$newcvName' WHERE `id` = '$id1'");
      $cvMoved1 = move_uploaded_file($_FILES["cv"]["tmp_name"], '../cv/' . $newcvName);
    }
    if (isset($aadharHash) && $aadharHash != "") {
      $query7 = mysqli_query($conn, "UPDATE `profiles` SET `aadhar` = '$newaadharName' WHERE `id` = '$id1'");
      $aadharMoved1 = move_uploaded_file($_FILES["aadhar"]["tmp_name"], '../aadhar/' . $newaadharName);
    }
  }

  $sql1 = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email` = '{$_SESSION['email']}' AND `admin_type`='1'");

  if (mysqli_num_rows($sql1) > 0) {
    $result1 = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_email` = '$user_email'");
    $profile1 = mysqli_fetch_array($result1);
    $user_email1 = $profile1['admin_email'];
    $user_type1 = $profile1['admin_type'];

    if ($user_email1 != $_SESSION['email'] && $user_type1 == '1') {
      echo "<script>alert('Warning: You do not have permission to update another admin profile')</script>";
    } elseif ($user_email1 != $_SESSION['email'] && $user_type1 == '0') {
      echo "<script>alert('Warning: You do not have permission to update the superadmin profile')</script>";
    } else {
      $query4 = mysqli_query($conn, "UPDATE `profiles` SET `first_name` = '$first_name1', `last_name` = '$last_name1', `dob` = '$dob1', `gender` = '$gender1', `country` = '$country1', `state` = '$state1', `city` = '$city1', `pin` = '$pin1', `landmark` = '$landmark1', `qualification` = '$qualification1', `board` = '$board1', `language` = '$language1', `study_field` = '$study_field1', `experience` = '$experience1', `details` = '$details1', `location` = '$location1', `preferred_job_type` = '$job_type1', `mobile_number` = '$mobile_number1', `whatsapp_number` = '$whatsapp_number1', `verification` = '$verification1', `referral_point` = '$referral_point1' WHERE `id` = '$id1' AND `user_email` <> '$admin_email'");

      if (isset($imgHash) && $imgHash != "") {
        $query8 = mysqli_query($conn, "UPDATE `profiles` SET `img` = '$newimgName' WHERE `id` = '$id1' AND `user_email` <> '$admin_email'");
        $imgMoved2 = move_uploaded_file($_FILES["img"]["tmp_name"], '../profile_img/' . $newimgName);
      }
      if (isset($cvHash) && $cvHash != "") {
        $query9 = mysqli_query($conn, "UPDATE `profiles` SET `cv` = '$newcvName' WHERE `id` = '$id1' AND `user_email` <> '$admin_email'");
        $cvMoved2 = move_uploaded_file($_FILES["cv"]["tmp_name"], '../cv/' . $newcvName);
      }
      if (isset($aadharHash) && $aadharHash != "") {
        $query10 = mysqli_query($conn, "UPDATE `profiles` SET `aadhar` = '$newaadharName' WHERE `id` = '$id1' AND `user_email` <> '$admin_email'");
        $aadharMoved2 = move_uploaded_file($_FILES["aadhar"]["tmp_name"], '../aadhar/' . $newaadharName);
      }
    }
  }

  if ((isset($query3) && $query3) || (isset($query4) && $query4)) {
    echo "<script>alert('Record has been updated successfully!!!')</script>";
  } else {
    echo "<script>alert('Record has not been updated, please try again')</script>";
  }

  if ((((isset($query5) && $query5) || (isset($query6) && $query6) || (isset($query7) && $query7)) && ($imgMoved1 || $cvMoved1 || $aadharMoved1)) || (((isset($query8) && $query8) || (isset($query9) && $query9) || (isset($query10) && $query10)) && ($imgMoved2 || $cvMoved2 || $aadharMoved2))) {
    echo "<script>alert('Files have been updated successfully!!!')</script>";
  } else {
    echo "<script>alert('Files have not been updated')</script>";
  }

}
?>