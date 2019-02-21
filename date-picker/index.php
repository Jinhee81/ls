<!DOCTYPE html>
<html>
<head>
	<title>Datepicker</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<style type="text/css">
		#datepicker{
			width: 180px; margin: 0 20px 20px 20px;
		}
		#datepicker > span:hover{
			cursor: pointer;
		}
	</style>
</head>
<body>
<h1 align="center">Create Datepicker</h1>
<div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
	<input class="form-control" type="text" name="">
	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
</div>
<script type="text/javascript">
	$(function(){
		$("#datepicker").datepicker({
			autoclose: true,
			todayHighlight: true
		}).datepicker('update', new Date());
	});
</script>
</body>
</html>