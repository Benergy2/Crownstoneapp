$(document).ready(function(){
    $(".logoutHolder").on("click", function(){
        window.location.href = "index.html";
    });
});

//function onLoad() {
//    document.addEventListener("deviceready", onDeviceReady, false);
//}
//
//// device APIs are available
////
//function onDeviceReady() {
//    // Register the event listener
//    document.addEventListener("backbutton", onBackKeyDown, false);
//    $(".logoutHolder").on("click", function(){
//        window.location.href = "index.html";
//    });
//}
//
//// Handle the back button
////
//function onBackKeyDown() {
//    window.history.back();
//}