<?php
include(__DIR__ . '/connection/db.php');
include(__DIR__ . '/include/header.php');
include(__DIR__ . '/include/sidebar.php');

$id = $_GET['edit'];
$query = mysqli_query($conn, "SELECT * FROM `company` WHERE company_id = '$id'");
while ($row = mysqli_fetch_array($query)) {
  $company = $row['company'];
  $industry = $row['company_industry'];
  $description = $row['company_des'];
  $country = $row['company_country'];
  $state = $row['company_state'];
  $city = $row['company_city'];
  $pin = $row['company_pin'];
  $name = $row['company_admin'];
  $designation = $row['company_designation'];
  $number = $row['company_number'];

  $proof = $row['company_proof'];

  $email = $row['company_email'];

}
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="create_company.php">Organisation</a></li>
      <li class="breadcrumb-item"><a href="company_edit.php?edit=<?php echo $id; ?>">Update Organisation</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">Update Organisation</h1>


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
        <label for="Organisation name">Enter Organisation Name</label>
        <input type="text" name="company" id="company" value="<?php if (!empty($company))
          echo $company; ?>"
          class="form-control" placeholder="Enter Organisation Name" required>
      </div>

      <div class="form-group">
        <label for="Industry type">Industry Type</label>
        <input type="text" name="industry" id="industry" value="<?php if (!empty($industry))
          echo $industry; ?>"
          class="form-control" placeholder="Enter Industry Type" required>
      </div>

      <div class="form-group">
        <label for="Customer Username">Enter Description</label>
        <textarea placeholder="Max. 100 words" name="des" id="des" class="form-control" cols="30" rows="10"
          required><?php if (!empty($description))
            echo $description; ?></textarea>
      </div>

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
        <label for="PIN code">PIN Code</label>
        <input type="number" name="pin" id="pin" value="<?php if (!empty($pin))
          echo $pin; ?>" class="form-control"
          placeholder="Enter PIN Code" required>
      </div>

      <div class="form-group">
        <label for="Admin Name">Enter Admin Name</label>
        <input type="text" name="name" id="name" value="<?php if (!empty($name))
          echo $name; ?>" class="form-control"
          placeholder="Enter Contact Person's Name" required>
      </div>

      <div class="form-group">
        <label for="Admin Designation">Enter Admin Designation</label>
        <input type="text" name="designation" id="designation"
          value="<?php if (!empty($designation))
            echo $designation; ?>" class="form-control"
          placeholder="Enter Contact Person's Designation" required>
      </div>

      <div class="form-group">
        <label for="Mobile Number">Enter Admin Mobile Number</label>
        <input type="number" name="number" id="number" value="<?php if (!empty($number))
          echo $number; ?>"
          class="form-control" placeholder="Enter Contact Person's Mobile Number" required>
      </div>

      <div class="form-group">
        <label for="Designation Proof">Update Designation Proof</label>
        <input type="file" class="form-control" name="proof" id="proof" accept=".pdf" required>
      </div>

      <div class="form-group">
        <label for="Admin Email">Select Admin Email</label>
        <select name="admin" id="admin" class="form-control" required readonly>
          <option value="<?php if (!empty($email))
            echo $email; ?>">
            <?php if (!empty($email))
              echo $email;
            else
              echo "Select Contact Person's Email"; ?></option>
          <?php
          include(__DIR__ . '/connection/db.php');

          $sql = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_type`='2'");
          while ($row = mysqli_fetch_array($sql)) {
            ?>
            <option value="<?php echo $row['admin_email']; ?>"><?php echo $row['admin_email']; ?></option>
            <?php
          }
          ?>
        </select>
      </div>

      <div class="row">
        <div class="form-group col-sm-12">
          <label for="">Download Designation Proof :</label>
          <td><a href="../designation/<?php echo $proof; ?>" download>Download</a></td>
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
  document.getElementById('customer_form').addEventListener('submit', function (event) {
    const maxFileSize = 500 * 1024; // 500 KB
    const allowedProofTypes = ['application/pdf'];

    const proof = document.getElementById('proof').files[0];

    // Validate Designation Proof
    if (proof) {
      if (proof.size > maxFileSize) {
        alert('Designation proof must be less than 500 KB');
        event.preventDefault();
        return;
      }
      if (!allowedProofTypes.includes(proof.type)) {
        alert('Designation proof must be a PDF file');
        event.preventDefault();
        return;
      }
    }
  });
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
  $allowedProofTypes = ['application/pdf'];

  // Validate Designation Proof
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['proof'])) {
    $file = $_FILES['proof'];
    if ($file['size'] > $maxFileSize) {
      die("Error: Designation proof exceeds 500 KB.");
    }
    if (!in_array($file['type'], $allowedProofTypes)) {
      die("Error: Invalid Designation proof type.");
    }

    $proofHash = hash_file('sha256', $_FILES['proof']['tmp_name']);
    $newproofName = 'designation_' . $proofHash . '.pdf';
  }

  $id1 = $_POST['id'];
  $company1 = $_POST['company'];
  $industry1 = $_POST['industry'];
  $des1 = $_POST['des'];
  $country1 = $_POST['country'];
  $state1 = $_POST['state'];
  $city1 = $_POST['city'];
  $pin1 = $_POST['pin'];
  $name1 = $_POST['name'];
  $designation1 = $_POST['designation'];
  $number1 = $_POST['number'];
  $admin1 = $_POST['admin'];

  $query1 = mysqli_query($conn, "UPDATE `company` SET `company` = '$company1', `company_industry` = '$industry1', `company_des` = '$des1', `company_country` = '$country1', `company_state` = '$state1', `company_city` = '$city1', `company_pin` = '$pin1', `company_admin` = '$name1', `company_designation` = '$designation1', `company_number` = '$number1', `company_proof` = '$newproofName', `company_email` = '$admin1' WHERE `company_id` = '$id1'");

  move_uploaded_file($_FILES["proof"]["tmp_name"], '../designation/' . $newproofName);

  if ($query1) {
    echo "<script>alert('Record has been updated successfully!!!')</script>";
  } else {
    echo "<script>alert('Record has not been updated, please try again')</script>";
  }


}


?>