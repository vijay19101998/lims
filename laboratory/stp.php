<?php
include_once("includes/includes.php");
//Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
//$get_removedata=$app->getRemovedata(1);
//print_r($get_removedata);
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'standard-test-procedure');
$parametersList = $app->parametersList();
?>
<html>
<style>
    .go {
        margin-top: 25px;
    }
</style>

<body class="bg">
    <main id="main" class="main">
        <div class="pagetitle">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Masters</li>
                    <li class="breadcrumb-item active" aria-current="page">Standard Test Procedure</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Standard Test Procedure List</h6>
                    <?php if($hasPermission["create"]=='true') { ?>
                    <button class="btn btn-xs btn-primary btn-icon-text" id="adddoc">
                        <i class="mdi mdi-plus-box"></i> Create
                    </button>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
            <div class="row">
            <div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Parameter</label>
                                    <select class="form-control form-control-xs parameters js-example-tags" data="0" name="parameters[]">
                                    <option value="">Select</option>
                                    <?php
                                    foreach ($parametersList as $row) {
                                        echo '
                                            <option value="' . $row["test_parameters"] . '" >' . $row["test_parameters"] . '</option>';
                                    }
                                    ?>
                                    </select>
								</div>
							</div>
            <div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Protocol</label>
                                    <select class="form-control form-control-xs" id="protocol" name="" value="" required >
                                        <option>Select</option>
                                     </select>
								</div>
							</div>
          </div>
                <div id="content">
                    <div class="table-responsive-md">
                        <table id="stpList" class="table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Protocol</th>
                                    <th>Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="docModalUpload">
        <div class="modal-dialog modal-lg">
            <form method="post" action="docSubmit" id="docForm" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Standard Test Procedure Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Parameter</label>
                            <input type="text" name="parameter" id="parameter" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Protocol</label>
                            <input type="text" name="protocol" id="protocol" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Doc Upload</label>
                            <input type="file" name="file[]" multiple="multiple" class="form-control" />
                            <br>
                        </div>
                        <div id="test" class="clear">
                        </div>
                        <input type="text" id="removefile" name="removefile" value='' hidden>
                        <div class="form-group">
                            <label>Img Upload</label>
                            <input type="file" name="filenew[]" multiple="multiple" class="form-control" />
                        </div>
                        <input type="radio" id="removefile" name="removefile" value='' hidden>
                        <div class="form-group">
                            <label>Img Upload</label>
                            <input type="file" name="filenew[]" multiple="multiple" class="form-control" />
                        </div>
                        <br>
                        <div id="test2" class="clear">
                        </div>
                        <input type="text" id="removefile2" name="removefile2" value='' hidden>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="form_action" id="form_action" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="docModal">
        <div class="modal-dialog modal-lg">
            <form method="post" action="docSubmit" id="docForm" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Standard Test Procedure Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Parameter</label>
                            <input type="text" name="parameter" id="parameter" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Protocol</label>
                            <input type="text" name="protocol" id="protocol" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Doc Upload</label>
                            <input type="file" name="file[]" multiple="multiple" class="form-control" />
                            <br>
                        </div>
                        <div id="test" class="clear">
                        </div>
                        <input type="text" id="removefile" name="removefile" value='' hidden>
                        <div class="form-group">
                            <label>Img Upload</label>
                            <input type="file" name="filenew[]" multiple="multiple" class="form-control" />
                        </div>
                        <input type="radio" id="removefile" name="removefile" value='' hidden>
                        <div class="form-group">
                            <label>Img Upload</label>
                            <input type="file" name="filenew[]" multiple="multiple" class="form-control" />
                        </div>
                        <br>
                        <div id="test2" class="clear">
                        </div>
                        <input type="text" id="removefile2" name="removefile2" value='' hidden>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="form_action" id="form_action" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="datadocModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Document Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>No of Document:<b><span id="count"></span></b></label>
                        <!-- <input type="text" name="count" id="count" class="form-control" /> -->
                    </div>
                    <label>Document Name:</label>
                    <div class="form-group" id="dname">
                    </div>
                    <br>
                    <hr>
                    <div class="form-group">
                        <label>NO of Document2:<b><span id="count2"></span></b></label>
                    </div>
                    <label>Document2 Names:</label>
                    <div class="form-group" id="dname2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="typeModal">
    <div class="modal-dialog modal-lg" style="max-width:1250px !important">
        <form method="post" action="worksheetSubmit" id="wsSubForm" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="headName" style="color: #26A69A;"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="worksheetform">
                        <!--  -->
                        <!--  -->
                        <!--  -->
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="testingId" id="testingId" value="<?= $testingId; ?>" />
                        <input type="hidden" name="headId" id="headId" />
                        <input type="hidden" name="form_action" id="form_action" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <?php include_once(filePath . "/footer.php"); ?>
    <?php include_once(filePath . "/js.php"); ?>
    <script src="<?php echo BASE_URL; ?>includes/js/stp.js"></script>
    <script>
           $(document).ready(function () {
    //
    $("body").on('click', '.usertype', function (e) {
            var headId = (this.id);
            // var headId = '1';
            var headName = $(this).attr('text');
            $('#headId').val(headId);
            $('#typeModal').modal('show');
            $.ajax({
                type: "POST",
                url: "ajax-query/masterSubmit.php",
                data: { action: 'worksheetform1', headId: headId},
                dataType: "json",
                success: function (response) {

                    $('#worksheetform').html(response.html);
                    $('#headName').text(headName);


                }
            });
        });

    });
//
    </script>
</body>

</html>