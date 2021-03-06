<?php
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
//var_dump($_POST);
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


    $image_p = imagecreatetruecolor(2480, 3508);
    setTransparency($image_p, $image);
//    imagecolortransparent($image_p, imagecolorallocate($image_p,255, 255, 255));
//    imagealphablending($image_p, false);
//    imagesavealpha($image_p, true);
    $width = imagesx($image);
    $height = imagesy($image);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, 2480, 3508, $width, $height);

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

//    $data = base64_encode($image_p);
    if (file_put_contents($file, $data, false, $context) !== false) {
        $user_id = (!empty($_SESSION['ID'])) ? $_SESSION['ID'] : 'Null';
        if (empty($_SESSION['bestelling_id'])) {
            $sql = "INSERT INTO `bestelling`(`status`, `users_id`) VALUES (0, $user_id)";
            $result = $mysqli->query($sql);
            $_SESSION['bestelling_id'] = $mysqli->insert_id;
        }
        $sql = "INSERT INTO `images`(`filename`, `status`, `xs`, `s`, `m`, `l`, `xl`, `xxl`, `bestelling_id`) VALUES ('" . $imagename . "',0, " . abs($_POST['xs']) . "," . abs($_POST['s']) . "," . abs($_POST['m']) . "," . abs($_POST['l']) . "," . abs($_POST['xl']) . "," . abs($_POST['xxl']) . "," . $_SESSION['bestelling_id'] . ")";
        $mysqli->query($sql);
//    var_dump($sql);
//    var_dump(mysqli_error($mysqli));
    }else{
        var_dump('err');
    }
}
?>
<body>
<script src="js/fabric.js"></script>
<script src="js/jscolor.js"></script>

<form method="post" enctype="multipart/form-data">
<div id="step-1">
    <script>function showSelectedColor(value) {
            document.getElementById('selectedColor').innerHTML = value;
        };</script>
    <!--stap 1-->
    <div class="colorSelect">
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="black" id="black"><label class="KleurKiezer_label" for="black" style="background-color: black"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="white" id="white"><label class="KleurKiezer_label" for="white" style="background-color: white"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="gray" id="gray"><label class="KleurKiezer_label" for="gray" style="background-color: lightgray"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="blue" id="blue"><label class="KleurKiezer_label" for="blue" style="background-color: blue"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="pink" id="pink"><label class="KleurKiezer_label" for="pink" style="background-color: deeppink"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="red" id="red"><label class="KleurKiezer_label" for="red" style="background-color: red"></label>
    </div>
<p id="selectedColor">white</p>
</div>
<div id="step-2">
    <!--stap 2-->
    <input type="file" id="fileUpload" accept="image/*">

</div>
<div id="step-3">
    <!--stap 3-->
    <input type="text" id="addtext"><input id="addtextBut" type="button" value="voeg toe"><br>
    <!--<input type="color" id="color">-->
    <div id="colordiv"></div>
    <br>
    <input type="range" min="5" max="150" value="40" id="size"><input type="button" id="deleteButton" value="verwijder het geselecteerde ding">
    <canvas style="border: solid black" id="editor" width="595" height="842"></canvas>
    <img src="" id="test" class="canvas-img">
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
<input type="submit" name="add_to_cart" value="Voeg toe aan winkelwagen">
</div>
</form>
<input style="display: none" type="button" id="prev" value="previous">
<input type="button" id="next" value="next">
</body>
</html>
<script src="js/ontwerp_stappen.js"></script>
<script src="js/canvas_script.js"></script>
<style>
    .KleurKiezer_label{
        width: 300px; height: 300px;
        border: solid black;
    }
    .colorSelect input[type="radio"]:checked+label {
        box-shadow: 3px 3px 28px 7px rgba(0,0,0,0.75);
    }
</style>