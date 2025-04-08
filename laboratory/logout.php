<?php
include_once("includes/includes.php");
Session::destroy();
header("Location:login.php");