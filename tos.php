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
				<div class="row">
					<div class="col-sm-3">
						<img src="img/policy.jpg" class="img-responsive" alt="Cinque Terre" width="304" height="236">
					</div>
					<div class="col-sm-7">
						<p style = "font-size: 16px;">We give you the power to share as part of our mission to make the world more open and connected. This policy describes what information we collect and how it is used and shared. You can find additional tools and information at Privacy Policy.</p>
					</div>
				</div>
			</div>

			<button class="accordion">Privacy Policy</button>
			<div class="panel">
				<p style = "font-size: 30px;">Welcome to the Job Comer Privacy Policy</p>
				<p>When you use Job Comer services, you trust us with your information. This Privacy Policy is meant to help you understand what data we collect, why we collect it, and what we do with it. This is important; we hope you will take time to read it carefully. And remember, you can find controls to manage your information and protect your privacy and security. </p>
				<hr size=2px>
				<p style = "font-size: 30px;">Privacy Policy</p>
				<p>There are many different ways you can use our services – to search for and share information, to communicate with other people or to create new content. When you share information with us, for example by creating a Job Comer Account, we can make those services even better – to show you more relevant search results and ads, to help you connect with people or to make sharing with others quicker and easier. As you use our services, we want you to be clear how we’re using information and the ways in which you can protect your privacy</p>
				<p>Our Privacy Policy explains:</p>
				<ul>
					<li>What information we collect and why we collect it.</li>
					<li>How we use that information.</li>
					<li>The choices we offer, including how to access and update information.</li>
				</ul>
				<p>We’ve tried to keep it as simple as possible, but if you’re not familiar with terms like cookies, IP addresses, pixel tags and browsers, then read about these key terms first. Your privacy matters to Job Comer so whether you are new to Job Comer or a long-time user, please do take the time to get to know our practices – and if you have any questions contact us. </p>
				<hr size=2px>
				<p style = "font-size: 30px;">Information we collect</p>
				<p> We collect information to provide better services to all of our users – from figuring out basic stuff like which language you speak, to more complex things like which ads you’ll find most useful, the people who matter most to you online, or which YouTube videos you might like.</p>
				<p>We collect information in the following ways:</p>
				<ul>
					<li>Information you give us. For example, many of our services require you to sign up for a Job Comer Account. When you do, we’ll ask for personal information, like your name, email address, telephone number or credit card to store with your account. If you want to take full advantage of the sharing features we offer, we might also ask you to create a publicly visible Job Comer Profile, which may include your name and photo.</li>
					<li>Information we get from your use of our services. We collect information about the services that you use and how you use them, like when you watch a video on YouTube, visit a website that uses our advertising services, or view and interact with our ads and content. This information includes:
						<ul>
							<li>Device information
								<p>We collect device-specific information (such as your hardware model, operating system version, unique device identifiers, and mobile network information including phone number). Job Comer may associate your device identifiers or phone number with your Job Comer Account.</p>
							</li>
							<li>Log information
								<p>When you use our services or view content provided by Job Comer, we automatically collect and store certain information in server logs. This includes:
									<ul>
										<li>details of how you used our service, such as your search queries.</li>
										<li>telephony log information like your phone number, calling-party number, forwarding numbers, time and date of calls, duration of calls, SMS routing information and types of calls.</li>
										<li>Internet protocol address.</li>
										<li>device event information such as crashes, system activity, hardware settings, browser type, browser language, the date and time of your request and referral URL.</li>
										<li>cookies that may uniquely identify your browser or your Job Comer Account.</li>
									</ul>
								</p>
							</li>
							<li>Location information
								<p>When you use Job Comer services, we may collect and process information about your actual location. We use various technologies to determine location, including IP address, GPS, and other sensors that may, for example, provide Job Comer with information on nearby devices, Wi-Fi access points and cell towers.</p>
							</li>
							<li>Unique application numbers
								<p>Certain services include a unique application number. This number and information about your installation (for example, the operating system type and application version number) may be sent to Job Comer when you install or uninstall that service or when that service periodically contacts our servers, such as for automatic updates.</p>
							</li>
							<li>Local storage
								<p>We may collect and store information (including personal information) locally on your device using mechanisms such as browser web storage (including HTML 5) and application data caches.</p>
							</li>
							<li>Cookies and similar technologies
								<p>We and our partners use various technologies to collect and store information when you visit a Job Comer service, and this may include using cookies or similar technologies to identify your browser or device. We also use these technologies to collect and store information when you interact with services we offer to our partners, such as advertising services or Job Comer features that may appear on other sites. Our Job Comer Analytics product helps businesses and site owners analyze the traffic to their websites and apps. When used in conjunction with our advertising services, such as those using the DoubleClick cookie, Job Comer Analytics information is linked, by the Job Comer Analytics customer or by Job Comer, using Job Comer technology, with information about visits to multiple sites.</p>
							</li>
						</ul>
					</li>
				</ul>
				<p>Information we collect when you are signed in to Job Comer, in addition to information we obtain about you from partners, may be associated with your Job Comer Account. When information is associated with your Job Comer Account, we treat it as personal information. For more information about how you can access, manage or delete information that is associated with your Job Comer Account, visit the Transparency and choice section of this policy. </p>
				<hr size=2px>
				<p style = "font-size: 30px;">How we use information we collect</p>
				<p>We use the information we collect from all of our services to provide, maintain, protect and improve them, to develop new ones, and to protect Job Comer and our users. We also use this information to offer you tailored content – like giving you more relevant search results and ads.</p>
				<p>We may use the name you provide for your Job Comer Profile across all of the services we offer that require a Job Comer Account. In addition, we may replace past names associated with your Job Comer Account so that you are represented consistently across all our services. If other users already have your email, or other information that identifies you, we may show them your publicly visible Job Comer Profile information, such as your name and photo.</p>
				<p>If you have a Job Comer Account, we may display your Profile name, Profile photo, and actions you take on Job Comer or on third-party applications connected to your Job Comer Account (such as +1’s, reviews you write and comments you post) in our services, including displaying in ads and other commercial contexts. We will respect the choices you make to limit sharing or visibility settings in your Job Comer Account.</p>
				<p>When you contact Job Comer, we keep a record of your communication to help solve any issues you might be facing. We may use your email address to inform you about our services, such as letting you know about upcoming changes or improvements.</p>
				<p>We use information collected from cookies and other technologies, like pixel tags, to improve your user experience and the overall quality of our services. One of the products we use to do this on our own services is Job Comer Analytics. For example, by saving your language preferences, we’ll be able to have our services appear in the language you prefer. When showing you tailored ads, we will not associate an identifier from cookies or similar technologies with sensitive categories, such as those based on race, religion, sexual orientation or health.</p>
				<p>Our automated systems analyze your content (including emails) to provide you personally relevant product features, such as customized search results, tailored advertising, and spam and malware detection.</p>
				<p>We may combine personal information from one service with information, including personal information, from other Job Comer services – for example to make it easier to share things with people you know. Depending on your account settings, your activity on other sites and apps may be associated with your personal information in order to improve Job Comer’s services and the ads delivered by Job Comer.</p>
				<p>We will ask for your consent before using information for a purpose other than those that are set out in this Privacy Policy.</p>
				<p>Job Comer processes personal information on our servers in many countries around the world. We may process your personal information on a server located outside the country where you live. </p>
				<hr size=2px>
				<p style = "font-size: 30px;">Information you share</p>
				<p>Many of our services let you share information with others. Remember that when you share information publicly, it may be indexable by search engines, including Job Comer. Our services provide you with different options on sharing and removing your content. </p>
				<hr size=2px>
				<p style = "font-size: 30px;">Information you share</p>
				</p>Many of our services let you share information with others. Remember that when you share information publicly, it may be indexable by search engines, including Job Comer. Our services provide you with different options on sharing and removing your content. </p>
			</div>
			<button class="accordion">Terms</button>
			<div class="panel">
				<p style = "font-size: 30px;">Job Comer Terms of Service</p>
				<p style = "font-size: 25px;">Welcome to Job Comer!</p>
				<p>Thanks for using our products and services (“Services”). The Services are provided by Job Comer. (Job Comer), located at XXXX asd asd, asd asd, asd XXXXX, asd asd.</p>
				<p>By using our Services, you are agreeing to these terms. Please read them carefully.</p>
				<p>Our Services are very diverse, so sometimes additional terms or product requirements (including age requirements) may apply. Additional terms will be available with the relevant Services, and those additional terms become part of your agreement with us if you use those Services. </p>
				<hr size=2px>
				<p style = "font-size: 25px;">Using our Services</p>
				<p>You must follow any policies made available to you within the Services.</p>
				<p>Don’t misuse our Services. For example, don’t interfere with our Services or try to access them using a method other than the interface and the instructions that we provide. You may use our Services only as permitted by law, including applicable export and re-export control laws and regulations. We may suspend or stop providing our Services to you if you do not comply with our terms or policies or if we are investigating suspected misconduct.</p>
				<p>Using our Services does not give you ownership of any intellectual property rights in our Services or the content you access. You may not use content from our Services unless you obtain permission from its owner or are otherwise permitted by law. These terms do not grant you the right to use any branding or logos used in our Services. Don’t remove, obscure, or alter any legal notices displayed in or along with our Services.</p>
				<p>Our Services display some content that is not Job Comer’s. This content is the sole responsibility of the entity that makes it available. We may review content to determine whether it is illegal or violates our policies, and we may remove or refuse to display content that we reasonably believe violates our policies or the law. But that does not necessarily mean that we review content, so please don’t assume that we do.</p>
				<p>In connection with your use of the Services, we may send you service announcements, administrative messages, and other information. You may opt out of some of those communications.</p>
				<p>Some of our Services are available on mobile devices. Do not use such Services in a way that distracts you and prevents you from obeying traffic or safety laws.</p>
				<hr size=2px>
				<p style = "font-size: 25px;">Your Job Comer Account</p>
				<p>You may need a Job Comer Account in order to use some of our Services. You may create your own Job Comer Account, or your Job Comer Account may be assigned to you by an administrator, such as your employer or educational institution. If you are using a Job Comer Account assigned to you by an administrator, different or additional terms may apply and your administrator may be able to access or disable your account.</p>
				<p>To protect your Job Comer Account, keep your password confidential. You are responsible for the activity that happens on or through your Job Comer Account. Try not to reuse your Job Comer Account password on third-party applications. If you learn of any unauthorized use of your password or Job Comer Account. </p>
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
	//require_once("footer.php");
?>