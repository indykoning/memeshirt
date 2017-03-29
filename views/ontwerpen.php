<?php
$output_width = 3508;
$output_height = 2480;

function setTransparency($new_image,$image_source)
{
    ini_set('memory_limit', '-1');
    $transparencyIndex = imagecolortransparent($image_source);
    $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);

    if ($transparencyIndex >= 0) {
        $transparencyColor    = imagecolorsforindex($image_source, $transparencyIndex);
    }

    $transparencyIndex    = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
    imagefill($new_image, 0, 0, $transparencyIndex);
    imagecolortransparent($new_image, $transparencyIndex);

}
var_dump($_POST);
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
<body data-spy="scroll" data-target=".navbar" data-offset="25">
<div id="no-x-scroll">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper_ontwerpen">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 no_padding">
                            <div class="ontwerpen_links">
                                <div class="shirt_preview" style="overflow-y: auto">

                                        <canvas id="editor"></canvas>



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
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="black" id="black"><label class="KleurKiezer_label" for="black" style="background-color: black"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="white" id="white" checked><label class="KleurKiezer_label" for="white" style="background-color: white"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="gray" id="gray"><label class="KleurKiezer_label" for="gray" style="background-color: lightgray"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="blue" id="blue"><label class="KleurKiezer_label" for="blue" style="background-color: blue"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="pink" id="pink"><label class="KleurKiezer_label" for="pink" style="background-color: deeppink"></label>
                                                <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="red" id="red"><label class="KleurKiezer_label" for="red" style="background-color: red"></label>
                                            </div>
                                            <p id="selectedColor">white</p>
                                        </div>
                                        <div id="step-2">
                                            <!--stap 2-->
                                            <input  type="file" id="fileUpload" accept="image/*">

                                        </div>

                                        <div id="step-3">
                                            <!--stap 3-->
                                            <input type="text" id="addtext"><input id="addtextBut" type="button" value="voeg toe"><br>
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
                                            <input type="range" min="5" max="150" value="40" id="size"><input type="button" id="deleteButton" value="verwijder het geselecteerde ding">


                                        </div>

                                        <div id="step-4">
                                            <!--stap 4 -->
                                            <table>
                                                <tr><td>xs</td><td><input type="number" value="0" name="xs"></td></tr>
                                                <tr><td>s</td><td><input type="number" value="0" name="s"></td></tr>
                                                <tr><td>m</td><td><input type="number" value="0" name="m"></td></tr>
                                                <tr><td>l</td><td><input type="number" value="0" name="l"></td></tr>
                                                <tr><td>xl</td><td><input type="number" value="0" name="xl"></td></tr>
                                                <tr><td>xxl</td><td><input type="number" value="0" name="xxl"></td></tr>

                                            </table>
                                            <input type="text" name="image" id="ImageToUpload" style="display: none">
                                            <input type="submit"  name="add_to_cart" value="Voeg toe aan winkelwagen">
                                        </div>
                                        </form>
                                        <div class="col-xs-12">
                                            <button type="button" id="prev" class="btn btn-info btn_ontwerpproces_terug h_button_terug">Terug</button>
                                            <button type="button" id="next" class="btn btn-info btn_ontwerpproces_verder h_button_verder">Verder</button>
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
</body>
</html>

<script src="js/ontwerp_stappen.js"></script>
<script src="js/canvas_script.js"></script>