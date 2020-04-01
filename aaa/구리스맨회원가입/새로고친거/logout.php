<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

		$_SESSION[member][id]		= $row[user_id];
		$_SESSION[member][idx]		= $row[m_idx];
		$_SESSION[member][name]		= $row[user_name];
		$_SESSION[member][email]	= $row[user_email];
		$_SESSION[member][level]	= $row[user_level];
		$_SESSION[member][chmods]	= $row[chmods];
		$_SESSION[member][mobile]	= $row[mobile];

?>
<script>	
	location.href="/";
</script>