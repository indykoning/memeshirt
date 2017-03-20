<?php
if (!empty($_POST['image'])){
    $rand = rand();
    $imagename = $rand.".jpg";
    $file = getcwd() . '/order_images/' . $imagename;
    for ($i = 0; file_exists($file); $i++){
        $imagename = $rand++.".jpg";
        $file = getcwd() . '/order_images/' . $imagename;
    }

    $img = $_POST['image'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    file_put_contents($file, $data);
    $user_id = (!empty($_SESSION['ID']))? $_SESSION['ID']: 'Null';
    if (empty($_SESSION['bestelling_id'])){
$sql = "INSERT INTO `bestelling`(`status`, `users_id`) VALUES (0, $user_id)";
$result = $mysqli->query($sql);
    $_SESSION['bestelling_id'] = $mysqli->insert_id;
    }
$sql = "INSERT INTO `images`(`filename`, `status`, `xs`, `s`, `m`, `l`, `xl`, `xxl`, `bestelling_id`) VALUES ('" . $imagename . "',0, " . $_POST['xs'] . "," . $_POST['s'] . "," . $_POST['m'] . "," . $_POST['l'] . "," . $_POST['xl'] . "," . $_POST['xxl'] . ",".$_SESSION['bestelling_id'].")";
    $mysqli->query($sql);
}

?>
<!DOCTYPE html>
<html>
<head><title>move</title></head>
<body>
<script src="js/fabric.js"></script>
<script src="js/jscolor.js"></script>

<form method="post" enctype="multipart/form-data">
<div id="step-1">
    <script>function showSelectedColor(value) {
            document.getElementById('selectedColor').innerHTML = value;
        };</script>
    <!--stap 1-->
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="black" id="black"><label class="KleurKiezer_label" for="black" style="background-color: black"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="white" id="white"><label class="KleurKiezer_label" for="white" style="background-color: white"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="gray" id="gray"><label class="KleurKiezer_label" for="gray" style="background-color: lightgray"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="blue" id="blue"><label class="KleurKiezer_label" for="blue" style="background-color: blue"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="pink" id="pink"><label class="KleurKiezer_label" for="pink" style="background-color: deeppink"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" value="red" id="red"><label class="KleurKiezer_label" for="red" style="background-color: red"></label>

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
    <canvas style="border: solid black" id="editor" width="670" height="474"></canvas>
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
</style>