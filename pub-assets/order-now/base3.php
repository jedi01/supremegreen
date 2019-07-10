<?php
include 'includes/header.php';
?>
<body class="bg"  id="main">
	<?php
	include 'includes/leftsidebar.php';
	include 'includes/left_icons.php';
	include 'includes/right_icons.php';
	?>
<!-- 	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->
	
	

	<!-- <div  class="left-sidebar"></div> -->
	<div class="container-fluid  left_border_round" id="border-radius-left">
			
			
		<div class="container-fluid pr0">
			
			<div class="row theading " >
				<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" >
				</div>
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 div1 tmgn50" id="showdata" >
				
					
				</div>
				<?php
				include 'rightsidebar.php';
				?>
			</div>
			
		</div>
		<?php
include 'mainmenu.php';
?>

	</div>
	<script type="text/javascript">
		var addclass = 'color';
		var removeclass = 'spin';
		var salads = [];

		function encirecl(ele) {

    // alert($(ele).attr("data-name"));
    $(ele).toggleClass(addclass);

    if ($(ele).hasClass('color')) {
    	salads.push($(ele).data('id'))
    	$('.ptext').append("<div data-salad-id='" + $(ele).data('id') + "'>" + $(ele).data('name') + "</div>");
    	$(ele).removeClass(removeclass);
    } else {
    	$(ele).addClass(removeclass);
    	var index = salads.indexOf($(ele).data('id'));
    	if (index > -1) {
    		salads.splice(index, 1);
    	}
    	$(".ptext").children("div[data-salad-id='" + $(ele).data('id') + "']").remove();
    }
    //console.log(salads);
}
$(document).ready(function() {
	$.ajax({
		method: 'post',
		url: "<?php echo'base_salad.php';?>",
		dataType: 'text',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        success: function(data) {
        	$("#showdata").html(data);
        },
    });

	$(".color").click(function() {
		$(".ptext").empty();
	});
});

function change_page(ele) {
	$(".div2").addClass("animated fadeInUp");
	var page = $(ele).attr("data-page");
	$.ajax({
		method: 'post',
		url: page + ".php",
		dataType: 'text',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        success: function(data) {
        	$("#showdata").html(data);
        },
    });
}	


	$(document).ready(function () {
	  var height = $(window).height();
  $('.rightsidebar').css("height",height+"px");
	})
</script>

	<?php
	include 'includes/footer.php';
	?>