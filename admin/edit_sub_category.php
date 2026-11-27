<?php
include(__DIR__ . '/connection/db.php');
include(__DIR__ . '/include/header.php');
include(__DIR__ . '/include/sidebar.php');

$id = $_GET['edit'];
$query = mysqli_query($conn, "SELECT * FROM `sub_category` WHERE `id` = '$id'");
while ($row = mysqli_fetch_array($query)) {
  $sub_category_id = $row['sub_category_id'];
  $sub_category = $row['sub_category'];

}
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="sub_category.php">Sub-Category</a></li>
      <li class="breadcrumb-item"><a href="edit_sub_category.php?edit=<?php echo $id; ?>">Update Sub-Category</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">Update Sub-Category</h1>


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
        <label for="Sub-Category ID">Select Sub-Category ID</label>
        <select name="sub_category_id" class="form-control" id="sub_category_id" required readonly>
          <option value="<?php if (!empty($sub_category_id))
            echo $sub_category_id; ?>">
            <?php if (!empty($sub_category_id))
              echo $sub_category_id;
            else
              echo "Select Sub-Category"; ?></option>

          <?php
          $query2 = mysqli_query($conn, "SELECT * FROM `job_category`");
          while ($row = mysqli_fetch_array($query2)) {
            ?>
            <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>



      <div class="form-group">
        <label for="Sub Category">Enter Sub-Category Name</label>
        <input type="text" name="sub_category" id="sub_category"
          value="<?php if (!empty($sub_category))
            echo $sub_category; ?>" class="form-control"
          placeholder="Enter Sub Category Name" required>
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
  $sub_category_id1 = $_POST['sub_category_id'];
  $sub_category1 = $_POST['sub_category'];

  $query1 = mysqli_query($conn, "UPDATE `sub_category` SET `sub_category_id` = '$sub_category_id1', `sub_category` = '$sub_category1' WHERE `id` = '$id1'");

  if ($query1) {
    echo "<script>alert('Record has been updated successfully!!!')</script>";
  } else {
    echo "<script>alert('Record has not been updated, please try again')</script>";
  }


}


?>