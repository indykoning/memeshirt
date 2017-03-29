<div class="wrapper_inloggen">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="h_bestelling">Inloggen</h1>
            <div class="blue_line1"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <form method="post">
            <div class="form-group">
                <span class="p_form"> Email </span>
                <input name="email" class="form-control p_form" type="email">
                <span class="p_form"> Wachtwoord </span>
                <input name="wachtwoord" class="form-control p_form" type="password">
            </div>
            <button name="login" type="submit" class="btn btn-info btn_inlog_login h_button_terug_bestel">Login</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <span><a class="p_vergeten" href="wachtwoordvergeten.html">Wachtwoord vergeten?</a></span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 hidden-xs">
            <button onclick="window.location.href='home'" type="button" class="btn btn-info btn_inlog_terug h_button_terug_bestel">Terug</button>
        </div>
        <div class="hidden-sm hidden-md hidden-lg col-xs-12">
            <button onclick="window.location.href='registratie'" type="button" class="btn btn-info btn_inlog_registreer h_button_terug_bestel">Registreren</button>
        </div>
        <div class="col-sm-6 hidden-xs">
            <button onclick="window.location.href='registratie'" type="button" class="btn btn-info btn_inlog_registreer h_button_terug_bestel">Registreren</button>
        </div>
        <div class="hidden-sm hidden-md hidden-lg col-xs-12">
            <button onclick="window.location.href='home'" type="button" class="btn btn-info btn_inlog_terug h_button_terug_bestel">Terug</button>
        </div>
    </div>

</div>