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
        <li class="breadcrumb-item"><a href="job_create.php">All Jobs Posted</a></li>
        <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
      </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

      <h1 class="h2">All Jobs Posted</h1>


      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <!-- <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button> -->
        </div>
        <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle"> -->

        <?php
        include(__DIR__ . '/connection/db.php');

        $email = $_SESSION['email'];
        $admin_check = mysqli_query($conn, "SELECT `admin_type` FROM `admin_login` WHERE `admin_email` = '$email'");
        $admin_row = mysqli_fetch_array($admin_check);
        $admin_type = $admin_row['admin_type'];
        ?>
        <a class="btn btn-primary" href="add_create_job.php">Create Job</a>
      </div>
    </div>



    <table id="example" class="display" style="width:100%">
      <thead>
        <tr>
          <th>#SL</th>
          <th>Admin Email</th>
          <th>Job Title</th>
          <th>Job Salary</th>
          <th>Description</th>
          <th>Job Type</th>
          <th>Country</th>
          <th>State</th>
          <th>City</th>
          <th>Category</th>
          <th>Sub-Category</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php
        include(__DIR__ . '/connection/db.php');

        $email = $_SESSION['email'];
        $admin_check = mysqli_query($conn, "SELECT `admin_type` FROM `admin_login` WHERE `admin_email` = '$email'");
        $admin_row = mysqli_fetch_array($admin_check);
        $admin_type = $admin_row['admin_type'];

        // Adjust the query based on admin type
// if ($admin_type == 2) {
//     $query = mysqli_query($conn, "SELECT * FROM `all_jobs` WHERE `customer_email` = '$email'");    
// } else {
//     $query = mysqli_query($conn, "SELECT * FROM `all_jobs`");
// }
      
        $query = mysqli_query($conn, "SELECT * FROM `all_jobs` WHERE `job_customer_email` = '$email'");

        // $query = mysqli_query($conn, "SELECT * FROM `all_jobs` WHERE `customer_email`='{$_SESSION['email']}'");
        while ($row = mysqli_fetch_array($query)) {
          ?>

          <tr>
            <td><?php echo $row['job_id']; ?></td>
            <td><?php echo $row['job_customer_email']; ?></td>
            <td><?php echo $row['job_title']; ?></td>
            <td><?php echo $row['job_salary']; ?></td>
            <td><?php echo $row['job_des']; ?></td>
            <td><?php echo $row['job_type']; ?></td>
            <td><?php echo $row['job_country']; ?></td>
            <td><?php echo $row['job_state']; ?></td>
            <td><?php echo $row['job_city']; ?></td>
            <td><?php echo $row['job_category']; ?></td>
            <td><?php echo $row['job_sub_category']; ?></td>
            <td>
              <div class="row">
                <div class="btn-group">

                  <a href="job_edit.php?edit=<?php echo $row['job_id']; ?>" class="btn btn-success"><span
                      class="glyphicon glyphicon-pencil"></span></a>
                  <a href="job_delete.php?del=<?php echo $row['job_id']; ?>" class="btn btn-danger"
                    onclick="return confirmDeletion(event, this);"><span class="glyphicon glyphicon-trash"></span></a>
                </div>
              </div>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <th>#SL</th>
          <th>Admin Email</th>
          <th>Job Title</th>
          <th>Job Salary</th>
          <th>Description</th>
          <th>Job Type</th>
          <th>Country</th>
          <th>State</th>
          <th>City</th>
          <th>Category</th>
          <th>Sub-Category</th>
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

  <script>
    function confirmDeletion(event, link) {
      event.preventDefault();
      var result = confirm("Are you sure you want to delete this job?");
      if (result) {
        window.location = link.href;
      } else {
        window.location.reload();
      }
      return false;
    }
  </script>

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
