<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <nav class="navbar navbar-inverse navbar-fixed-top navbar-right-top navigation_bar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="#" class="navbar-left">MemeShirt</a>
                    </div>
                    <div class="collapse navbar-collapse navbar_no_border" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="#" class="p_nav">Winkelen</a></li>
                            <li><a href="#" class="p_nav">Ontwerpen</a></li>
                            <li><a href="#" class="p_nav">Inloggen</a></li>
                            <li><a href="winkelwagen" class="p_nav">Winkelwagen</a></li>
                        </ul>
                    </div>
                </div> <!-- eind container fluid nav -->
            </nav>
        </div>
    </div> <!-- eind row navbar  -->

<nav><img src=""> <ul><li><a href="ontwerpen">ontwerpen</a></li><li class="winkelmand"></li></ul></nav>
<a href="?logout">Logout</a>
<form id="registerForm" method="post">
    <table>
        <tr><td><label>e-mail</label></td><td><input type="text" name="email" placeholder="e-mail"></td></tr>
        <tr><td><label>wachtwoord</label></td><td><input type="password" name="wachtwoord" placeholder="wachtwoord"></td></tr>
        <tr><td><label>wachtwoord herhalen</label></td><td><input type="password" name="wachtwoord2" placeholder="wachtwoord herhalen"></td></tr>
        <tr><td><label>Voornaam</label></td><td><input type="text" name="voornaam" placeholder="voornaam"></td></tr>
        <tr><td><label>Achternaam</label></td><td><input type="text" name="achternaam" placeholder="achternaam"></td></tr>
        <tr><td><label>Straatnaam</label></td><td><input type="text" name="straatnaam" placeholder="straatnaam"></td></tr>
        <tr><td><label>huisnummer</label></td><td><input type="number" name="huisnummer" placeholder="huisnummer"></td></tr>
        <tr><td><label>postcode</label></td><td><input type="text" name="postcode" placeholder="postcode"></td></tr>
        <tr><td><label>plaatsnaam</label></td><td><input type="text" name="plaatsnaam" placeholder="plaatsnaam"></td></tr>
        <tr><td></td><td><input type="submit" name="registreren" value="Registreer"></td></tr>
    </table>
</form>

<form id="loginForm" method="post">
    <table>
        <tr><td><label>e-mail</label></td><td><input type="text" name="email" placeholder="e-mail"></td></tr>
        <tr><td><label>wachtwoord</label></td><td><input type="password" name="wachtwoord" placeholder="wachtwoord"></td></tr>
        <tr><td></td><td><input type="submit" name="login" value="log in    "></td></tr>
    </table>
</form>