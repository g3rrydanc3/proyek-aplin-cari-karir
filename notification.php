<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
?>
	<div class="wrapper">
		<div class="container">
			<h1>Notification</h1>
			
			<a href="http://<?php echo getFolderUrl();?>notification.php?notif=1" class="nounderline">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>New Message</h4>
						From ASDF
					</div>
					<div class="panel-body">
						<p>For 50 years, WWF has been protecting...</p>
					</div>
				</div>
			</a>
			
		</div>
	</div>
<?php
	require_once("footer.php");
?>