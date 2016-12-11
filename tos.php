<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("header.php");
?>
<style>
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    text-align: left;
    border: none;
    outline: none;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

button.accordion:after {
    content: '\02795';
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}

button.accordion.active:after {
    content: "\2796";
}

div.panel {
    padding: 0 18px;
    background-color: white;
    display: none;
}

div.panel.show {
    display: block;
}
</style>
	<div class="wrapper">
		<div class="container">
			<button class="accordion">Data Policy</button>
			<div class="panel">
				<p>We give you the power to share as part of our mission to make the world more open and connected. This policy describes what information we collect and how it is used and shared. You can find additional tools and information at Privacy Basics. </p>
			</div>

			<button class="accordion">Privacy Basics</button>
			<div class="panel">
				<p>Lorem ipsum...</p>
			</div>

			<button class="accordion">Cookies Policy</button>
			<div class="panel">
				<p>Lorem ipsum...</p>
			</div>
			<button class="accordion">Terms</button>
			<div class="panel">
				<p>Lorem ipsum...</p>
			</div>
		</div>
	</div>
	
<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].onclick = function(){
			this.classList.toggle("active");
			this.nextElementSibling.classList.toggle("show");
		}
	}
</script>
<?php
	require_once("footer.php");
?>