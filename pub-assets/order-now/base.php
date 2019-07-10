<?php
include 'includes/header.php';
?>
<style type="text/css">
	.center-text{
		text-align: center;
    justify-content: center;
    display: flex;
	}
</style>

<body class="" id="main">
	<?php
	include 'includes/leftsidebar.php';

	?>
	<div class="container-fluid "  >
		<div class="row ">
			<div class="col-lg-1 col-md-2 col-sm-12 col-xs-12 bg-dark hide ">
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12  left_border_round" id="border-radius-left">
				<div class="center-text div1 tmgn50" id="showdata" >
				
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="rightsidebar text-center d-none d-lg-block d-xl-block d-md-block">
					<h1 class="pt50">SALAD</h1>
					<h1>Fill your Bowl</h1>
					<div id="myDIV" >
						<p class="ptext text-center"></p>
					</div>	
				</div>
			</div>




			
		</div>
	</div>


<!-- Modal -->
<div class="modal" id="bowlModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="exampleModalLabel">Fill Your Bowl</h5>
       
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="myDIV" >
        <p class="ptext text-center"></p>	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div class="bowlicon bowlround d-md-none d-lg-none d-xl-none">
    <a href="#"  data-toggle="modal" data-target="#bowlModal">
   <p class="mini_content">Bowl</p>

</a>
</div>



</body>

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
	include 'includes/left_icons.php';
	include 'includes/right_icons.php';
include 'includes/footer.php';
?>