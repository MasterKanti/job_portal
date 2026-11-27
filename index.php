<?php
$page = 'home';
include(__DIR__ . '/include/header.php');
include(__DIR__ . '/connection/db.php');

// Handle POST and GET for variables
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission
  $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
  $category = isset($_POST['category']) ? $_POST['category'] : '';
  $sub_category = isset($_POST['sub_category']) ? $_POST['sub_category'] : '';
  $page = 1; // Reset to the first page on form submission
} else {
  // Handle GET parameters
  $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
  $category = isset($_GET['category']) ? $_GET['category'] : '';
  $sub_category = isset($_GET['sub_category']) ? $_GET['sub_category'] : '';
  $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
}

$page1 = ($page - 1) * 5; // Pagination offset

// Query for job data
// $query1 = "SELECT *
// FROM `all_jobs`
// LEFT JOIN `company` ON `all_jobs`.`job_customer_email` = `company`.`company_email`
// WHERE (CASE WHEN '$keyword' <> '' THEN `job_title` LIKE CONCAT('%', '$keyword', '%') ELSE 1=1 END)
//   AND (CASE WHEN '$category' <> '' THEN `job_category` = '$category' ELSE 1=1 END)
//   AND (CASE WHEN '$sub_category' <> '' THEN `job_sub_category` = '$sub_category' ELSE 1=1 END)
// LIMIT $page1, 5";


$query1 = "SELECT *
FROM `all_jobs`
LEFT JOIN `company` ON `all_jobs`.`job_customer_email` = `company`.`company_email`
LEFT JOIN `profiles` ON `all_jobs`.`job_customer_email` = `profiles`.`user_email`
WHERE (CASE WHEN '$keyword' <> '' THEN `job_title` LIKE CONCAT('%', '$keyword', '%') ELSE 1=1 END)
  AND (CASE WHEN '$category' <> '' THEN `job_category` = '$category' ELSE 1=1 END)
  AND (CASE WHEN '$sub_category' <> '' THEN `job_sub_category` = '$sub_category' ELSE 1=1 END)
ORDER BY `all_jobs`.`job_id` DESC
LIMIT $page1, 5";


$sql = mysqli_query($conn, $query1);
$error = mysqli_num_rows($sql);

// Total number of jobs for pagination
$total_query = "SELECT COUNT(*) as total
FROM `all_jobs`
LEFT JOIN `company` ON `all_jobs`.`job_customer_email` = `company`.`company_email`
LEFT JOIN `profiles` ON `all_jobs`.`job_customer_email` = `profiles`.`user_email`
WHERE (CASE WHEN '$keyword' <> '' THEN `job_title` LIKE CONCAT('%', '$keyword', '%') ELSE 1=1 END)
  AND (CASE WHEN '$category' <> '' THEN `job_category` = '$category' ELSE 1=1 END)
  AND (CASE WHEN '$sub_category' <> '' THEN `job_sub_category` = '$sub_category' ELSE 1=1 END)";

$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_jobs = $total_row['total'];
$total_pages = ceil($total_jobs / 5);
?>

<div class="hero-wrap js-fullheight" style="background-image: url('images/bg.jpg');"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
      data-scrollax-parent="true">
      <div class="col-xl-10 ftco-animate mb-5 pb-5" data-scrollax="properties: { translateY: '70%' }">
        <p class="mb-4 mt-5 pt-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">We have <span
            class="number" data-number="<?php echo '10251'; ?>">0</span> great job offers you deserve!</p>
        <h1 class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }" style="font-size: 50px;">
          JobLyfe:<br><span>Where </span>Talent <span>meets </span>Opportunity <span>in Jobs & Tuitions!</span></h1>

        <div class="ftco-search">
          <div class="row">
            <div class="col-md-12 nav-link-wrap">
              <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab"
                  aria-controls="v-pills-1" aria-selected="true">Find a Job</a>
              </div>
            </div>
            <div class="col-md-12 tab-wrap">
              <div class="tab-content p-4" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                  aria-labelledby="v-pills-nextgen-tab">
                  <form action="index.php" method="POST" class="search-job">
                    <div class="row">
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="select-wrap">
                              <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                              <select name="category" id="category" class="form-control" onchange="this.form.submit()"
                                required>
                                <option value="">Category</option>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM `job_category`");
                                while ($row = mysqli_fetch_array($query)) {
                                  ?>
                                  <option value="<?php echo $row['category_id']; ?>" <?php if ($category == $row['category_id'])
                                       echo 'selected'; ?>>
                                    <?php echo $row['category']; ?>
                                  </option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="select-wrap">
                              <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                              <select name="sub_category" id="sub_category" class="form-control">
                                <option value="">Sub-Category</option>
                                <?php
                                if (!empty($category)) {
                                  $sub_query = mysqli_query($conn, "SELECT * FROM `sub_category` WHERE `sub_category_id`='$category'");
                                  while ($sub_row = mysqli_fetch_array($sub_query)) {
                                    ?>
                                    <option value="<?php echo $sub_row['sub_category']; ?>" <?php if ($sub_category == $sub_row['sub_category'])
                                         echo 'selected'; ?>>
                                      <?php echo $sub_row['sub_category']; ?>
                                    </option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="icon"><span class="icon-briefcase"></span></div>
                            <input type="text" name="keyword" id="keyword" class="form-control"
                              placeholder="e.g., PHP Developer" value="<?php echo $keyword; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <input type="submit" value="Search" name="search" id="search"
                              class="form-control btn btn-primary">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="id_all_jobs">
  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row justify-content-center pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <span class="subheading">Recently Added Jobs</span>
          <h2 class="mb-4"><span>Recent</span> Jobs</h2>
          <br><br>
          <h3>
            <?php
            if (!$error) {
              echo "Data not found!!!";
            }
            ?>
          </h3>
        </div>
      </div>
      <div class="row">
        <?php
        while ($row = mysqli_fetch_array($sql)) {
          ?>
          <div class="col-md-12 ftco-animate">
            <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
              <div class="mb-4 mb-md-0 mr-5">
                <div class="job-post-item-header d-flex align-items-center">
                  <h2 class="mr-2 text-black h2"><?php echo $row['job_title']; ?></h2>
                  <div class="badge-wrap">
                    <span class="bg-primary text-white badge py-2 px-3"><?php echo $row['verification']; ?></span>
                  </div>
                </div>
                <div class="badge-wrap">
                  <span class="bg-success text-white badge py-2 px-2"><?php echo $row['company']; ?></span>
                  <span class="bg-success text-white badge py-2 px-2"><?php echo $row['company_industry']; ?></span>
                </div>
                <div class="job-post-item-body d-block d-md-flex">
                  <div class="mr-3"><span class="icon-class"></span> <?php echo $row['job_type']; ?></div>
                  <div>
                    <span class="icon-my_location"></span> <span><?php echo $row['job_country']; ?>,
                      <?php echo $row['job_state']; ?>, <?php echo $row['job_city']; ?></span>
                  </div>
                </div>
                <div class="job-post-item-body d-block d-md-flex">
                  <div><span class="icon-layers"></span>
                    <span><?php echo $row['job_category']; ?><?php if (!empty($row['job_sub_category']))
                         echo ' - ' . $row['job_sub_category']; ?></span>
                  </div>
                </div>
              </div>

              <div class="ml-auto d-flex">
                <a href="blog-single.php?id=<?php echo $row['job_id']; ?>" class="btn btn-primary py-2 mr-1">Apply Job</a>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>

      <div class="row mt-5">
        <div class="col text-center">
          <div class="block-27">
            <ul>
              <!-- First Page -->
              <li>
                <a
                  href="index.php?page=1&keyword=<?php echo urlencode($keyword); ?>&category=<?php echo urlencode($category); ?>&sub_category=<?php echo urlencode($sub_category); ?>">
                  &laquo;
                </a>
              </li>

              <!-- Previous Page -->
              <li>
                <a
                  href="index.php?page=<?php echo max(1, $page - 1); ?>&keyword=<?php echo urlencode($keyword); ?>&category=<?php echo urlencode($category); ?>&sub_category=<?php echo urlencode($sub_category); ?>">
                  &lt;
                </a>
              </li>

              <!-- Dynamic Page Numbers -->
              <?php
              // Define range for visible pages
              $range = 2; // Number of pages to show before and after current page
              $start = max(1, $page - $range);
              $end = min($total_pages, $page + $range);

              for ($b = $start; $b <= $end; $b++) {
                if ($b == $page) {
                  echo " <li class='active'><span>$b</span></li> ";
                } else {
                  echo " <li><a href='index.php?page=$b&keyword=" . urlencode($keyword) . "&category=" . urlencode($category) . "&sub_category=" . urlencode($sub_category) . "'>$b</a></li> ";
                }
              }
              ?>

              <!-- Next Page -->
              <li>
                <a
                  href="index.php?page=<?php echo min($total_pages, $page + 1); ?>&keyword=<?php echo urlencode($keyword); ?>&category=<?php echo urlencode($category); ?>&sub_category=<?php echo urlencode($sub_category); ?>">
                  &gt;
                </a>
              </li>

              <!-- Last Page -->
              <li>
                <a
                  href="index.php?page=<?php echo $total_pages; ?>&keyword=<?php echo urlencode($keyword); ?>&category=<?php echo urlencode($category); ?>&sub_category=<?php echo urlencode($sub_category); ?>">
                  &raquo;
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<?php
$query2 = mysqli_query($conn, "SELECT * FROM `profiles` WHERE `user_email` = '{$_SESSION['email']}'");
while ($row = mysqli_fetch_array($query2)) {
  ?>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <span class="subheading">Referral Program</span>
          <h2 class="mb-4"><span>Your</span> Referral Details</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="bg-white p-4 rounded shadow ftco-animate">
            <div class="row align-items-center">
              <div class="col-md-6 text-center mb-3 mb-md-0">
                <h5 class="text-uppercase text-info">Referral Code</h5>
                <p class="h4 font-weight-bold mb-0" id="copyText" style="display: inline;">
                  <?php echo $row['referral_code']; ?>
                </p>
                <button onclick="copyToClipboard()"
                  style="display: inline; background: none; border: none; cursor: pointer;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 22 22">
                    <path
                      d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v16h14c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 18H8V7h11v16z" />
                  </svg>
                </button>
              </div>
              <div class="col-md-6 text-center mb-0 mb-md-0">
                <h5 class="text-uppercase text-info">Referral Link</h5>
                <p class="mb-0 text-break text-center">
                  <a href="https://joblyfe.com/signup.php?refer=<?php echo $row['referral_code']; ?>" class="text-dark"
                    target="_blank">
                    https://joblyfe.com/signup.php?refer=<?php echo $row['referral_code']; ?>
                  </a>
                  <a href="https://wa.me/?text=Find%20The%20Perfect%20Job%20Today%20At%20*JobLyfe*:%0Ahttps://joblyfe.com/signup.php?refer=<?php echo $row['referral_code']; ?>"
                    target="_blank"
                    style="background: none; border: none; cursor: pointer; display: inline-flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" viewBox="0 0 27 27">
                      <path
                        d="M16 3C9.37 3 4 8.37 4 15c0 2.39.7 4.61 1.92 6.5L4 29l7.7-1.9A12.96 12.96 0 0 0 16 27c6.63 0 12-5.37 12-12S22.63 3 16 3zm0 22c-1.94 0-3.75-.55-5.3-1.5l-.38-.23-4.56 1.13 1.2-4.47-.26-.4A9.95 9.95 0 0 1 6 15c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.06-7.44c-.28-.14-1.63-.8-1.88-.9-.25-.1-.43-.14-.6.14s-.7.9-.85 1.09c-.16.18-.31.2-.6.07-1.64-.66-2.7-1.18-3.78-2.67-.29-.4-.3-.6-.15-.79.14-.18.33-.38.5-.57.17-.2.23-.34.34-.57.11-.23.06-.42 0-.57-.07-.14-.6-1.45-.82-1.99-.22-.54-.44-.47-.6-.48h-.51c-.17 0-.44.06-.67.3-.23.25-.88.86-.88 2.1s.9 2.43 1.02 2.6c.12.16 1.78 2.72 4.3 3.8.6.26 1.06.42 1.42.54.6.19 1.16.17 1.6.1.49-.07 1.5-.61 1.7-1.2.21-.59.21-1.1.14-1.2-.07-.1-.25-.16-.53-.3z" />
                    </svg>
                  </a>
                </p>
              </div>
            </div>
          </div>

          <div class="bg-white p-4 mt-4 rounded shadow ftco-animate">
            <div class="row align-items-center">
              <div class="col-md-6 text-center mb-3 mb-md-0">
                <h5 class="text-uppercase text-info">Referral Point</h5>
                <p class="h4 font-weight-bold mb-0"><?php echo $row['referral_point']; ?></p>
              </div>
              <div class="col-md-6 text-center mb-3 mb-md-0">
                <h5 class="text-uppercase text-info">Earnings</h5>
                <p class="h4 font-weight-bold mb-0">₹<?php echo $row['referral_point'] * 10; ?></p>
              </div>
              <!-- <div class="col-md-4 text-center mb-3 mb-md-0">
                <h5 class="text-uppercase text-info">Withdrawn</h5>
                <p class="h4 font-weight-bold mb-0">₹
                  <?php
                  // echo $row['withdrawn_point'] * 5;
                  ?>
                </p>
              </div> -->
              <div class="col-md-12 text-center mb-0 mb-md-0">
                <p class="h4 font-weight-bold mt-2 mb-0 text-info">** Redeem Your Referral Earnings From Your Next Job
                  **
                </p>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </section>
  <?php
}
?>

<section class="ftco-section services-section bg-light">
  <div class="container">
    <div class="row d-flex">
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services d-block">
          <div class="icon"><span class="flaticon-resume"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Search Millions of Jobs & Tuitions</h3>
            <p>Find countless job opportunities tailored to your skills and preferences.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services d-block">
          <div class="icon"><span class="flaticon-collaboration"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Easy To Manage Jobs & Tuitions</h3>
            <p>Streamline your job applications and postings effortlessly in one place.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services d-block">
          <div class="icon"><span class="flaticon-promotions"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Top Careers</h3>
            <p>Explore leading career paths and industries to shape your future.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services d-block">
          <div class="icon"><span class="flaticon-employee"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Search Expert Candidates</h3>
            <p>Connect with skilled professionals ready to meet your hiring needs.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-counter">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <span class="subheading">Categories work wating for you</span>
        <h2 class="mb-4"><span>Current</span> Job Posts</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 ftco-animate">
        <ul class="category">
          <li><a href="job-post.php">Teaching &amp; Admistration <span class="number" data-number="1000">0</span></a>
          </li>
          <li><a href="job-post.php">Tutoring Jobs <span class="number" data-number="1000">0</span></a></li>
          <li><a href="job-post.php">Administrative & Support <span class="number" data-number="2000">0</span></a></li>
          <li><a href="job-post.php">Customer Service <span class="number" data-number="900">0</span></a></li>
        </ul>
      </div>
      <div class="col-md-3 ftco-animate">
        <ul class="category">
          <li><a href="job-post.php">Finance &amp; Accounting<span class="number" data-number="3500">0</span></a></li>
          <li><a href="job-post.php">Sales &amp; Marketing <span class="number" data-number="1560">0</span></a></li>
          <li><a href="job-post.php">Human Resources <span class="number" data-number="1000">0</span></a></li>
          <li><a href="job-post.php">IT &amp; Software Development <span class="number" data-number="2500">0</span></a>
          </li>
        </ul>
      </div>
      <div class="col-md-3 ftco-animate">
        <ul class="category">
          <li><a href="job-post.php">Engineering &amp; Technical Roles <span class="number"
                data-number="5500">0</span></a></li>
          <li><a href="job-post.php">Healthcare &amp; Medical <span class="number" data-number="2000">0</span></a></li>
          <li><a href="job-post.php">Education &amp; Training <span class="number" data-number="800">0</span></a></li>
          <li><a href="job-post.php">Creative &amp; Design <span class="number" data-number="7000">0</span></a></li>
        </ul>
      </div>
      <div class="col-md-3 ftco-animate">
        <ul class="category">
          <li><a href="job-post.php">Legal &amp; Compliance <span><span class="number"
                  data-number="8000">0</span></span></a></li>
          <li><a href="job-post.php">Writing &amp; Editing <span class="number" data-number="4000">0</span></a></li>
          <li><a href="job-post.php">Scientific &amp; Research <span class="number" data-number="3300">0</span></a></li>
          <li><a href="job-post.php">Construction &amp; Skilled Trades <span class="number"
                data-number="1356">0</span></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>



<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);"
  data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="10251">0</strong>
                <span>Jobs</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="3372">0</strong>
                <span>Members</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="11024">0</strong>
                <span>Resume</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="478">0</strong>
                <span>Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="ftco-section testimony-section">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <span class="subheading">Testimonial</span>
        <h2 class="mb-4"><span>Happy</span> Clients</h2>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-md-12">
        <div class="carousel-testimony owl-carousel ftco-owl">
          <div class="item">
            <div class="testimony-wrap py-4 pb-5">
              <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text">
                <p class="mb-4">JobLyfe made finding my dream job and tutoring opportunities a breeze!</p>
                <p class="name">Roger Scott</p>
                <span class="position">Marketing Manager</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap py-4 pb-5">
              <div class="user-img mb-4" style="background-image: url(images/person_2.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text">
                <p class="mb-4">As a teacher, I easily connected with students in need of guidance through JobLyfe.</p>
                <p class="name">Roger Scott</p>
                <span class="position">Interface Designer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap py-4 pb-5">
              <div class="user-img mb-4" style="background-image: url(images/person_3.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text">
                <p class="mb-4">This platform is a game-changer for anyone looking to teach or be taught!</p>
                <p class="name">Roger Scott</p>
                <span class="position">UI Designer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap py-4 pb-5">
              <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text">
                <p class="mb-4">Thanks to JobLyfe, I landed a job that perfectly matches my skills.</p>
                <p class="name">Roger Scott</p>
                <span class="position">Web Developer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap py-4 pb-5">
              <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text">
                <p class="mb-4">Managing my tutoring gigs and job applications has never been simpler!</p>
                <p class="name">Roger Scott</p>
                <span class="position">System Analyst</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <span class="subheading">FAQs</span>
        <h2><span>Frequently Asked</span> Questions</h2>
      </div>
    </div>
    <div class="row d-flex">
      <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <!-- <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a> -->
          <div class="text mt-3">
            <!-- <div class="meta mb-2">
                  <div><a href="#">December 2, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div> -->
            <h3 class="heading"><a href="job-post.php">What types of job opportunities do you provide?</a></h3>
            <p>We provide a variety of job opportunities in the education sector, including teaching positions,
              administrative roles in office and tutoring jobs.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <!-- <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a> -->
          <div class="text mt-3">
            <!-- <div class="meta mb-2">
                  <div><a href="#">December 2, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div> -->
            <h3 class="heading"><a href="job-post.php">Who can benefit from your services?</a></h3>
            <p>Our services are designed for students, recent graduates, educational professionals seeking employment,
              and educational institutions looking to hire qualified staff.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <!-- <a href="blog-single.html" class="block-20" style="background-image: url('images/image_4.jpg');">
              </a> -->
          <div class="text mt-3">
            <!-- <div class="meta mb-2">
                  <div><a href="#">December 2, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div> -->
            <h3 class="heading"><a href="job-post.php">How can I register for your services?</a></h3>
            <p>You can register by filling out the registration form on our website and uploading your resume. Our team
              will review your information and get in touch with you.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row d-flex">
      <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <!-- <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a> -->
          <div class="text mt-3">
            <!-- <div class="meta mb-2">
                  <div><a href="#">December 2, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div> -->
            <h3 class="heading"><a href="job-post.php">How can I contact customer support?</a></h3>
            <p>You can reach our customer support team through the contact form on our website, email, or phone. Our
              team is available to assist you with any queries.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <!-- <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a> -->
          <div class="text mt-3">
            <!-- <div class="meta mb-2">
                  <div><a href="#">December 2, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div> -->
            <h3 class="heading"><a href="job-post.php">Is there a fee for your services?</a></h3>
            <p>Our initial consultation and basic services are free. However, we offer premium services, such as
              advanced career counseling and exclusive job & tuition matching, for a fee.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <!-- <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a> -->
          <div class="text mt-3">
            <!-- <div class="meta mb-2">
                  <div><a href="#">December 2, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div> -->
            <h3 class="heading"><a href="job-post.php">What recruitment services do you offer for educational
                institutions?</a></h3>
            <p>We assist with candidate sourcing, screening, and selection. We also provide consultancy on best hiring
              practices and market trends.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2>Subcribe to our Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
              <div class="row d-flex justify-content-center mt-4 mb-4">
                <div class="col-md-8">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

<?php
include(__DIR__ . '/include/footer.php');
?>