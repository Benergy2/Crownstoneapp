/**
 * Created by rubendeman on 09-06-15.
 */
$('document').ready(init);
function init(){


        $.ajax({
            type: 'GET',
            url: 'http://rubendeman.nl/api/index.php',
            contentType: 'application/json; charset=utf-8',
            data: {action: "getCity" },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // It was true
                    console.log(response.dorms);
                    for (var i = 0; i < response.dorms.length; i++) {
                        $('.select1').append($("<option></option>").attr("value",(i+1)).text(response.dorms[i])); 
                    }
                }
                else {
                    // It was false
                    alert('Er is helaas iets misgegaan'+this.url);
                }
            },
            error: function(data) {
            }
        });


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
            success: function(response) {
                if (response.success) {
                    // It was true
                    alert('Ingelogt');
                    window.location = "home.html";
                }
                else {
                    // It was false
                    alert('Er is helaas iets misgegaan'+this.url);
                }
            },
            error: function(data) {
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
			
		var loop = true;

		if(loop){
			loop = false;
			$.ajax({
				type: 'GET',
				url: 'http://rubendeman.nl/api/index.php',
				contentType: 'application/json; charset=utf-8',
				data: {action: "register", email: email, username: username, password: password, dorm: dorm,key: key},
				dataType: 'json',
				success: function(response) {
					if (response.success) {
                        // It was true
                        alert('Account aangemaakt');
                        window.location = "login.html";
                    }
                    else {
                        // It was false
                        alert('Er is helaas iets misgegaan'+this.url);
                    }
				},
				error: function(data) {
				}
			});
		}
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
            success: function(response) {
                if (response.success) {
                    // It was true
                    alert('Er is een link naar uw email gestuurt!');
                     window.location = "lostPassword2.html";
                }
                else {
                    // It was false
                    alert('Er is helaas iets misgegaan'+this.url);
                }
            },
            error: function(data) {
            }
        });

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
            success: function(response) {
                if (response.success) {
                    // It was true
                    alert('Password is aangepast!');
                     window.location = "login.html";
                }
                else {
                    // It was false
                    alert('Er is helaas iets misgegaan'+this.url);
                }
            },
            error: function(data) {
            }
        });

        $(this).unbind();

    });

    $('.logoutHolder').on("click", function(){
        window.location = "login.html";
    })
}