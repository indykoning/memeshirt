<!DOCTYPE html>
<html>
<head><title>move</title></head>
<body>
<script src="js/fabric.js"></script>

<div id="step-1">
    <!--stap 1-->
</div>
<div id="step-2">
    <!--stap 2-->
    <input type="file" id="fileUpload" accept="image/*">

</div>
<div id="step-3">
    <!--stap 3-->
    <input type="text" id="addtext"><input id="addtextBut" type="button" value="voeg toe"><br>
    <input type="color" id="color"><br>
    <input type="range" min="5" max="150" value="40" id="size">
    <canvas style="border: solid black" id="editor" width="670" height="474"></canvas>
    <img src="" id="test" class="canvas-img">
</div>
<div id="step-4">
    <!--stap 4 -->
</div>
<input style="display: none" type="button" id="prev" value="previous">
<input type="button" id="next" value="next">
</body>
</html>
<script src="js/ontwerp_stappen.js"></script>
<script src="js/canvas_script.js"></script>
