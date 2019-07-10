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