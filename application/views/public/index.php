
<div id="content">

	
<?php
$this->load->view("public/pIncludes/navbar");
?>
<article id="post-300" class="hentry post-300 page type-page status-publish" role="article">
	<header class="entry-header visuallyhidden">Home</header>
		<section id="home" class="row section section-rotating-slide section-rotating-slide-home min-height600 first-of-type" style="background-image: url(assets/images/Picture_1.jpg); background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">
			<div class="vid-overlay" aria-hidden="true"><img src="public/themes/sweetgreen-wp-theme/img/gr-vid-overlay.png"></div>

			<div id="spinner"></div>
		</section>
		    
		<h1 class="text-center text-capital mt46" id="menu">Menu</h1>
		<?php
		$this->load->view("public/menu");
		$this->load->view("public/engagement");
		$this->load->view("public/footer");
		?>
		<div class="row">
			<div class="col-12">
				<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d13611.990965321229!2d74.26126031082941!3d31.46924830399274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e0!4m5!1s0x391903d3c75b3817%3A0xed9e8eb65b155c3f!2sAbdul+Haque+Rd%2C+Johar+Town%2C+Lahore%2C+Punjab%2C+Pakistan!3m2!1d31.4692303!2d74.2700151!4m0!5e0!3m2!1sen!2s!4v1548423994669" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</article>

	<script>
// When the user scrolls down 20px from the top of the document, slide down the navbar
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
	if (document.body.scrollTop > 560 || document.documentElement.scrollTop > 560) {
		$( "#sidenav" ).removeClass( "hide" );
	} else {
		$( "#sidenav" ).addClass( "hide" );
	}
}
</script>





</div>
