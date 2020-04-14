<?php
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/adm/inc/header_inc.php";
?>
	<section id="container">		
		<div class="layout_wrap">
			


		<?
			$t = create_customer_code();
			echo $t;

			/*
			$aaa = "f";
			echo HexToDe($aaa, $hexNum) . "<br/>";
			$bbb = 20;
			echo DeToHex($bbb, $hexNum);
			*/
		?>

		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/adm/inc/footer_inc.php";?>
