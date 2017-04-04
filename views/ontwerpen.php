<?php
ini_set('memory_limit', '-1');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '50M');
$output_width = 3508;
$output_height = 2480;

var_dump($_POST);
function setTransparency($new_image,$image_source)
{

    $transparencyIndex = imagecolortransparent($image_source);
    $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);

    if ($transparencyIndex >= 0) {
        $transparencyColor    = imagecolorsforindex($image_source, $transparencyIndex);
    }

    $transparencyIndex    = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
    imagefill($new_image, 0, 0, $transparencyIndex);
    imagecolortransparent($new_image, $transparencyIndex);

}

if (!empty($_POST['add_to_cart'])) {
    ini_set('gd.jpeg_ignore_warning', 1);
    $rand = rand();
    $imagename = $rand . ".jpg";
    $file = getcwd() . '/order_images/' . $imagename;
    for ($i = 0; file_exists($file); $i++) {
        $imagename = $rand++ . ".jpg";
        $file = getcwd() . '/order_images/' . $imagename;
    }

    $img = $_POST['image'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $image = imagecreatefromstring($data);
//    imagecolortransparent($image, imagecolorallocate($image,255, 255, 255));
//    imagealphablending($image, false);
//    imagesavealpha($image, true);


    $image_p = imagecreatetruecolor($output_width, $output_height);
    setTransparency($image_p, $image);
//    imagecolortransparent($image_p, imagecolorallocate($image_p,255, 255, 255));
//    imagealphablending($image_p, false);
//    imagesavealpha($image_p, true);
    $width = imagesx($image);
    $height = imagesy($image);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0,$output_width , $output_height, $width, $height);

    ob_start(); // Let's start output buffering.
    imagejpeg($image_p); //This will normally output the image, but because of ob_start(), it won't.
    $data = ob_get_contents(); //Instead, output above is saved to $contents
    ob_end_clean();

    $context = stream_context_create([
        'gs' => [
            'acl' => 'public-read',
            'Content-Type' => 'image/jpeg',
            'enable_cache' => true,
            'enable_optimistic_cache' => true,
            'read_cache_expiry_seconds' => 300,
        ]
    ]);
    if (file_put_contents($file, $data, false, $context) !== false) {
        $user_id = (!empty($_SESSION['ID'])) ? $_SESSION['ID'] : 'Null';
        if (empty($_SESSION['bestelling_id'])) {
            $sql = "INSERT INTO `bestelling`(`status`, `users_id`) VALUES (0, $user_id)";
            $result = $mysqli->query($sql);
            $_SESSION['bestelling_id'] = $mysqli->insert_id;
        }
        $xs = abs($_POST['xs']) * PRIJS_XS;
        $s = abs($_POST['s']) * PRIJS_S;
        $m = abs($_POST['m']) * PRIJS_M;
        $l = abs($_POST['l']) * PRIJS_L;
        $xl = abs($_POST['xl']) * PRIJS_XL;
        $xxl = abs($_POST['xxl']) * PRIJS_XXL;
        $totaal = $xs+$s+$m+$l+$xl+$xxl;
        $sql = "INSERT INTO `images`(`filename`, `status`, `totaal_prijs`, `xs`, `s`, `m`, `l`, `xl`, `xxl`, `bestelling_id`) VALUES ('" . $imagename . "',0, ". $totaal ."," . abs($_POST['xs']) . "," . abs($_POST['s']) . "," . abs($_POST['m']) . "," . abs($_POST['l']) . "," . abs($_POST['xl']) . "," . abs($_POST['xxl']) . "," . $_SESSION['bestelling_id'] . ")";
        $mysqli->query($sql);
//    var_dump($sql);
//    var_dump(mysqli_error($mysqli));
    }else{
//        var_dump('err');
    }
}
?>
<script src="js/fabric.js"></script>
<script src="js/jscolor.js"></script>
<div id="no-x-scroll">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper_ontwerpen">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 no_padding">
                            <div class="ontwerpen_links">
                                <div class="shirt_preview">

                                        <canvas id="editor"></canvas>


                                    <style>
                                        .canvas-container{
                                            transform: scale(0.13);
                                            left: -1550px;
                                            top: -1100px;
                                            border: 20px solid black;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 no_padding">
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
                                        <form method="post" enctype="multipart/form-data">
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
                                            <input  type="file" id="fileUpload" accept="image/*">

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

                                        </div>

                                        <div id="step-4">
                                            <!--stap 4 -->
                                            <div class="floatMaat"><p class="maat">XS</p><input type="number" class="maatAantal" value="0" name="xs"></div>
                                            <div class="floatMaat"><p class="maat">S</p><input type="number" class="maatAantal" value="0" name="s"></div>
                                            <div class="floatMaat"><p class="maat">M</p><input type="number" class="maatAantal" value="0" name="m"></div>
                                            <div class="floatMaat"><p class="maat">L</p><input type="number" class="maatAantal" value="0" name="l"></div>
                                            <div class="floatMaat"><p class="maat">XL</p><input type="number" class="maatAantal" value="0" name="xl"></div>
                                            <div class="floatMaat"><p class="maat">XLL</p><input type="number" class="maatAantal" value="0" name="xxl"></div>
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