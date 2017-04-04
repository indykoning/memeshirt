var curstep = 0;
var steps = ['step-1', 'step-2', 'step-3', 'step-4'];
var prev = document.getElementById('prev');
var next = document.getElementById('next');
var wagen = document.getElementById("wagen");



next.addEventListener('click', function () {
curstep++;
changeStep(curstep);
});
prev.addEventListener('click', function () {

    curstep--;
changeStep(curstep);
});



function changeStep(stepNumber) {
    if (stepNumber<=0){
        prev.style.display = "none";
    }else{
        prev.style.display = "inline"
    }

    if (stepNumber>=steps.length-1){
        next.style.display = "none";
        wagen.style.display = "inline";

    }else{
        next.style.display = "inline";
        wagen.style.display = "none";
    }


    steps.forEach(function (id) {
       document.getElementById(id).style.display = 'none';
    });
    document.getElementById(steps[stepNumber]).style.display = 'block';
    curstep = stepNumber;
}
changeStep(0);

//stap 1

