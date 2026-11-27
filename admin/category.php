<?php
include(__DIR__ . '/include/header.php');
include(__DIR__ . '/include/sidebar.php');
?>



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <!-- Use of Breadcrumbs -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="category.php">Category</a></li>
      <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    </ol>
  </nav>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

    <h1 class="h2">Category</h1>


    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <!-- <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button> -->
      </div>
      <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle"> -->
      <a class="btn btn-primary" href="add_category.php">Add Category</a>
    </div>
  </div>



  <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th>#SL</th>
        <th>Category Name</th>
        <th>Category ID</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      include(__DIR__ . '/connection/db.php');

      $query = mysqli_query($conn, "SELECT * FROM `job_category`");
      while ($row = mysqli_fetch_array($query)) {
        ?>

        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['category']; ?></td>
          <td><?php echo $row['category_id']; ?></td>
          <td>
            <div class="row">
              <div class="btn-group">
                <a href="edit_category.php?edit=<?php echo $row['id']; ?>" class="btn btn-success"><span
                    class="glyphicon glyphicon-pencil"></span></a>
                <a href="category_delete.php?del=<?php echo $row['id']; ?>" class="btn btn-danger"
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
        <th>Category Name</th>
        <th>Category ID</th>
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
    var result = confirm("Are you sure you want to delete this category?");
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