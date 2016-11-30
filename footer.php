<?php
	//menghindari direct access header,footer,db,dll
	if(!defined('Access')) {
		die('Direct access not permitted');
	}
?>
	<footer class="footerStick">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="logofooter"> Logo</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
					<p><i class="fa fa-map-pin"></i> 210, Aggarwal Tower, Rohini sec 9, New Delhi -        110085, INDIA</p>
					<p><i class="fa fa-phone"></i> Phone (India) : +91 9999 878 398</p>
					<p><i class="fa fa-envelope"></i> E-mail : info@webenlance.com</p>
				</div>
				<div class="col-sm-6">
					<h4>GENERAL LINKS</h4>
					<ul class="footer-ul">
						<li><a href="#"> Career</a></li>
						<li><a href="#"> Privacy Policy</a></li>
						<li><a href="#"> Terms & Conditions</a></li>
						<li><a href="#"> Client Gateway</a></li>
						<li><a href="#"> Ranking</a></li>
						<li><a href="#"> Case Studies</a></li>
						<li><a href="#"> Frequently Ask Questions</a></li>
					</ul>
				</div>
			</div>
			<p class="text-muted text-center">Job Comer © 2016</p>
		</div>
	</footer>
    <!-- jQuery -->
    <script src="http://<?php echo getFolderUrl();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://<?php echo getFolderUrl();?>js/bootstrap.min.js"></script>
	<script src="http://<?php echo getFolderUrl();?>js/sweetalert.min.js"></script>
	<script src="http://<?php echo getFolderUrl();?>js/fileinput.min.js"></script>
    <script src="http://<?php echo getFolderUrl();?>js/script.js"></script>
	
	<?php echo $javascript;?>
</body>

</html>
