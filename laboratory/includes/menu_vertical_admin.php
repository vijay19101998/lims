<?php 
include_once("includes/includes.php");
Session::checkSession();
$userRole = Session::get("roleId");

$getrolemenu = $app->getrolemenu();
foreach($getrolemenu as $index => $result){
  $json_decode = json_decode($result['name'], true);
  foreach ($json_decode as $key => $innerArr) {
    $roles[$key] = $innerArr;
    }
}

// print_r($newArray);
?>
<ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item fc1-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
            <a href="index.php" class="nav-link">
              <i class="link-icon" data-feather="home"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item fc1-event">
            <a class="nav-link" data-bs-toggle="collapse" href="#userConfig" role="button" aria-expanded="false" aria-controls="userConfig">
              <i class="link-icon" data-feather="user"></i>
              <span class="link-title">User Config</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="userConfig">
              <ul class="nav sub-menu mt-2">
              <li class="nav-item"><a class="nav-link1" href="usertype.php">Roles</a></li>
             <li class="nav-item"><a class="nav-link1" href="role-menu.php">Role Menu</a></li>
            <li class="nav-item"><a class="nav-link1" href="role-permission.php">Role Permissions</a></li>
             <li class="nav-item"><a class="nav-link1" href="user.php">User Registration</a></li>
              </ul>
            </div>
          </li>
         
          <li class="nav-item fc1-event fc-h-event fc-daygrid-event fc-daygrid-block-event">
            <a href="worksheet_list.php" class="nav-link">
              <i class="link-icon" data-feather="file"></i>
              <span class="link-title">Worksheet</span>
            </a>
          </li>
          <li class="nav-item fc1-event">
            <a class="nav-link" data-bs-toggle="collapse" href="#testing" role="button" aria-expanded="false" aria-controls="testing">
              <i class="link-icon" data-feather="activity"></i>
              <span class="link-title">Testing</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="testing">
              <ul class="nav sub-menu mt-2">
                <li class="nav-item">
                  <a href="pending-test.php" class="nav-link1">Assign Test</a>
                </li>
                <li class="nav-item">
                  <a href="sample-registration.php" class="nav-link1">Create Test</a>
                </li>
                <li class="nav-item">
                  <a href="master-test.php" class="nav-link1">Approval Pending</a>
                </li>
                <li class="nav-item">
                  <a href="test-retesting.php" class="nav-link1">Re-Testing</a>
                </li>
                <li class="nav-item">
                  <a href="test-resampling.php" class="nav-link1">Re-Sampling</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item fc1-event">
            <a class="nav-link" data-bs-toggle="collapse" href="#approvals" role="button" aria-expanded="false" aria-controls="approvals">
              <i class="link-icon" data-feather="grid"></i>
              <span class="link-title">Approvals</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="approvals">
              <ul class="nav sub-menu mt-2">
              <li class="nav-item"><a class="nav-link1" href="test-lib.php">Test</a></li>
              <li class="nav-item"><a class="nav-link1" href="test-retest.php">Re-Test</a></li>
              <li class="nav-item"><a class="nav-link1" href="test-resample.php">Re-Sample</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item fc1-event">
            <a class="nav-link" data-bs-toggle="collapse" href="#record" role="button" aria-expanded="false" aria-controls="record">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Reports</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="record">
              <ul class="nav sub-menu mt-2">
              <li class="nav-item"><a class="nav-link1" href="testing-report.php">Sample Report</a></li>
			      	<li class="nav-item"><a class="nav-link1" href="track-sample.php">Track Sample</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item fc1-event">
            <a class="nav-link" data-bs-toggle="collapse" href="#master" role="button" aria-expanded="false" aria-controls="master">
              <i class="link-icon" data-feather="edit"></i>
              <span class="link-title">Masters</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="master">
              <ul class="nav sub-menu mt-2">
              <li class="nav-item"><a class="nav-link1" href="test-category.php">Test Category</a></li>
              <li class="nav-item"><a class="nav-link1" href="test-group.php">Discipline</a></li>
              <li class="nav-item"><a class="nav-link1" href="material.php">Material Group</a></li>
              <li class="nav-item"><a class="nav-link1" href="material-category.php">Material Category</a></li>
              <li class="nav-item"><a class="nav-link1" href="sample-master.php">Sample Master</a></li>
              <li class="nav-item"><a class="nav-link1" href="materiallist.php">Material Test Format</a></li>
              <li class="nav-item"><a class="nav-link1" href="stt.php">Std Test Type</a></li>
              <li class="nav-item"><a class="nav-link1" href="stp.php">Std Test Procedure</a></li>
              <li class="nav-item"><a class="nav-link1" href="product-category.php">Product Category</a></li>
             <li class="nav-item"><a class="nav-link1" href="notes.php">Notes</a></li>
            </ul>
            </div>
          </li>
   
          <!-- <li class="nav-item fc1-event">
            <a class="nav-link" data-bs-toggle="collapse" href="#workSheet" role="button" aria-expanded="false" aria-controls="workSheet">
              <i class="link-icon" data-feather="file"></i>
              <span class="link-title">Work sheets</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="workSheet">
              <ul class="nav sub-menu mt-2">
              <li class="nav-item"><a class="nav-link1" href="worksheet_list.php">Work Sheet</a></li>
               <li class="nav-item"><a class="nav-link1" href="test-form.php">Work Sheet</a></li>
            </ul>
            </div>
          </li> -->

  

          <!-- <li class="nav-item fc1-event">
            <a class="nav-link" data-bs-toggle="collapse" href="#worksheet" role="button" aria-expanded="false" aria-controls="worksheet">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Work sheets</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="worksheet">
              <ul class="nav sub-menu mt-2">
              <li class="nav-item"><a class="nav-link1" href="work-sheet.php">Work sheet</a></li>
            </ul>
            </div>
          </li> -->
          
           

        </ul>