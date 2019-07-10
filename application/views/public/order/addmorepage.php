



<section class="mt-4 mt70">
<div class="container">
	<div class="row">
		<div class="col-12">
		<h2 class="text-center text-white">WOULD YOU LIKE TO ADD ANYTHING?</h2>
	</div>
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="row center-div d-flex justify-content-around"> 
		<?php
			$count = count($categories);
			  $drinks = array("name"=>"Drinks");
			    $addToArray = arrayToObj($drinks);	
			    $categories[$count] = $addToArray;
			    $newcount = count($categories);	
			foreach ($categories as $key => $value) { 
			if(!empty($value->cat_id)){ ?> 
				<a href="<?php echo base_url('order/subcategory/').$value->cat_id; ?>" class="hovicon bighovicons  effect-8">
					<span class="content"><?php echo $value->name; ?></span>
				</a>
				<?php } else { ?>
					<a href="<?php echo base_url('order/drinks/'); ?>" class="hovicon bighovicons  effect-8">
					<span class="content"><?php echo $value->name; ?></span>
				</a>
				<?php } 
} ?>
		

		
		<a href="<?php echo base_url('order/view_cart'); ?>" class="nothankscircle hovicon effect-8" >
			<span class="content">no thanks</span>
			
		</a>
		







</div>
	</div>

</div>



</div>

</section>





