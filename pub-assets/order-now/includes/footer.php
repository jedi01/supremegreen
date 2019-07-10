



<script>
function openMenu(){
    document.getElementById("mainMenu").style.width="20%";  
     document.getElementById("main").style.marginRight = "20%";  
}
function closeMenu() {
    document.getElementById("mainMenu").style.width = "0";
    document.getElementById("main").style.marginRight= "0";
}

function openHamburger(){
	document.getElementById("mySidenav").style.width="100%";	
}
function openNav() {
    $(document).ready(function () {
  $('.hide').css("display","none");
    })
    document.getElementById("mySidenav").style.width = "20%";
    document.getElementById("main").style.marginLeft = "20%";
}
function closeNav() {
     $(document).ready(function () {
  $('.hide').css("display","block");
    })
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
function goBack() {
    window.history.go(-1);
}

	// $(document).ready(function () {
	//   var height = $(window).height();
 //  $('body').css("height",height+"px");
	// })
	// Order Page Product Increment
$('.adds').click(function add() {
    var $rooms = $(".noOfRoom");
    var a = $rooms.val();
    
    a++;
    $(".subs").prop("disabled", !a);
    $rooms.val(a);
});
$(".subs").prop("disabled", !$(".noOfRoom").val());

$('.subs').click(function subst() {
    var $rooms = $(".noOfRoom");
    var b = $rooms.val();
    if (b >= 1) {
        b--;
        $rooms.val(b);
    }
    else {
        $(".subs").prop("disabled", true);
    }
});


</script>
</body>
</html>