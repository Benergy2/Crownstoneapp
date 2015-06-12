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
                localStorage.setItem("user_id", data['id']);
				window.location.assign("home.html")
				
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
        for( var i=0; i < 4; i++ )
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
                alert('Account is aangemaakt');
            }
        });
    });

    // lostPassword button
    $('.lostPasswordButton').on('click', function(){

        var email =  $(".text1").val();

        $.ajax({
            type: 'GET',
            url: 'http://rubendeman.nl/api/index.php',
            contentType: 'application/json; charset=utf-8',
            data: { action: "lostPassword", email: email },
            dataType: 'json',
            success: function(data) {
                alert('Er is een link naar uw email gestuurt!');
                console.log(data);
                console.log(this.url)
            },
            error: function(data) {
                alert('Er is iets misgegaan'+this.url);
                console.log(data);
            }
        });

        $(this).unbind();

    });

    $('.lostPassword2Button').on('click', function(){

        var email =  $(".text1").val();
        var code =  $(".text2").val();
        var new_password =  $(".text3").val();

        $.ajax({
            type: 'GET',
            url: 'http://rubendeman.nl/api/index.php',
            contentType: 'application/json; charset=utf-8',
            data: { action: "lostPassword2",email:email, code: code, new_password:new_password },
            dataType: 'json',
            success: function(data) {
                alert('Uw wachtwoord is aangepast!');
                console.log(data);
                console.log(this.url)
            },
            error: function(data) {
                alert('Er is iets misgegaan'+this.url);
                console.log(data);
            }
        });

        $(this).unbind();

    });

    $('.logoutHolder').on("click", function(){
        window.location = "login.html";
    })
}