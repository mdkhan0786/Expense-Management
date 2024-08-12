$(document).ready(function(){
    $('#FormData').click(function(){
        var firstname = $('#FirstName').val();
        var email = $('#email').val();
        var password = $('#pass').val();

        if(firstname == ""){
            $('#msgfirst').css('display', 'block');
            return false;
        }else{
            $('#msgfirst').css('display', 'none');
        }

        if(password == ""){
            $('#password').css('display','block');
            return false;
        }else{
            $('#password').css('display', 'none')
        }
    })

    $(document).ready(function() {
        // Hide the error message when the user starts typing
        $('#email').on('keyup', function() {
            var emailcheck = $(this).val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(emailcheck)) {
                $('#message').text('Please enter a valid email address.');
                $('#message').css('display', 'block');
            } else {
                $('#message').css('display', 'none');
            }
        });
    })


    $(document).ready(function(){
        $('#BtnLogin').click(function(){
            var logEmail = $('#logemail').val();
            var logPass = $('#logpass').val();
            
            if(logEmail == ""){
                $('#logemailMessage').css('display','block')
                return false;
            }else{
                $('#logemailMessage').css('display','none')
            }

            if(logPass == ""){
                $('#logpassMessage').css('display','block');
                return false;
            }else{
                $('#logpassMessage').css('display','none')
            }
        })
    })

    
});


//Password changer validation






