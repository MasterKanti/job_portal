<?php
if (isset($_POST['download_csv'])) {
  include(__DIR__ . '/connection/db.php');

  // Optional: clear any accidental whitespace or output buffer
  if (ob_get_level()) {
    ob_end_clean();
  }

  // Fetch all jobs
  $result = mysqli_query($conn, "SELECT * FROM `profiles`");

  if (!$result) {
    die('Database error: ' . mysqli_error($conn));
  }

  // Collect all rows
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  // Start outputting CSV
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment;filename="profiles.csv"');

  $output = fopen('php://output', 'w');

  if (!empty($rows)) {
    // Write column headers
    fputcsv($output, array_keys($rows[0]));

    // Write each row
    foreach ($rows as $row) {
      fputcsv($output, $row);
    }
  }

  fclose($output);
  exit;
}
?>


<?php
include(__DIR__ . '/include/header.php');
include(__DIR__ . '/include/sidebar.php');
?>



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="profiles.php">Customer Profiles</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">Customer Profiles</h1>


    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <!-- <button class="btn btn-sm btn-outline-secondary">Share</button>
        <button class="btn btn-sm btn-outline-secondary">Export</button> -->
      </div>
      <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <a class="btn btn-primary" href="add_profile.php">Add Profile</a> -->
      <form method="post" action="">
        <button type="submit" class="btn btn-primary" name="download_csv">Download CSV</button>
      </form>
    </div>
  </div>



  <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th>#SL</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>PIN Code</th>
        <th>Nearest Landmark</th>
        <th>Qualification</th>
        <th>10th Standard Board</th>
        <th>Preferred Language</th>
        <th>Field of Study</th>
        <th>Experience</th>
        <th>Details</th>
        <th>Preferred Service Location</th>
        <th>Preferred Job Type</th>
        <th>Mobile Number</th>
        <th>WhatsApp Number</th>
        <th>Terms & Conditions</th>
        <th>Profile Verification</th>
        <th>User Email</th>
        <th>Referral Code</th>
        <th>Referral Point</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      include(__DIR__ . '/connection/db.php');
      $query = mysqli_query($conn, "SELECT * FROM `profiles`");
      while ($row = mysqli_fetch_array($query)) {
        ?>

        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['dob']; ?></td>
          <td><?php echo $row['gender']; ?></td>
          <td><?php echo $row['country']; ?></td>
          <td><?php echo $row['state']; ?></td>
          <td><?php echo $row['city']; ?></td>
          <td><?php echo $row['pin']; ?></td>
          <td><?php echo $row['landmark']; ?></td>
          <td><?php echo $row['qualification']; ?></td>
          <td><?php echo $row['board']; ?></td>
          <td><?php echo $row['language']; ?></td>
          <td><?php echo $row['study_field']; ?></td>
          <td><?php echo $row['experience']; ?></td>
          <td><?php echo $row['details']; ?></td>
          <td><?php echo $row['location']; ?></td>
          <td><?php echo $row['preferred_job_type']; ?></td>
          <td><?php echo $row['mobile_number']; ?></td>
          <td><?php echo $row['whatsapp_number']; ?></td>
          <td><?php echo $row['terms']; ?></td>
          <td><?php echo $row['verification']; ?></td>
          <td><?php echo $row['user_email']; ?></td>
          <td><?php echo $row['referral_code']; ?></td>
          <td><?php echo $row['referral_point']; ?></td>
          <td>
            <div class="row">
              <div class="btn-group">

                <a href="profile_edit.php?edit=<?php echo $row['id']; ?>" class="btn btn-success"><span
                    class="glyphicon glyphicon-pencil"></span></a>
                <a href="profile_delete.php?del=<?php echo $row['id']; ?>" class="btn btn-danger"
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
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>PIN Code</th>
        <th>Nearest Landmark</th>
        <th>Qualification</th>
        <th>10th Standard Board</th>
        <th>Preferred Language</th>
        <th>Field of Study</th>
        <th>Experience</th>
        <th>Details</th>
        <th>Preferred Service Location</th>
        <th>Preferred Job Type</th>
        <th>Mobile Number</th>
        <th>WhatsApp Number</th>
        <th>Terms & Conditions</th>
        <th>Profile Verification</th>
        <th>User Email</th>
        <th>Referral Code</th>
        <th>Referral Point</th>
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
    var result = confirm("Are you sure you want to delete this profile?");
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