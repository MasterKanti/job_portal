<?php
include(__DIR__ . '/connection/db.php');
include(__DIR__ . '/include/headersuper.php');
include(__DIR__ . '/include/sidebar.php');

$id = $_GET['edit'];
$query = mysqli_query($conn, "SELECT * FROM `admin_login` WHERE id = '$id'");
while ($row = mysqli_fetch_array($query)) {
  $admin_email = $row['admin_email'];
  $admin_pass = $row['admin_pass'];
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $admin_number = $row['admin_number'];
  $admin_type = $row['admin_type'];

}
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="customers.php">Customers</a></li>
      <li class="breadcrumb-item"><a href="customer_edit.php?edit=<?php echo $id; ?>">Update Customer</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">Update Customer</h1>


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
    <form action="" method="POST" style="margin: 3%; padding: 3%;" name="customer_form" id="customer_form">

      <div class="form-group">
        <label for="Customer Email">Enter Email</label>
        <input type="email" name="email" id="email" value="<?php echo $admin_email; ?>" class="form-control"
          placeholder="Enter Customer Email" required readonly>
      </div>

      <div class="form-group">
        <label for="Password">Enter Password</label>
        <input type="pass" name="password" id="password" value="<?php echo $admin_pass; ?>" class="form-control"
          placeholder="Enter Customer Password" required readonly>
      </div>

      <div class="form-group">
        <label for="First Name">Enter First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php if (!empty($first_name))
          echo $first_name; ?>"
          class="form-control" placeholder="Enter Customer First Name" required>
      </div>

      <div class="form-group">
        <label for="Last Name">Enter Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php if (!empty($last_name))
          echo $last_name; ?>"
          class="form-control" placeholder="Enter Customer Last Name" required>
      </div>

      <div class="form-group">
        <label for="Customer Mobile Number">Enter Mobile Number</label>
        <input type="number" name="number" id="number" value="<?php if (!empty($admin_number))
          echo $admin_number; ?>"
          class="form-control" placeholder="Enter Customer Mobile Number" required>
      </div>

      <div class="form-group">
        <label for="Admin Type">Admin Type</label>
        <select name="admin_type" id="admin_type" class="form-control" required>
          <option value="<?php if (!empty($admin_type))
            echo $admin_type; ?>">
            <?php if (!empty($admin_type))
              echo $admin_type;
            else
              echo "Select Admin Type"; ?></option>
          <option value="1">Admin</option>
          <option value="2">Customer Admin</option>
        </select>
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

  $id1 = $_POST['id'];

  $admin_email1 = $_POST['email'];
  $admin_number1 = $_POST['number'];
  $admin_pass1 = $_POST['password'];
  $first_name1 = $_POST['first_name'];
  $last_name1 = $_POST['last_name'];
  $admin_type1 = $_POST['admin_type'];


  $query1 = mysqli_query($conn, "UPDATE `admin_login` SET `admin_email` = '$admin_email1', `admin_number` = '$admin_number1', `admin_pass` = '$admin_pass1', `first_name` = '$first_name1', `last_name` = '$last_name1' WHERE `id` = '$id1'");
  $query2 = mysqli_query($conn, "UPDATE `admin_login` SET `admin_type` = '$admin_type1' WHERE `id` = '$id1' AND `admin_type` <> '0'");

  if ($query1 && $query2) {
    echo "<script>alert('Record has been updated successfully!!!')</script>";
  } else {
    echo "<script>alert('Record has not been updated, please try again')</script>";
  }

}


?>