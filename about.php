<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
?>
	<div class="wrapper">
		<div class="container">
			<div class="jumbotron">
				<h1>About Us</h1>
				<p class>Job Comer adalah salah satu web untuk mencari pekerjaan yang ditawarkan berbagai perusahaan yang ada di Indonesia.</p>
				<p>Tidak hanya itu, Job Comer juga dapat memberi fasilitas kepada perusahaan yang mencari pekerja yang sesuai dengan apa yang di butuhkan perusahaan tersebut.</p>
				<p>Dengan kata lain Job Comer membantu anda dalam proses mencari pekerjaan yang sesuai dengan kemampuan anda.</p>
			</div>
		</div>
	</div>
<?php
	require_once("footer.php");
?>