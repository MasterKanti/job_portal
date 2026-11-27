<?php
include(__DIR__ . '/connection/db.php');
include(__DIR__ . '/include/headercustomer.php');
include(__DIR__ . '/include/sidebar.php');
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="apply_jobs.php">Job Applications</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">All Job Applications</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <!-- <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button> -->
      </div>
      <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle"> -->
      <!-- <a class="btn btn-primary" href="add_create_job.php">Apply Jobs</a> -->
    </div>
  </div>



  <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th>#SL</th>
        <th>Job ID</th>
        <th>Job Title</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>PIN Code</th>
        <th>Qualification</th>
        <th>Field of Study</th>
        <th>Experience</th>
        <th>Details</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      include(__DIR__ . '/connection/db.php');

      $a = 1;
      $sql = "SELECT * FROM `job_apply` LEFT JOIN `all_jobs` ON `job_apply`.`id_job`=`all_jobs`.`job_id` WHERE `job_customer_email`='{$_SESSION['email']}'";
      $query = mysqli_query($conn, $sql);
      // $sql = "SELECT * FROM `job_apply` LEFT JOIN `all_jobs` ON `job_apply`.`id_job`=`all_jobs`.`job_id` LEFT JOIN `job_seeker` ON `job_seeker`.`email`=`all_jobs`.`customer_email` WHERE `customer_email`='{$_SESSION['email']}'";
// $query = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($query)) {
        ?>

        <tr>
          <td><?php echo $a; ?></td>
          <td><?php echo $row['job_id']; ?></td>
          <td><?php echo $row['job_title']; ?></td>
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['dob']; ?></td>
          <td><?php echo $row['gender']; ?></td>
          <td><?php echo $row['country']; ?></td>
          <td><?php echo $row['state']; ?></td>
          <td><?php echo $row['city']; ?></td>
          <td><?php echo $row['pin']; ?></td>
          <td><?php echo $row['qualification']; ?></td>
          <td><?php echo $row['study_field']; ?></td>
          <td><?php echo $row['experience']; ?></td>
          <td><?php echo $row['details']; ?></td>

          <!-- <td><a href="http://localhost/job_portal/files/ -->
          <?php
          // echo $row['file'];
          ?>
          <!-- ">Download File</a></td> -->

          <td>
            <div class="row">
              <div class="btn-group">
                <a href="view_applied_jobs.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><span
                    class="glyphicon glyphicon-eye-open"></span></a>
              </div>
            </div>
          </td>
        </tr>
        <?php
        $a++;
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>#SL</th>
        <th>Job ID</th>
        <th>Job Title</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>PIN Code</th>
        <th>Qualification</th>
        <th>Field of Study</th>
        <th>Experience</th>
        <th>Details</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>

  <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

  <div class="table-responsive">
  </div>
</main>
</div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
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


</body>

</html>