<?php
include(__DIR__ . '/include/header.php');
include(__DIR__ . '/include/sidebar.php');
?>
<?php
include(__DIR__ . '/connection/db.php');

// $query = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE `admin_type`='2'");
$sql = "SELECT * FROM `admin_login` LEFT JOIN `company` ON `admin_login`.`admin_email`=`company`.`company_email` WHERE `admin_type`='2' AND `company`.`company_email` IS NULL";
$query = mysqli_query($conn, $sql);
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="create_company.php">Organisation</a></li>
      <li class="breadcrumb-item"><a href="add_company.php">Add Organisation</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">Add Organisation</h1>


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
    <form action="" method="POST" style="margin: 3%; padding: 3%;" name="company_form" id="company_form">


      <div class="form-group">
        <label for="Organisation name">Organisation Name</label>
        <input type="text" name="company" id="company" class="form-control" placeholder="Enter Organisation Name"
          required>
      </div>

      <div class="form-group">
        <label for="Industry type">Industry Type</label>
        <input type="text" name="industry" id="industry" class="form-control" placeholder="Enter Industry Type"
          required>
      </div>

      <div class="form-group">
        <label for="Description">Enter Description</label>
        <textarea placeholder="Max. 100 words" name="description" id="description" class="form-control" cols="30"
          rows="10" required></textarea>
      </div>

      <div class="form-group">
        <label for="">Country</label>
        <select name="country" class="countries form-control" id="countryDropdown" required>
          <option value="">Select Country</option>
        </select>
      </div>

      <div class="form-group">
        <label for="">State</label>
        <select name="state" class="states form-control" id="stateDropdown" required>
          <option value="">Select State</option>
        </select>
      </div>

      <div class="form-group">
        <label for="">City</label>
        <select name="city" class="cities form-control" id="cityDropdown" required>
          <option value="">Select City</option>
        </select>
      </div>

      <div class="form-group">
        <label for="PIN code">PIN Code</label>
        <input type="number" name="pin" id="pin" class="form-control" placeholder="Enter PIN Code" required>
      </div>

      <div class="form-group">
        <label for="Admin Name">Enter Admin Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Contact Person's Name"
          required>
      </div>

      <div class="form-group">
        <label for="Admin Designation">Enter Admin Designation</label>
        <input type="text" name="designation" id="designation" class="form-control"
          placeholder="Enter Contact Person's Designation" required>
      </div>

      <div class="form-group">
        <label for="Mobile Number">Enter Admin Mobile Number</label>
        <input type="number" name="number" id="number" class="form-control"
          placeholder="Enter Contact Person's Mobile Number" required>
      </div>

      <div class="form-group">
        <label for="Admin Email">Select Admin Email</label>
        <select name="admin" id="admin" class="form-control" required>
          <option value="">Select Contact Person's Email</option>
          <?php
          while ($row = mysqli_fetch_array($query)) {
            ?>
            <option value="<?php echo $row['admin_email']; ?>"><?php echo $row['admin_email']; ?></option>
            <?php
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="">Important:</label>
        If you want to add/ update designation proof, please visit the corresponding <label for="">Update
          Organisation</label> page
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

<!-- Select2 JS Library CDNJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
  integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Initialize Select2 on your select element -->
<script>
  $(document).ready(function () {
    $('#admin').select2();
  });
</script>

<script>
  $(document).ready(function () {
    $("#submit").click(function () {
      var company = $("#company").val();
      var industry = $("#industry").val();
      var description = $("#description").val();
      var country = $("#countryDropdown").val();
      var state = $("#stateDropdown").val();
      var city = $("#cityDropdown").val();
      var pin = $("#pin").val();
      var name = $("#name").val();
      var designation = $("#designation").val();
      var number = $("#number").val();
      var admin = $("#admin").val();

      if (company == "") {
        alert("Please Enter Organisation Name!!");
        return false;
      }

      if (industry == "") {
        alert("Please Enter Industry!!");
        return false;
      }

      if (description == "") {
        alert("Please Enter Description!!");
        return false;
      }

      if (country == "") {
        alert("Please Enter Country!!");
        return false;
      }

      if (state == "") {
        alert("Please Enter State!!");
        return false;
      }

      if (city == "") {
        alert("Please Enter City!!");
        return false;
      }

      if (pin == "") {
        alert("Please Enter Pin!!");
        return false;
      }

      if (name == "") {
        alert("Please Enter Contact Person's Name!!");
        return false;
      }

      if (designation == "") {
        alert("Please Enter Contact Person's Designation!!");
        return false;
      }

      if (number == "") {
        alert("Please Enter Contact Person's Mobile Number!!");
        return false;
      }

      if (admin == "") {
        alert("Please Enter Contact Person's Email!!");
        return false;
      }

      var data = $("#company_form").serialize();

      $.ajax({
        type: "POST",
        url: "company_add.php",
        data: data,
        success: function (data) {
          alert(data);
          // $("#msg").html(data);
          // no semicolon below
        }

      });
    });
  });

</script>


</body>

</html>