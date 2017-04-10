<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">

            <nav class="navbar navbar-inverse navbar-fixed-top navbar-right-top navigation_bar" style="margin-top: 0">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="home" class="navbar-left navbar-brand"><img src="links/logo.png" height="40" alt=""></a>
                    </div>
                    <a href="#" class="hidden-sm hidden-md hidden-lg p_nav p_nav_winkelwagen"><img src="links/winkelwagen.png" alt="" height="25"></a>
                    <div class="collapse navbar-collapse navbar_no_border" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <?php
                            if (rank == 1) {
                                echo '<li><a href="admin?page=admin" class="p_nav">Admin</a></li>';
                            }
                            ?>
                            <li><a href="home#wrapper_winkelen" class="p_nav">Winkelen</a></li>
                            <li><a href="ontwerpen" class="p_nav">Ontwerpen</a></li>
                            <?php
                            if (LOGGED_IN){
                                echo '<li><a href="?logout" class="p_nav">Uitloggen</a></li>';
                            }else {
                                echo '<li><a href="inloggen" class="p_nav">Inloggen</a></li>';
                            };
                            ?>
                            <!--                            <li><a href="winkelwagen" class="hidden-xs p_nav"><img src="links/winkelwagen.png" alt="" height="25"></a></li>-->
                            <li><a href="#" class="hidden-xs p_nav"></a>
                                <?php
                                $sql = "SELECT bestelling_id FROM images WHERE bestelling_id = ".$_SESSION['bestelling_id'];
                                $result = $mysqli->query($sql);
                                echo "<li><a href='winkelwagen' class='p_nav'><img src='links/winkelwagen.png' alt='' height='25'>($result->num_rows)</a></li>";
                                ?>
                            </li>
                        </ul>
                    </div>
                </div> <!-- eind container fluid nav -->
            </nav>
        </div>
    </div> <!-- eind row navbar  -->
    <!---->
    <!--<nav><img src=""> <ul><li><a href="ontwerpen">ontwerpen</a></li><li class="winkelmand"></li></ul></nav>-->
    <!--<a href="?logout">Logout</a>-->
    <!--<form id="registerForm" method="post">-->
    <!--    <table>-->
    <!--        <tr><td><label>e-mail</label></td><td><input type="text" name="email" placeholder="e-mail"></td></tr>-->
    <!--        <tr><td><label>wachtwoord</label></td><td><input type="password" name="wachtwoord" placeholder="wachtwoord"></td></tr>-->
    <!--        <tr><td><label>wachtwoord herhalen</label></td><td><input type="password" name="wachtwoord2" placeholder="wachtwoord herhalen"></td></tr>-->
    <!--        <tr><td><label>Voornaam</label></td><td><input type="text" name="voornaam" placeholder="voornaam"></td></tr>-->
    <!--        <tr><td><label>Achternaam</label></td><td><input type="text" name="achternaam" placeholder="achternaam"></td></tr>-->
    <!--        <tr><td><label>Straatnaam</label></td><td><input type="text" name="straatnaam" placeholder="straatnaam"></td></tr>-->
    <!--        <tr><td><label>huisnummer</label></td><td><input type="number" name="huisnummer" placeholder="huisnummer"></td></tr>-->
    <!--        <tr><td><label>postcode</label></td><td><input type="text" name="postcode" placeholder="postcode"></td></tr>-->
    <!--        <tr><td><label>plaatsnaam</label></td><td><input type="text" name="plaatsnaam" placeholder="plaatsnaam"></td></tr>-->
    <!--        <tr><td></td><td><input type="submit" name="registreren" value="Registreer"></td></tr>-->
    <!--    </table>-->
    <!--</form>-->
    <!---->
    <!--<form id="loginForm" method="post">-->
    <!--    <table>-->
    <!--        <tr><td><label>e-mail</label></td><td><input type="text" name="email" placeholder="e-mail"></td></tr>-->
    <!--        <tr><td><label>wachtwoord</label></td><td><input type="password" name="wachtwoord" placeholder="wachtwoord"></td></tr>-->
    <!--        <tr><td></td><td><input type="submit" name="login" value="log in    "></td></tr>-->
    <!--    </table>-->
    <!--</form>-->