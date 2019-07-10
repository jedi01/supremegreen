// // Left Sidebar

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
