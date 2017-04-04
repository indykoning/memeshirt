<form method="post">
    <div class="row">
        <div class="col-xs-12">
            <div class="wrapper_registreren">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="h_bestelling">Registreren</h1>
                        <div class="blue_line1"></div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="register" value="register">
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <span class="p_form">Voornaam</span>
                            <input name="voornaam" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <span class="p_form">Achternaam</span>
                            <input name="achternaam" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <span class="p_form">Straatnaam</span>
                            <input name="straatnaam" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <span class="p_form">Huisnummer</span>
                            <input name="huisnummer" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-4">
                        <div class="form-group">
                            <span class="p_form">Postcode</span>
                            <input name="postcode" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <div class="form-group">
                            <span class="p_form">Plaats</span>
                            <input name="plaatsnaam" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <span class="p_form">E-mailadres</span>
                            <input name="email" type="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <span class="p_form" for="password">Wachtwoord</span>
                            <input name="wachtwoord" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <span class="p_form" for="password">Wachtwoord herhalen</span>
                            <input name="wachtwoord_hh" type="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 hidden-xs">
                        <button onclick="window.location.href='inloggen'" type="button" class="btn btn-info btn_reg_terug h_button_terug_bestel">Terug</button>
                    </div>
                    <div class="hidden-sm hidden-md hidden-lg col-xs-12">
                        <input type="submit" value="registreer" class="btn btn-info btn_reg_registreer h_button_terug_bestel">
                    </div>
                    <div class="col-sm-6 hidden-xs">
                        <input type="submit" value="registreer" class="btn btn-info btn_reg_registreer h_button_terug_bestel">
                    </div>
                    <div class="hidden-sm hidden-md hidden-lg col-xs-12">
                        <button onclick="window.location.href='inloggen'" type="button" class="btn btn-info btn_reg_terug h_button_terug_bestel">Terug</button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- eind wrapper winkelwagen  -->
</form>