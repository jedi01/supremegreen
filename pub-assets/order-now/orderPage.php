<?php
include 'includes/header.php';
?>
<body id="main" style="background: #333333;">
	<?php
	include 'includes/leftsidebar.php';
	include 'includes/left_icons.php';
	include 'includes/right_icons.php';
	?>	
	<div class="container-fluid pt-5">
		<div class="row">
			<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
			</div>
			<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 pt50">
				<h1 class="text-center text-white">YOUR ORDER</h1>
				<hr class="hr-white">
				<div class="row">
					<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
						<h2 class="text-white">SALAD</h2>
					</div>
					<div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
						<h5 class="text-white">CREATE YOUR OWN SALAD</h5>
						<h6 class="text-white">Organic Product, Second Product, Third Product, Second Product, Third Product
						, Second Product, Third Product, Second Product, Third Product</h6>
					</div>
					<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
						<div class="leftsidecontentmiddle">
						<button class="btn btn-default btn-w btn-block">Change</button>
						<button class="btn btn-default btn-w btn-block">DELETE</button>
					</div>
				</div>
					<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 leftsidecontentmiddle" style="text-align: center; vertical-align: middle;">
						<div class="row " >
						<input type="text" class="noOfRoom" style="width: 30px; background: transparent; border: none;color: #fff; font-size: 18px;"  value="1" name="noOfRoom" />&nbsp;
						<button class="glyp-ico adds" > <i class="fas fa-plus-circle"></i></button>

						<button class="glyp-ico subs"> <i class="fas fa-minus-circle"></i></button>
						</div>
					<!-- 
					<input type="button" value="+" id="adds" class=" btn-default" />
					<input type="button" value="-" id="subs" class=" btn-default " style="margin-right: 2%" />&nbsp;
				-->
				<div class="row">
					<span>$25.00</span>
				</div>
			</div>
		</div>
				<hr class="hr-white">
				<div class="row">
					<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
						<h2 class="text-white">SALAD</h2>
					</div>
					<div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
						<h5 class="text-white">CREATE YOUR OWN SALAD</h5>
						<h6 class="text-white">Organic Product, Second Product, Third Product, Second Product, Third Product
						, Second Product, Third Product, Second Product, Third Product</h6>
					</div>
					<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
						<div class="leftsidecontentmiddle">
						<button class="btn btn-default btn-w btn-block">Change</button>
						<button class="btn btn-default btn-w btn-block">DELETE</button>
					</div>
				</div>
					<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 leftsidecontentmiddle" style="text-align: center; vertical-align: middle;">
						<div class="row " >
						<input type="text" class="noOfRoom" style="width: 30px; background: transparent; border: none;color: #fff; font-size: 18px;"  value="1" name="noOfRoom" />&nbsp;
						<button class="glyp-ico adds" > <i class="fas fa-plus-circle"></i></button>

						<button class="glyp-ico subs"> <i class="fas fa-minus-circle"></i></button>
						</div>
					<!-- 
					<input type="button" value="+" id="adds" class=" btn-default" />
					<input type="button" value="-" id="subs" class=" btn-default " style="margin-right: 2%" />&nbsp;
				-->
				<div class="row">
					<span>$25.00</span>
				</div>
			</div>
		</div>



	</div>
	<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 mt-5 ">
		<hr class="hr-white">
		<div style="display: grid;">	
		<table class="text-center">
			<tr> <th>Subtotal: </th><td>$15.00</td> </tr>
			<tr> <th>Tax: </th><td>$0.99</td> </tr>
		
			<tr> <th>Total: </th><td >$15.99</td> </tr>
		</table>
	</div>
	
			<div class="row leftsidecontentmiddle">
				<button class="btn btn-block btn-default btn-w" onclick="window.location.href='ordertype.php'"><i class="fas fa-left-arrow"></i>CHECKOUT</button>
				<button class="btn btn-block btn-default btn-w">ADD MORE </button>
			</div>
		
	</div>
<!-- 	<hr class="hr-white">
	<div class="bottom-right-data col-md-3 col-lg-3 col-sm-12 col-xs-12 d-md-block d-lg-block d-none"   >
		<h4 class="text-white">SAVE YOUR CREDIT </h4>
		<p class="text-white">save your credit. Porduct</p>
		<div class="col-6">
			<button class="btn btn-default btn-block btn-w" style="margin-bottom: 10px;">GO TO</button>
		</div>

	</div> -->
</div>

</div>




<?php
include 'includes/footer.php';
?>


