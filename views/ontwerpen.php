<script src="js/fabric.js"></script>
<script src="js/jscolor.js"></script>
<div id="loading" style="position: fixed; background-color: rgba(0,0,0,0.5); z-index: 2000; width: 100%; height: 100%; display:none; vertical-align:middle; text-align:center">
    <img src="http://www.cuisson.co.uk/templates/cuisson/supersize/slideshow/img/progress.BAK-FOURTH.gif">
</div>

<div id="no-x-scroll">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper_ontwerpen">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 no_padding">
                            <div class="ontwerpen_links" >
                                <div class="shirt_preview">
<!--<img style="position: absolute; width: 1000px; left: -100px" src="links/shirt_white.jpg">-->
                                        <canvas id="editor"></canvas>


                                    <style>
                                        .canvas-container{
                                            transform: scale(0.2);
                                            left: -700px;
                                            top: -500px;

                                        }
                                        #editor{
                                            box-shadow: 0 0 0 -1px red
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 no_padding">
                            <div id="response"></div>
                            <div class="ontwerpen_rechts">
                                <div class="wrapper_functies_ontwerp">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <button onclick="changeStep(0)" type="button" class="btn btn-info btn_ontwerpproces_status h_button_status">Kleur shirt</button>
                                        </div>
                                        <div class="col-xs-3">
                                            <button onclick="changeStep(1)" type="button" class="btn btn-info btn_ontwerpproces_status h_button_status">Afbeelding</button>
                                        </div>
                                        <div class="col-xs-3">
                                            <button onclick="changeStep(2)" type="button" class="btn btn-info btn_ontwerpproces_status h_button_status">Tekst</button>
                                        </div>
                                        <div class="col-xs-3">
                                            <button onclick="changeStep(3)" type="button" class="btn btn-info btn_ontwerpproces_status h_button_status">Maat en aantal</button>
                                        </div>
                                        <form method="post" name="uploadForm" id="uploadForm" enctype="multipart/form-data">
                                        <div id="step-1">
                                            <script>function showSelectedColor(value) {
                                                    document.getElementById('selectedColor').innerHTML = value;
                                                };</script>
                                            <!--stap 1-->

                                            <div class="colorSelect" >
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="Zwart" id="Zwart"><label class="KleurKiezer_label kleurlabel" for="Zwart" style="background-color: black"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="Wit" id="Wit" checked><label class="KleurKiezer_label kleurlabel" for="Wit" style="background-color: white"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="Grijs" id="Grijs"><label class="KleurKiezer_label kleurlabel kleurlabel" for="Grijs" style="background-color: lightgray"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="Blauw" id="Blauw"><label class="KleurKiezer_label kleurlabel" for="Blauw" style="background-color: blue"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="Roze" id="Roze"><label class="KleurKiezer_label kleurlabel" for="Roze" style="background-color: deeppink"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="Rood" id="Rood"><label class="KleurKiezer_label kleurlabel" for="Rood" style="background-color: red"></label>
                                            </div>
                                            <p id="selectedColor">Wit</p>
                                        </div>
                                        <div id="step-2">
                                            <!--stap 2-->
                                            <h1 class="h_input">Kies uw afbeelding</h1>
                                            <input  type="file" id="fileUpload" accept="image/*">
                                            <label for="fileUpload">Bestand</label>

                                        </div>

                                        <div id="step-3">
                                            <!--stap 3-->
                                            <textarea name="" id="addtext" cols="80" rows="5"></textarea>

                                            <input id="addtextBut" class="btn btn-info btn-add" type="button" value="voeg toe" style="margin-top: 5px; margin-bottom: 5px">
                                                <br>
                                            <input type="button" id="deleteButton" class="btn btn-info btn-remove" value="Verwijder tekst">
                                            <br>
                                            <!--<input type="color" id="color">-->
                                            <div id="colordiv"></div>
                                            <br>
                                            <select id="font-family">
                                                <option value="meme" selected>meme</option>
                                                <option value="arial">Arial</option>
                                                <option value="helvetica">Helvetica</option>
                                                <option value="myriad pro">Myriad Pro</option>
                                                <option value="delicious">Delicious</option>
                                                <option value="verdana">Verdana</option>
                                                <option value="georgia">Georgia</option>
                                                <option value="courier">Courier</option>
                                                <option value="comic sans ms">Comic Sans MS</option>
                                                <option value="impact">Impact</option>
                                                <option value="monaco">Monaco</option>
                                                <option value="optima">Optima</option>
                                                <option value="hoefler text">Hoefler Text</option>
                                                <option value="plaster">Plaster</option>
                                                <option value="engagement">Engagement</option>
                                            </select>

<!--                                            <input type="range" min="5" max="150" value="40" id="size">-->

                                        </div>

                                        <div id="step-4">
                                            <!--stap 4 -->

                                            <div class="floatMaat"><p class="maat">XS</p><input type="number" class="maatAantal" value="0" name="xs"></div>
                                            <div class="floatMaat"><p class="maat">S</p><input type="number" class="maatAantal" value="0" name="s"></div>
                                            <div class="floatMaat"><p class="maat">M</p><input type="number" class="maatAantal" value="0" name="m"></div>
                                            <div class="floatMaat"><p class="maat">L</p><input type="number" class="maatAantal" value="0" name="l"></div>
                                            <div class="floatMaat"><p class="maat">XL</p><input type="number" class="maatAantal" value="0" name="xl"></div>
                                            <div class="floatMaat"><p class="maat">XXL</p><input type="number" class="maatAantal" value="0" name="xxl"></div>
                                            <div id="uploadHolder" style="display: none"></div>
                                            <input type="text" name="image" id="ImageToUpload" style="display: none">
                                        </div>
                                        </form>
                                        <div class="col-xs-12">
                                            <button type="button" id="prev" class="btn btn-info btn_ontwerpproces_terug h_button_terug">Terug</button>
                                            <button type="button" id="next" class="btn btn-info btn_ontwerpproces_verder h_button_verder">Verder</button>
                                            <input type="submit" id="wagen" class="btn btn-info btn_ontwerpproces_verder h_button_verder" name="add_to_cart" value="Voeg toe aan winkelwagen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- eind wrapper ontwerpen  -->

            </div>
        </div>
    </div> <!-- eind container fluid  -->
</div> <!-- eind no x scroll  -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>$(document).ready(function(){
        // smoothscroll
        $('a[href^="#"]').on('click',function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 450, 'swing', function () {
                window.location.hash = target;
            });
        });
    });</script>


<script src="js/ontwerp_stappen.js"></script>
<script src="js/canvas_script.js"></script>