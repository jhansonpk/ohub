jQuery(document).ready(function ($)
{
    var emailValid = false;

    $('#email').focusout(function (e)
    {
        var access_key = '6c51132585b9d39b5545224f8bed43cb';
        var email_address = e.target.value;

        var link = "http://apilayer.net/api/check?access_key=6c51132585b9d39b5545224f8bed43cb&smtp=1&format=1&email="+e.target.value;

        $.ajax({
            url: 'http://apilayer.net/api/check?access_key=' + access_key + '&email=' + email_address,
            dataType: 'jsonp',
            success: function(json)
            {
                if (json.format_valid && json.mx_found && json.smtp_check)
                {
                    $(e.target).parent(this).find('.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
                    $(e.target).parent(this).removeClass('has-error').addClass('has-success has-feedback');

                    $("#score").val(json.score);

                    emailValid = true;
                }
                else
                {
                    $(e.target).parent(this).find('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(e.target).parent(this).removeClass('has-success').addClass('has-error has-feedback');

                    emailValid = false;
                }
            }
        });

    });

    $('form').submit(function (e)
    {
        if(emailValid)
        {
            $.ajax({
                method: "POST",
                url: "/test/send",
                data: $(e.target).serialize(),
                success: function (response)
                {
                    console.log(response);
                    if(response == 0)
                    {
                        $("#address").parent(this).addClass('has-error has-feedback');
                    }
                    else
                    {
                        window.location.replace("/test/success");
                    }
                }
            });
        }

        event.preventDefault();
        return false;
    });


});
