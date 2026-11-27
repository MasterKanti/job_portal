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
while ($row = mysqli_fetch_array($query)) {
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <!-- Use of Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="apply_jobs.php">Job Applications</a></li>
                <li class="breadcrumb-item"><a href="view_applied_jobs.php?id=<?php echo $_GET['id']; ?>">View Job
                        Application</a></li>
                <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
            </ol>
        </nav>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

            <h1 class="h2">View Job Application</h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <!-- <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button> -->
                </div>
                <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle"> -->
                <!-- <a class="btn btn-primary" href="add_create_job.php">Apply Jobs</a> -->
            </div>
        </div>


        <form action="" style="border: 1px solid gray; width: 60%; margin-left: 10%; padding: 10px;">

            <h1>Job Seeker: <?php echo strtoupper($row['first_name']); ?>     <?php echo strtoupper($row['last_name']); ?></h1>
            <hr>

            <style>
                .profile-image-style {
                    width: 90px;
                    height: 120px;
                    object-fit: contain;
                    /* border-radius: 50%; */
                    margin: auto;
                }
            </style>
            <div class="row">
                <div class="form-group col-sm-12">
                    <!-- <img src="../profile_img/logo.png" class="profile-image profile-image-style img-thumbnail" alt="Profile Image"> -->

                    <img src="../profile_img/<?php if (!empty($row['file'])) {
                        echo $row['file'];
                    } else {
                        echo 'profile.png';
                    } ?>"
                        class="profile-image profile-image-style img-thumbnail" alt="Profile Image">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Job ID :</label>
                    <td><?php echo $row['job_id']; ?></td>
                </div>
                <div class="form-group col-sm-8">
                    <label for="">Job Title :</label>
                    <td><?php echo $row['job_title']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Job Country :</label>
                    <td><?php echo $row['job_country']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Job State :</label>
                    <td><?php echo $row['job_state']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Job City :</label>
                    <td><?php echo $row['job_city']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Job Salary :</label>
                    <td><?php echo $row['job_salary']; ?></td>
                </div>
                <div class="form-group col-sm-8">
                    <label for="">Job Type :</label>
                    <td><?php echo $row['job_type']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Job Category :</label>
                    <td><?php echo $row['job_category']; ?></td>
                </div>
                <div class="form-group col-sm-8">
                    <label for="">Job Sub-Category :</label>
                    <td><?php echo $row['job_sub_category']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="">Job Description :</label>
                    <td><?php echo $row['job_des']; ?></td>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="">Name :</label>
                    <td><?php echo $row['first_name']; ?>     <?php echo $row['last_name']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Date of Birth :</label>
                    <td><?php echo $row['dob']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Gender :</label>
                    <td><?php echo $row['gender']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Country :</label>
                    <td><?php echo $row['country']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">State :</label>
                    <td><?php echo $row['state']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">City :</label>
                    <td><?php echo $row['city']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">PIN Code :</label>
                    <td><?php echo $row['pin']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Highest Qualification :</label>
                    <td><?php echo $row['qualification']; ?></td>
                </div>
                <div class="form-group col-sm-8">
                    <label for="">10th Standard Board :</label>
                    <td><?php echo $row['board']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Most Preferred Language :</label>
                    <td><?php echo $row['language']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Field of Study :</label>
                    <td><?php echo $row['study_field']; ?></td>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Experience :</label>
                    <td><?php echo $row['experience']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="">Details :</label>
                    <td><?php echo $row['details']; ?></td>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="">Job Seeker Profile Image :</label>
                    <td><a href="../profile_img/<?php echo $row['file']; ?>" download>Download Profile Image</a></td>
                </div>
            </div>



            <a href="send_mail.php?id=<?php echo $id; ?>" class="btn btn-success">Accept</a>
            <a href="reject_job.php?id=<?php echo $id; ?>" class="btn btn-danger"
                onclick="return confirmDeletion(event, this);">Reject</a>

        </form>

        <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

        <div class="table-responsive">
        </div>
    </main>
    </div>
    </div>

    <script>
        function confirmDeletion(event, link) {
            event.preventDefault();
            var result = confirm("Are you sure you want to reject this application?");
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
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
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