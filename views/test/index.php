<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="/img/logo.png" width="50">
            </a>
        </div>
    </div>
</nav>
<section>
    <header class="container">
        <h1 class="text-center">Teste desenvolvedor Full Stack</h1>
        <form method="post" action="#">
            <input name="score" type="hidden" id="score">
            <div class="row">
                <div class="form-group col-sm-4 col-xs-12"> <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu e-mail" required> <span class="glyphicon form-control-feedback" aria-hidden="true"></span> </div>
                <div class="form-group col-sm-6 col-xs-12"> <input type="text" name="address" class="form-control" id="address" placeholder="Digite seu endereço comercial" required> <span class="help-block" >Endereço sem número</span> </div>
                <div class="form-group col-sm-2 col-xs-12">  <button type="submit" class="btn btn-primary col-xs-12">Pesquisar</button></div>
            </div>
         </form>
    </header>
    <figure>
        <img class="hidden-md hidden-lg" src="/img/mobile.jpg" alt="backgroud mobile" width="100%">
        <img class="hidden-xs hidden-sm" src="/img/desktop.jpg" alt="backgroud desktop" width="100%">
    </figure>
</section>

<script>
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
</script>