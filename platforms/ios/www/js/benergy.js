/**
 * Created by rubendeman on 09-06-15.
 */
$('document').ready(init);
function init(){

    // Login button
    $('.loginButton').on('click', function(){
        var username =  $(".text1").val();
        var password =  $(".text2").val();

        $.ajax({
            type: 'GET',
            url: 'http://rubendeman.nl/api/index.php',
            contentType: 'application/json; charset=utf-8',
            data: {action: "login", username: username, password: password },
            dataType: 'json',
            success: function(data) {
                alert('Uw bent nu ingelogd');
            },
            error: function(data) {
                alert('Er is iets misgegaan');
                console.log(data);
            }
        });

    });

    // Register button
    $('.registerButton').on('click', function(){
        var email =  $(".text1").val();
        var username =  $(".text2").val();
        var password =  $(".text3").val();
        var dorm = $('.select1').val();

        var key = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for( var i=0; i < 50; i++ )
            key += possible.charAt(Math.floor(Math.random() * possible.length));

        $.ajax({
            type: 'GET',
            url: 'http://rubendeman.nl/api/index.php',
            contentType: 'application/json; charset=utf-8',
            data: {action: "register", email: email, username: username, password: password, dorm: dorm,key: key},
            dataType: 'json',
            success: function(data) {
                alert('account is aangemaakt');
            },
            error: function(data) {
                alert('Er is iets misgegaan'+this.url);
            }
        });
    });

    // lostPassword button
    $('.lostPasswordButton').on('click', function(){

    });

}