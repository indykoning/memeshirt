<!DOCTYPE html>
<html>
<head><title>move</title></head>
<body>
<script src="js/fabric.js"></script>
<script src="js/jscolor.js"></script>
<div id="step-1">
    <script>function showSelectedColor(value) {
            document.getElementById('selectedColor').innerHTML = value;
        };</script>
    <!--stap 1-->
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" id="black"><label class="KleurKiezer_label" for="black" style="background-color: black"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" id="white"><label class="KleurKiezer_label" for="white" style="background-color: white"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" id="gray"><label class="KleurKiezer_label" for="gray" style="background-color: lightgray"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" id="blue"><label class="KleurKiezer_label" for="blue" style="background-color: blue"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" id="pink"><label class="KleurKiezer_label" for="pink" style="background-color: deeppink"></label>
    <input style="display: none" type="radio" name="shirtColor" onchange="showSelectedColor(this.id)" id="red"><label class="KleurKiezer_label" for="red" style="background-color: red"></label>

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
    <input type>

</div>
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