<?php
session_start();
if (isset($_SESSION['email'])) {
  include(__DIR__ . '/connection/db.php');
  $query2 = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
  if (mysqli_num_rows($query2) > 0) {
    $profile = mysqli_fetch_array($query2);
    if (empty($profile['img']) || empty($profile['first_name']) || empty($profile['last_name']) || empty($profile['dob']) || empty($profile['gender']) || empty($profile['country']) || empty($profile['state']) || empty($profile['city']) || empty($profile['pin']) || empty($profile['landmark']) || empty($profile['qualification']) || empty($profile['board']) || empty($profile['language']) || empty($profile['study_field']) || empty($profile['experience']) || empty($profile['details']) || empty($profile['location']) || empty($profile['preferred_job_type']) || empty($profile['mobile_number']) || empty($profile['whatsapp_number']) || empty($profile['cv']) || empty($profile['aadhar'])) {
      header("location:../my_profile.php");
      exit();
    }
  }
  ?>


<?php
include(__DIR__ . '/include/headercustomer.php');
include(__DIR__ . '/include/sidebar.php');
?>


<?php
include(__DIR__ . '/connection/db.php');
$edit = $_GET['edit'];
$query = mysqli_query($conn, "SELECT * FROM `all_jobs` WHERE `job_id`='$edit' AND `job_customer_email` = '{$_SESSION['email']}'");

while ($row = mysqli_fetch_array($query)) {
  $job_title = $row['job_title'];
  $job_salary = $row['job_salary'];
  $des = $row['job_des'];
  $job_type = $row['job_type'];
  $country = $row['job_country'];
  $state = $row['job_state'];
  $city = $row['job_city'];
  $category = $row['job_category'];
  $sub_category = $row['job_sub_category'];

  ?>

  <?php
  $query2 = mysqli_query($conn, "SELECT * FROM `job_category`");
  ?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <!-- Use of Breadcrumbs -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="job_create.php">All Jobs List</a></li>
        <li class="breadcrumb-item"><a href="job_edit.php?edit=<?php echo $edit; ?>">Edit Job</a></li>
        <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
      </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

      <h1 class="h2">Edit Job</h1>


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
      <form action="" method="POST" style="margin: 3%; padding: 3%;" name="job_form" id="job_form">


        <div class="form-group">
          <label for="Customer Email">Job Title</label>
          <input type="text" value="<?php if (!empty($job_title))
            echo $job_title; ?>" name="job_title" id="job_title"
            class="form-control" placeholder="Job Title..." required>
        </div>

        <div class="form-group">
          <label for="">Job Salary</label>
          <select name="job_salary" class="form-control" id="job_salary" required>
            <option value="<?php if (!empty($job_salary))
              echo $job_salary; ?>">
              <?php if (!empty($job_salary))
                echo $job_salary;
              else
                echo "Select Job Salary"; ?></option>
            <option value="Rs. 1000 or less">Rs. 1000 or less</option>
            <option value="Rs. 1001 to Rs. 2000">Rs. 1001 to Rs. 2000</option>
            <option value="Rs. 2001 to Rs. 5000">Rs. 2001 to Rs. 5000</option>
            <option value="Rs. 5001 to Rs. 10000">Rs. 5001 to Rs. 10000</option>
            <option value="Rs. 10001 to Rs. 15000">Rs. 10001 to Rs. 15000</option>
            <option value="Rs. 15001 or above">Rs. 15001 or above</option>
          </select>
        </div>

        <div class="form-group">
          <label for="Customer Username">Description</label>
          <textarea placeholder="Max. 100 words" name="description" id="description" class="form-control" cols="30"
            rows="10" required><?php if (!empty($des))
              echo $des; ?></textarea>
        </div>

        <div class="form-group">
          <label for="">Job Type</label>
          <select name="job_type" class="form-control" id="job_type" required>
            <option value="<?php if (!empty($job_type))
              echo $job_type; ?>">
              <?php if (!empty($job_type))
                echo $job_type;
              else
                echo "Select Job Type"; ?></option>
            <option value="Tutor">Tutor</option>
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
            <option value="Freelance">Freelance</option>
            <option value="Internship">Internship</option>
            <option value="Volunteer">Volunteer</option>
            <option value="Contract">Contract</option>
          </select>
        </div>

        <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit']; ?>">

        <div class="form-group">
          <label for="">Country</label>
          <select name="country" class="countries form-control" id="countryDropdown" required>
            <option value="<?php if (!empty($country))
              echo $country; ?>">
              <?php if (!empty($country))
                echo $country;
              else
                echo "Select Country"; ?></option>
          </select>
        </div>

        <div class="form-group">
          <label for="">State</label>
          <select name="state" class="states form-control" id="stateDropdown" required>
            <option value="<?php if (!empty($state))
              echo $state; ?>">
              <?php if (!empty($state))
                echo $state;
              else
                echo "Select State"; ?></option>
          </select>
        </div>

        <div class="form-group">
          <label for="">City</label>
          <select name="city" class="cities form-control" id="cityDropdown" required>
            <option value="<?php if (!empty($city))
              echo $city; ?>">
              <?php if (!empty($city))
                echo $city;
              else
                echo "Select City"; ?></option>
          </select>
        </div>


        <div class="form-group">
          <label for="">Select Category</label>
          <select name="category" id="category" class="form-control" required>
            <option value="<?php if (!empty($category))
              echo $category; ?>">
              <?php if (!empty($category))
                echo $category;
              else
                echo "Select Category"; ?></option>
            <?php
            while ($row = mysqli_fetch_array($query2)) {
              ?>
              <option value="<?php echo $row['category_id']; ?>" <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category']) && $_POST['category'] == $row['category_id'])
                   echo 'selected'; ?>>
                <?php echo $row['category']; ?></option>
            <?php
            }
            ?>
          </select>
        </div>


        <div class="form-group">
          <label for="">Select Sub-Category</label>
          <select name="sub_category" id="sub_category" class="form-control">
            <option value="<?php if (!empty($sub_category))
              echo $sub_category; ?>">
              <?php if (!empty($sub_category))
                echo $sub_category;
              else
                echo "Select Sub-Category"; ?></option>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category']) && !empty($_POST['category'])) {
              $category_id = $_POST['category'];
              // Adjust the query to match category_id with the correct column name in the subcategory table
              $sub_query = mysqli_query($conn, "SELECT * FROM `sub_category` WHERE `sub_category_id`='$category_id'");
              while ($sub_row = mysqli_fetch_array($sub_query)) {
                ?>
                <option value="<?php echo $sub_row['sub_category']; ?>">
                  <?php echo $sub_row['sub_category']; ?>
                </option>
                <?php
              }
            }
            ?>
          </select>
        </div>




        <div class="form-group">
          <label for="">Important:</label>
          If you want to fetch the corresponding subcategory, please select the category and click on <label
            for="">Submit</label> first
        </div>







        <!-- <div class="form-group">
<label for="Admin Type">Admin Type</label>

<select class="form-control" name="admin_type" id="admin_type">
<option value="1">Super Admin</option>
<option value="2">Customer Admin</option>
</select>

</div> -->



        <div class="form-group">

          <input type="submit" class="btn btn-block btn-success" placeholder="Save" name="submit" id="submit">
        </div>

      </form>


    </div>

    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

    <div class="table-responsive">
    </div>
  </main>
  </div>
  </div>

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

  <script>
    $(document).ready(function () {
      $("#submit").click(function () {
        var job_title = $("#job_title").val();
        var job_salary = $("#job_salary").val();
        var description = $("#description").val();
        var job_type = $("#job_type").val();
        var countryDropdown = $("#countryDropdown").val();
        var stateDropdown = $("#stateDropdown").val();
        var cityDropdown = $("#cityDropdown").val();
        var category = $("#category").val();


        if (job_title == "") {
          alert("Please Enter Job Title!!");
          return false;
        }

        if (job_salary == "") {
          alert("Please Enter Job Salary!!");
          return false;
        }

        if (description == "") {
          alert("Please Enter Description!!");
          return false;
        }

        if (job_type == "") {
          alert("Please Enter Job Type!!");
          return false;
        }

        if (countryDropdown == "") {
          alert("Please Select Country!!");
          return false;
        }

        if (stateDropdown == "") {
          alert("Please Select State!!");
          return false;
        }

        if (cityDropdown == "") {
          alert("Please Select City!!");
          return false;
        }

        if (category == "") {
          alert("Please Select Category!!");
          return false;
        }

        var data = $("#job_form").serialize();

        //     $.ajax({
        //       type: "POST",
        //       url: "add_new_job.php",
        //       data:data,
        //       success: function(data){
        //         alert(data);
        //         // $("#msg").html(data);
        // // no semicolon below
        //       }
        //     });

      });
    });



  </script>


  </body>

  </html>

  <?php
  include(__DIR__ . '/connection/db.php');
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $id1 = $_POST['id'];

    $job_title1 = $_POST['job_title'];
    $job_salary1 = $_POST['job_salary'];
    $description1 = $_POST['description'];
    $job_type1 = $_POST['job_type'];
    $country1 = $_POST['country'];
    $state1 = $_POST['state'];
    $city1 = $_POST['city'];
    $category1 = $_POST['category'];
    $sub_category1 = $_POST['sub_category'];


    $query1 = mysqli_query($conn, "UPDATE `all_jobs` SET `job_title` = '$job_title1', `job_salary` = '$job_salary1', `job_des` = '$description1', `job_type` = '$job_type1', `job_country` = '$country1', `job_state` = '$state1', `job_city` = '$city1', `job_category` = '$category1', `job_sub_category` = '$sub_category1' WHERE `job_id` = '$id1'");

    if ($query1) {
      echo "<script>alert('Record has been updated successfully!!!')</script>";
    } else {
      echo "<script>alert('Record has not been updated, please try again')</script>";
    }

  }

?>
<?php
}
?>

<?php
} else {
  header('location:../job-post.php');
  exit();
}
?>