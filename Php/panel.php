<?php
session_start();
if (isset($_SESSION("User"))) {
	?>
	<script type="text/javascript">
		window.location = "panel.php"
	</script>
	<?php
}
?>

<?php
include ("header.php");
?>

<div id="content">
	<div id="content-header">
		<div id="admin"><a href="panel.php" class="tip-bottom"><i class="icon-home"></i>HDASHBOARD</a></div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid" style="">
			<div class="card"></div>
		</div>
	</div>
</div>

<?php
include "footer.php";
?>