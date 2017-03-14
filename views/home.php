<h1>Home</h1>

<a href="http://snoep.at/clients/thisway/poc/">http://snoep.at/clients/thisway/poc/</a>



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
                            <li><a href="#" class="p_nav">Winkelwagen</a></li>
                        </ul>
                    </div>
                </div> <!-- eind container fluid nav -->
            </nav>
        </div>
    </div> <!-- eind row navbar  -->
    <div class="row">
        <div class="col-xs-12">
            <div class="wrapper_home">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="h2_home">Style your meme</h2>
                        <h2 class="h2_home">and let the meme style you</h2>
                        <button onclick="window.location.href='#page2'" type="button" class="btn btn-info btn_ontwerpen h_button_home">Ontwerp je eigen shirt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="wrapper_winkelen">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="h2_home">Style your meme</h2>
                        <h2 class="h2_home">and let the meme style you</h2>
                    </div>
                </div>
                <?php
                echo "<div style='border: 2px solid black'>";
                echo "<p>Kies je meme</p>";
                include_once "model/LoadMemes.php";
                echo "</div>";

                ?>
            </div>
        </div>
    </div>
</div> <!-- eind container fluid  -->

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
