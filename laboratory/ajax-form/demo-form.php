<?php
include_once("../includes/includes.php");
$html='<form method="post" action="demoSubmit" id="demoForm">';
$html.='<div class="modal-header">
	<h5 class="modal-title h4" id="myLargeModalLabel">Add demo form</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
	</button>
	</div>
	<div class="modal-body">
	<div class="form-group">
	  <label>Demo Name</label>
	  <input type="text" name="name" id="name" class="form-control" required />
	</div>
	</div>
	<div class="modal-footer">
	<input type="hidden" name="id" id="id" value="" />
	<input type="hidden" name="form_action" id="form_action" value="insert" />
	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" id="action-btn" >Submit</button>
</div>
</form> ';
$array = array("html"=>$html);
echo json_encode($array);