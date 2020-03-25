<?
	@include("config.php");
	@include($ROOT_DIR.'/lib/basic_class.php');
	$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
	$tools = new tools();
?>
