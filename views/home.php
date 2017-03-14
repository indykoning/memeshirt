<h1>Home</h1>

<a href="http://snoep.at/clients/thisway/poc/">http://snoep.at/clients/thisway/poc/</a>

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
