circledemo.php<?php
include 'includes/header.php';
?>
<body id="main" >
	<?php
include 'includes/leftsidebar.php';
?>
	<section class="pt-4 ">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h2 class="text-white">SELECT YOUR ORDER TYPE</h2>
				<div class="col-center">
					
					<div class="col1 oneline">
						
						<a href="paymentmode.php">
						<div class="circle-in"><span class="fa-icons"><i class="fas fa-utensils"></i></span><br><p class="text-white">Dine In</p></div>
						</a>
					
				</div>
				

				<div class="col1 oneline">
				
				<a href="paymentmode.php">
					<div class="circle-in"><span class="fa-icons"><i class="fas fa-shopping-bag"></i></span><br><p class="text-white">Take Away</p></div>
					</a>
			</div>
	</div>
				</div>
			</div>
		
		</div>

	</section>



<?php
include 'includes/footer.php';
?>