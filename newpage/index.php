<style type="text/css">
	body{
		overflow: hidden;
	}
	.animate{
		overflow-y: hidden;
	max-height: 500px; /* approximate max height */

	transition-property: all;
	transition-duration: .5s;
	transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
	}
	.hovicon_small{
		display: grid;
align-items: center;
text-align: center;
margin-right: 0px;
width: 150px;
height: 150px;
border-radius: 50%;
border: 4px solid #ffff;
align-items: center;
cursor: pointer;
position: relative;
	}
	.overly{
		position: absolute;
		background: rgba(0,0,0,0.7);
		height: 100%;
		width: 100%;
	}
	.overDiv{
		vertical-align: middle;

	}
	.dotted_hovicon{
		border: 4px dotted #fff;
	}
	.border_curve{
border-radius: 100%/149px 149px 0 0;
margin-top: 7px;

	}
	.btm-center{
		bottom: 0;
position: fixed;
	}
	.vl {
  border-left: 4px solid #fff;
  height: 35px;
}
	.colorgraph {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
</style>

<?php 
$count = count($categories);
if($count==0){
	?>

<div class="overly overDiv" style="display: grid">
	<div class="container" style="display: grid;align-items: center; text-align: center;">
		<div class="row">
		<div class="col-md-12">
		<h4 style="color: #fff; text-align: center;">No Category Available</h4>
			<hr class="colorgraph">
		<div class="col-xs-12 col-md-12">
			<a href="<?php echo base_url(); ?>" class="btn btn-success btn-lg">Go Back</a></div>
		</div>	
		</div>
	</div>
	
</div>

<?php } ?>





<section class="menu-section pt50" >
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 " >	
		<div class="" >	
			<!-- <h1 class="text-center text-white">SEMANTIC GARLIC</h1> -->
			<div class="row center-div">

			    		<a class="show_items">
			    			<div class="round sidebar-margin hovicon effect-8 mr-2">
			    				<span class="content marginy0">Base</span> 
			    				<!-- <span class="vl"></span>  -->
			    			</div>
			    		</a>
			    	
			    		

			    		<a class="show_items">
			    			<div class="round sidebar-margin hovicon effect-8 mr-2">
			    				<span class="content marginy0">Toppings</span>
			    			</div>
			    		</a>
			    		<a class="show_items">
			    			<div class="round sidebar-margin hovicon effect-8 mr-2">
			    				<span class="content marginy0">Premium</span>
			    			</div>
			    				<!-- <span class="vl"></span>  -->

			    		</a>
			    		<a class="show_items">
			    			<div class="round sidebar-margin dotted_hovicon effect-8 mr-2">
			    				<span class="content marginy0">Dressings</span>
			    			</div>
			    		</a>
			    		<a class="show_items">
			    			<div class="round sidebar-margin hovicon effect-8 mr-2">
			    				<span class="content marginy0">No Thanks</span>
			    			</div>
			    		</a>
			    		

			    	

			    	

			  

    	

			</div>
		</div>
	</div>
	<div class=" btm-center">
		<a class="show_items">
			    			<div class="round sidebar-margin hovicon_small effect-8 mr-2">
			    				<span class="content marginy0">No Thanks</span>
			    			</div>
			    		</a>
	</div> 
</section>	
<div class="container-fluid bg-white animated slideInUp items border_curve " style="display: none;">
<div class="container ">
<section class=" ">
	<div class="row pt-5">
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>
		<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci spin circle">
			<img src="http://supergreen.bitsclan.com/assets/images/products/360065342Schermafbeelding2019-03-14om14.46.36.png">
			<p>FIrst Menu</p>
		</div>

	</div>
</section>
</div>

</div>

<?php
function arrayToObject($d) {
	if (is_array($d)) {
		return (object) array_map(__FUNCTION__, $d);
	}
	else {
		return $d;
	}
}
?>


<script type="text/javascript">
$( document ).ready(function() {
    console.log( "ready!" );
});	
$(document).ready(function(){
	$(".show_items").click(function(){
		// $(".items").addClass("slideInUp");
		$(".items").show();

			
	})
	









})





</script>