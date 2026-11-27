<?php
include(__DIR__ . '/connection/db.php');
include(__DIR__ . '/include/headercustomer.php');
include(__DIR__ . '/include/sidebar.php');
?>

<?php
include(__DIR__ . '/connection/db.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `job_apply` LEFT JOIN `all_jobs` ON `job_apply`.`id_job`=`all_jobs`.`job_id` WHERE `id`='$id' AND `job_customer_email` = '{$_SESSION['email']}'";
$query = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'";
$query1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($query1)) {
  $employer_id = $row1["id"];
}


while ($row = mysqli_fetch_array($query)) {
  ?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <!-- Use of Breadcrumbs -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="apply_jobs.php">Job Applications</a></li>
        <li class="breadcrumb-item"><a href="view_applied_jobs.php?id=<?php echo $_GET['id']; ?>">View Job Application</a>
        </li>
        <li class="breadcrumb-item"><a href="send_mail.php?id=<?php echo $_GET['id']; ?>">Send Email</a></li>
        <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
      </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

      <h1 class="h2">Send Email</h1>


      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <!-- <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button> -->
        </div>
        <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle"> -->
        <!-- <a class="btn btn-primary" href="add_create_job.php">Apply Jobs</a> -->
      </div>
    </div>


    <form action="phpmailer.php" method="POST"
      style="border: 1px solid gray; width: 60%; margin-left: 10%; padding: 10px;">

      <h1>Job Seeker: <?php echo strtoupper($row['first_name']); ?>   <?php echo strtoupper($row['last_name']); ?></h1>
      <hr>

      <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
      <input type="hidden" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>">

      <div class="form-group">
        <label for="">To :</label>
        <td><input type="text" name="to1" id="to1" class="form-control" placeholder="To..."
            value="<?php echo strtoupper($row['first_name']); ?> <?php echo strtoupper($row['last_name']); ?>" readonly>
        </td>
        <input type="hidden" name="to" id="to" value="<?php echo $row['job_seeker']; ?>">
      </div>

      <input type="hidden" name="from" id="from" value="joblyfeforyou@gmail.com">

      <div class="form-group">
        <label for="">Subject :</label>
        <td><input type="text" name="subject" id="subject" class="form-control" placeholder="Subject..."
            value="Congratulations! Your Job Application At JobLyfe [JOB ID: <?php echo $row['id_job']; ?>] Is Currently Under Review"
            readonly></td>
      </div>
      <div class="form-group">
        <label for="">Body :</label>
        <?php
        $message = "Dear " . strtoupper($row['first_name']) . " " . strtoupper($row['last_name']) . ",\n\n";
        $message .= "I hope this message finds you well. We would like to inform you that your application for the job of *" . $row['job_title'] . "* at *" . $row['job_city'] . "* is currently under review. While the job has not yet been officially approved yet, it has been taken into serious consideration, and there is a strong possibility it will move forward. We are excited about the potential of having you join us in the near future. [EMPLOYER ID: $employer_id]";
        ?>
        <textarea name="body" id="body" class="form-control" cols="30" rows="10">
    <?php echo $message; ?>
    </textarea>
      </div>


      <input type="submit" class="btn btn-success btn-block" name="submit" id="submit" value="Send">

    </form>

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
  <!-- \/ problem below -->
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

  <?php
}
?>