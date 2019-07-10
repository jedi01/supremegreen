<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/customScript.js"></script>
	<!-- font Awesome CDN -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="css/animate.css">
</head>
<body>

		<div class="top-left mini_round d-none d-lg-block d-xl-block">
		<a href="javascript:void(0)" onclick="goBack()">
			<p class="mini_content">BACK</p>

		</a>
		</div>

		<?php
		include 'includes/leftsidebar.php';
		?>

		<!-- <div  class="left-sidebar"></div> -->
		<div class="container-fluid left_border_round" id="border-radius-left">

			<span style="font-size:30px;cursor:pointer" class="hamburger d-lg-none d-xl-none" onclick="openHamburger()">&#9776;</span>		
			<div class="container-fluid">
				
				<div class="row theading" >
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" >
					</div>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 div1 tmgn50" id="showdata" >

						
					</div>
					<?php
					include 'rightsidebar.php';
					?>
				</div>
				
			</div>
		</div>
	
	<div class="btm-left mini_round  d-none d-sm-none d-md-none d-lg-block">
		<a href="#" onclick="openNav()">
			<p class="mini_content">CANCEL</p>

		</a>
	</div>


<script>
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

	// Left Sidebar

	function openHamburger(){
	document.getElementById("mySidenav").style.width="100%";    
	}
	function openNav() {
	document.getElementById("mySidenav").style.width = "20%";
	document.getElementById("main").style.marginLeft = "20%";
	}
	function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
	document.getElementById("main").style.marginLeft= "0";
	}
	function goBack() {
	window.history.go(-1);
	}

	// Salad Pages  

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

	// Rigth Side Bar Data show
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

	 $(document).ready(function () {
	  var height = $(window).height();
	  var width = $(window).width();
  $('body').css("height",height+"px");

 })
</script>

</body>
</html>