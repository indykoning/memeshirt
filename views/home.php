<!--<h1>Home</h1>-->

<!--<a href="http://snoep.at/clients/thisway/poc/">http://snoep.at/clients/thisway/poc/</a>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-xs-12">-->
<!--            <div class="wrapper_home">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-12">-->
<!--                        <h2 class="h2_home">Style your meme</h2>-->
<!--                        <h2 class="h2_home">and let the meme style you</h2>-->
<!--                        <button onclick="window.location.href='#page2'" type="button" class="btn btn-info btn_ontwerpen h_button_home">Ontwerp je eigen shirt</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="row">-->
<!--        <div class="col-xs-12">-->
<!--            <div class="wrapper_winkelen">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-12">-->
<!--                        <h2 class="h2_home">Style your meme</h2>-->
<!--                        <h2 class="h2_home">and let the meme style you</h2>-->
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php
//                echo "<div style='border: 2px solid black'>";
//                echo "<p>Kies je meme</p>";
//                include_once "model/LoadMemes.php";
//                echo "</div>";
//
//                ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div> <!-- eind container fluid  -->-->
<div class="row">
    <div class="col-xs-12">
        <div class="wrapper_home">
            <div class="row row_home">
                <div class="col-xs-12">
                    <h2 class="h2_home">Style your meme</h2>
                    <h2 class="h2_home">and let the meme style you</h2>
                    <button onclick="window.location.href='#page2'" type="button" class="btn btn-info btn_ontwerpen h_button_home">Ontwerp je eigen shirt</button>
                    <div class="bounce"><a href="#wrapper_winkelen"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div id="wrapper_winkelen">
            <div class="row row_winkelen">
                <div class="col-xs-12">
                    <div class="wrapper_banner">
                        <h2 class="h2_winkelen">Bestaande memes</h2>
                    </div>
                </div>
                <div class="col-xs-12">

                        <?php
                        include_once "model/LoadMemes.php";
                        ?>


                        <div class="col-xs-12 no_padding">
                            <div class="wrapper_banner">
                                <button onclick="window.location.href='ontwerpen'" type="button" class="btn btn-info btn_ontwerpen2 h_button_home2">Ontwerp je eigen shirt</button>
                            </div>
                        </div>
                    </div> <!-- eind row flex  -->
                </div>
            </div>
        </div> <!-- eind wrapper winkelen  -->

