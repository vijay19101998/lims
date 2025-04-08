<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "dashboard";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
$getDashboard= $app->getDashboard();
// echo json_encode($getDashboard);

// print_r($getDashboard)
?>
<style>
  /* .sample {
    background: linear-gradient(to right, #80CBC4 0%, #cdfaf6 100%)
  } */
  .sample {
    background: linear-gradient(to right, #43a49b 0%, #26a69a 100%);
    color: #fff;
    box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
  }
  .sample:hover {
  box-shadow: 0 4px 10px rgba(0,0,0,0.16), 0 4px 10px rgba(0,0,0,0.23);
}

  .stretch-card > .card {
    border-radius: 11px;
}
.inner-shadow {
  box-shadow: 0 4px 10px rgba(0,0,0,0.16), 0 4px 10px rgba(0,0,0,0.23);
  }
  .widget-icon{
    color:#464c4c;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
}
</style>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>
<link rel="shortcut icon" href="assets/images/favicon.png" />
<h6 class="mb-0">Test Summary</h6>
<hr>
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card" >
        <div class="card sample radius-10">
          <div class="card-body" onclick="location.href = 'pending-test.php';">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Assigned</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4"><?= $getDashboard['totalAssign'] ?></h3>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div class="ms-auto widget-icon">
                  <i class="fa-sharp fa-solid fa-flask-vial"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card sample radius-10 border-0">
          <div class="card-body" onclick="location.href = 'master-test.php';">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Approval Pending</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4"><?= $getDashboard['approvalPending'] ?></h3>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div class="ms-auto widget-icon">
                  <i class="fa-solid fa-vial-circle-check"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card sample radius-10 border-0">
          <div class="card-body" onclick="location.href = 'testing-report.php';">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Approved</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4"><?= $getDashboard['approved'] ?></h3>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div class="ms-auto widget-icon">
                  <i class="fa-solid fa-vial"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card sample radius-10 border-0">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Rejected</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4">0</h3>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div class="ms-auto widget-icon">
                  <i class="fa-solid fa-circle-xmark"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card card sample radius-10 border-0">
          <div class="card-body" onclick="location.href = 'test-resampling.php';">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Re-sample</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4"><?= $getDashboard['resample'] ?></h3>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div class="ms-auto widget-icon">
                  <i class="fa-solid fa-vial-virus"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card sample radius-10 border-0">
          <div class="card-body" onclick="location.href = 'test-retesting.php';">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Re-test</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mt-4"><?= $getDashboard['retest'] ?></h3>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div class="ms-auto widget-icon">
                  <i class="fa-solid fa-microscope"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--  -->  
<div class="row">
<div class="col-xl-6 grid-margin stretch-card">
						<div class="card inner-shadow_ shadow-inner" style="background-color: #D0EBEA;box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;">
							<div class="card-body"  _style="background:#cdfaf6;">
								<h6 class="card-title">Role chart</h6>
								<div class="flot-chart-wrapper">
									<div class="flot-chart" id="flotPie" _style="height: 300px;" ></div>
								</div>
							</div>
						</div>
					</div>
  <div class="col-xl-6 grid-margin stretch-card">
    <div class="card shadow-inner" style="background-color: #D0EBEA;box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;">
      <div class="card-body" _style="background:#cdfaf6;">
        <h6 class="card-title">Sample Status</h6>
        <!-- <canvas id="chartjsMixedBar" width="467" height="433"
          style="display: block; box-sizing: border-box; height: 233px; width: 467px;">
        </canvas> -->
        <canvas id="chartjsMixedBar" width="467" height="433" style="display: block; box-sizing: border-box; height: 233px; width: 467px;"></canvas>

      </div>
    </div>
  </div>
</div>



<script>
  var php = '<?php echo json_encode($getDashboard)?>';
</script>

<?php include_once(filePath . "/footer.php"); ?>
<?php include_once(filePath . "/js.php"); ?>
<!-- <script src="assets/vendors/core/core.js"></script> -->
<script src="assets/vendors/jquery.flot/jquery.flot.js"></script>
<script src="assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
<script src="assets/vendors/jquery.flot/jquery.flot.pie.js"></script>
<script src="assets/vendors/jquery.flot/jquery.flot.categories.js"></script>

<script src="assets/vendors/feather-icons/feather.min.js"></script>
<!-- <script src="assets/js/template.js"></script> -->


<script src="assets/js/jquery.flot-light.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- <script src="assets/vendors/chartjs/Chart.min.js"></script> -->
<script src="assets/js/chartjs-light.js"></script>
<script>
     // Sample data for the mixed bar chart
     const data = {
    labels: ['January', 'February', 'March', 'April', 'May'],
    datasets: [{
        label: 'Approval',
        type: 'bar',
        data: [10, 20, 30, 40, 50],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }, {
        label: 'Re-Test',
        type: 'bar',
        data: [15, 25, 35, 45, 55],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
    }, {
        label: 'Re-Sample',
        type: 'line',
        data: [5, 10, 15, 20, 25],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        fill: false
    }, {
        label: 'Pending',
        type: 'line',
        data: [8, 12, 18, 22, 28],
        backgroundColor: 'rgba(255, 205, 86, 0.2)',
        borderColor: 'rgba(255, 205, 86, 1)',
        borderWidth: 1,
        fill: false
    }, {
        label: 'Approval Pending',
        type: 'line',
        data: [10, 15, 20, 25, 30],
        backgroundColor: 'rgba(153, 102, 255, 0.2)',
        borderColor: 'rgba(153, 102, 255, 1)',
        borderWidth: 1,
        fill: false
    }]
};


        // Configuration options for the chart
        const options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Get the canvas element
        const ctx = document.getElementById('chartjsMixedBar').getContext('2d');

        // Create the mixed bar chart
        const chart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
//   document.addEventListener('contextmenu', function(e) {
//   e.preventDefault();
// });
</script>
</body>
</html>



